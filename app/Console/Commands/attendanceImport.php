<?php

namespace App\Console\Commands;

use App\Models\Attendance;
use App\Models\AttendanceLog;
use App\Models\CronJob;
use App\Models\Employee;
use App\Models\EmployeeLeaveDetail;
use App\Models\Leave;
use App\Models\OfficeHolidayDetail;
use App\Models\Schedule;
use Illuminate\Console\Command;
use DateTime;

class attendanceImport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'attendance:name';

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

            if ($cronjobs) {
                foreach ($cronjobs as $key => $row) {
                    $month = date("m", strtotime($row->cron_job_month));
                    $year = $row->cron_job_year;

                    $employees = Employee::where('status', 'active')->get();

                    foreach ($employees as $key => $employee) {

                        $start_date = "01-".trim($month)."-".trim($year);
                        $start_time = strtotime($start_date);
                        $end_time = strtotime("+1 month", $start_time);

                        $dates = array();

                        for($i=$start_time; $i<$end_time; $i+=86400)
                        {
                            $dates[] = trim(date('Y-m-d', $i));
                        }

                        $count = 0;
                        foreach ($dates as $value) {

                            $status = 'P';
                            $remarks = '';

                            $leave_info = EmployeeLeaveDetail::where([
                                'employee_id' => $employee->id,
                                'leave_date' => $value,
                                'status' => 1,
                            ])->first();


                            $holiday_info = OfficeHolidayDetail::where([
                                'holiday_date' => $value
                            ])->first();

                            $timestamp = strtotime($value);
                            $day_name = date('l', $timestamp);

                            if ($day_name == 'Friday') {
                                $status = 'W';
                                $remarks = 'Weekend';
                            } elseif ($leave_info) {

                                $leave = Leave::where([
                                    'id' => $leave_info->leave_id
                                ])->first();

                                $status = "ML";
                                $remarks = $leave->leave_name;

                            } elseif ($holiday_info) {
                                $status = 'H';
                                $remarks = $holiday_info->remarks;
                            }

                            // Get Employee Shift Schedule
                            $schedule = Schedule::where('id', $employee->schedule_id)->first();

                            $exists = Attendance::where([
                                'employee_id' => $employee->id,
                                'attendance_date' => $value
                            ])->first();

                            // Check Attendance already process start
                            if (!$exists) {
                                $attendance = new Attendance;

                                $attendance_log = AttendanceLog::where([
                                    'employee_id' => $employee->employee_punch_card,
                                    'attendance_date' => $value,
                                    'status' => 'Y',
                                ])->first();

                                //echo json_encode($attendance_log);

                                $attendance->employee_id = $employee->id;
                                $attendance->attendance_month = $month;
                                $attendance->attendance_year = $year;
                                $attendance->attendance_date = $value;

                                $late = '--:--';

                                if ($attendance_log) {
                                    if ($attendance_log->attendance_in) {
                                        $attendance->in_time = $attendance_log->attendance_in;
                                    } else {
                                        $attendance->in_time = '--:--';
                                    }

                                    if ($attendance_log->attendance_out) {
                                        $attendance->out_time = $attendance_log->attendance_out;
                                    } else {
                                        $attendance->out_time = '--:--';
                                    }
                                    $attendance->late_time = $late;
                                } else {
                                    $attendance->in_time = '--:--';
                                    $attendance->out_time = '--:--';
                                    $attendance->late_time = $late;
                                }

                                $attendance->over_time = 0;
                                $attendance->remarks = $remarks;

                                if ($attendance_log) {
                                    if ($attendance_log->status == 'N') {
                                        $attendance->attendance_status = 'A';
                                    } else {
                                        $attendance->attendance_status = $status;
                                    }
                                }
                                $attendance->save();
                            } else {

                                $attendance = Attendance::findOrFail($exists->id);

                                $attendance_log = AttendanceLog::where([
                                    'employee_id' => $employee->employee_punch_card,
                                    'attendance_date' => $value,
                                    'status' => 'Y',
                                ])->first();

                                $attendance->employee_id = $employee->id;
                                $attendance->attendance_month = $month;
                                $attendance->attendance_year = $year;
                                $attendance->attendance_date = $value;

                                $late = '--:--';

                                // Late calculation start
                                if ($attendance->in_time) {

                                    $emp_in_datetime = $value.' '. $attendance->in_time;
                                    $late_datetime = $value.' '. $schedule->office_late_start;

                                    $date1    = strtotime($emp_in_datetime);
                                    $date2    = strtotime($late_datetime);

                                    if ($date1 > $date2) {
                                        $status = 'L';
                                        $difference = $date1 - $date2;
                                        $late = date('H:i', $difference);
                                        $remarks = 'Late in';
                                    }
                                }
                                // Late calculation end

                                if ($attendance_log) {
                                    if ($attendance_log->attendance_in) {
                                        $attendance->in_time = $attendance_log->attendance_in;
                                    } else {
                                        $attendance->in_time = '--:--';
                                    }

                                    if ($attendance_log->attendance_out) {
                                        $attendance->out_time = $attendance_log->attendance_out;
                                    } else {
                                        $attendance->out_time = '--:--';
                                    }
                                    $attendance->late_time = $late;
                                } else {
                                    $attendance->in_time = '--:--';
                                    $attendance->out_time = '--:--';
                                    $attendance->late_time = $late;
                                }

                                if (($attendance->in_time == '--:--' && $attendance->out_time == '--:--') || ($attendance->in_time == '00:00' && $attendance->out_time == '00:00'))
                                {
                                    if ($status != 'H' && $status != 'W' && $status != 'SL' && $status != 'AL' && $status != 'CL' &&  $status != 'MAT' &&  $status != 'PAT' && $status != 'ML'){
                                        $status = 'A';
                                    }
                                }

                                $attendance->over_time = 0;
                                $attendance->remarks = $remarks;
                                $attendance->attendance_status = $status;

                                $attendance->save();
                            }
                            // Check Attendance already process end
                        } // Dattes foreach end
                    } // Employee foreach end
                } // Cronjobs foreach end
            } // Cronjobs end
        } catch (\Exception $e) {

            return $e->getMessage();
        }
    }
}
