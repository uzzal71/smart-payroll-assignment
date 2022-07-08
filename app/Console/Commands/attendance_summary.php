<?php

namespace App\Console\Commands;

use App\Models\CronJob;
use App\Models\Employee;
use App\Models\Attendance;
use App\Models\AttendanceSummary;
use Illuminate\Console\Command;

class attendance_summary extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'attendance_summary:name';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            $cronjobs = CronJob::where('status', 'on')->get();
            if ($cronjobs) { // Checking cronjobs exists start
                foreach ($cronjobs as $key => $row) { // Cronjobs foreach start
                    $month = date("m", strtotime($row->cron_job_month));
                    $year = $row->cron_job_year;

                    $employees = Employee::where('status', 'active')->get();

                    foreach ($employees as $key => $employee) { // Employees foreach loop start
                        $start_date = "01-".$month."-".$year;
                        $start_time = strtotime($start_date);
                        $end_time = strtotime("+1 month", $start_time);

                        $dates = array();

                        for($i=$start_time; $i<$end_time; $i+=86400)
                        {
                            $dates[] = trim(date('Y-m-d', $i));
                        }

                        $weekend = 0;
                        $holiday = 0;
                        $need_to_work = 0;
                        $present = 0;
                        $late = 0;
                        $absent = 0;
                        $unpaid_leave = 0;
                        $paid_leave = 0;
                        $need_to_pay = 0;
                        $number_of_days = count($dates);

                        foreach ($dates as $value) {
                            $attendance = Attendance::where([
                                'employee_id'       => $employee->id,
                                'attendance_date'   => $value
                            ])->first();

                            if ($attendance->attendance_status == 'W') {
                                $weekend = $weekend + 1;
                            }

                            if ($attendance->attendance_status == 'H') {
                                $holiday = $holiday + 1;
                            }

                            if ($attendance->attendance_status == 'P') {
                                $present = $present + 1;
                            }

                            if ($attendance->attendance_status == 'A') {
                                $absent = $absent + 1;
                            }

                            if ( $attendance->attendance_status == 'SL' || $attendance->attendance_status == 'AL' || $attendance->attendance_status == 'CL' || $attendance->attendance_status == 'MAT' || $attendance->attendance_status == 'PAT' ) {
                                $unpaid_leave = $unpaid_leave + 1;
                            }

                            if ($attendance->attendance_status == 'ML') {
                                $paid_leave = $paid_leave + 1;
                            }

                            if ($attendance->attendance_status == 'L') {
                                $late = $late + 1;
                            }

                            $need_to_work = $number_of_days - ($weekend + $holiday);
                            $need_to_pay = $present + $weekend + $holiday + $paid_leave + $late;
                        }

                        $attendance_summary_exists = AttendanceSummary::where([
                            'employee_id' => $employee->id,
                            'attendance_month' => $month,
                            'attendance_year' => $year
                        ])->first();

                        if ($attendance_summary_exists) { // Exists checking start
                            $attendance_summary_exists->employee_id = $employee->id;
                            $attendance_summary_exists->attendance_month = $month;
                            $attendance_summary_exists->attendance_year = $year;
                            $attendance_summary_exists->number_of_days = $number_of_days;
                            $attendance_summary_exists->weekend = $weekend;
                            $attendance_summary_exists->holiday = $holiday;
                            $attendance_summary_exists->need_to_work = $need_to_work;
                            $attendance_summary_exists->present = $present;
                            $attendance_summary_exists->late = $late;
                            $attendance_summary_exists->absent = $absent;
                            $attendance_summary_exists->unpaid_leave = $unpaid_leave;
                            $attendance_summary_exists->paid_leave = $paid_leave;
                            $attendance_summary_exists->need_to_pay = $need_to_pay;

                            $attendance_summary_exists->save();
                        } else {
                            $attendance_summary = new AttendanceSummary;

                            $attendance_summary->employee_id = $employee->id;
                            $attendance_summary->attendance_month = $month;
                            $attendance_summary->attendance_year = $year;
                            $attendance_summary->number_of_days = $number_of_days;
                            $attendance_summary->weekend = $weekend;
                            $attendance_summary->holiday = $holiday;
                            $attendance_summary->need_to_work = $need_to_work;
                            $attendance_summary->present = $present;
                            $attendance_summary->late = $late;
                            $attendance_summary->absent = $absent;
                            $attendance_summary->unpaid_leave = $unpaid_leave;
                            $attendance_summary->paid_leave = $paid_leave;
                            $attendance_summary->need_to_pay = $need_to_pay;

                            $attendance_summary->save();
                        } // Exists checking end
                    } // Employees foreach loop end
                } // Cronjobs foreach loop end
            } // Checking cronjobs exists end

        } /* Try End */ catch (\Exception $e) {

            return $e->getMessage();
        } // Catch end
    }
}
