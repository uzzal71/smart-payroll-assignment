<?php

namespace App\Console\Commands;

use App\Models\CronJob;
use App\Models\Employee;
use App\Models\SalaryInformation;
use App\Models\SalarySheet;
use App\Models\AttendanceSummary;
use App\Models\Tax;
use App\Models\ProvidentFund;
use App\Models\AdvanceSalary;
use App\Models\OtherPayment;
use App\Models\TransportPayment;
use App\Models\CommissionPayment;
use Illuminate\Console\Command;

class salary_sheet extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'salary_sheet:name';

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

                    $employees = Employee::with(['department', 'designation', 'schedule'])->where('status', 'active')->get();

                    foreach ($employees as $key => $employee) { // Employees foreach loop start
                        $start_date = "01-".$month."-".$year;
                        $start_time = strtotime($start_date);
                        $end_time = strtotime("+1 month", $start_time);

                        // Employee salary information
                        $salary_info = SalaryInformation::where('employee_id', $employee->id)->first();

                        // Activite Variable
                        $weekend        = 0;
                        $holiday        = 0;
                        $need_to_work   = 0;
                        $present        = 0;
                        $late           = 0;
                        $absent         = 0;
                        $unpaid_leave   = 0;
                        $paid_leave     = 0;
                        $need_to_pay    = 0;
                        $number_of_days = 0;

                        // Salary Variable
                        $late_deduction = 0;
                        $absent_deduction = 0;
                        $tax_deduction = 0;
                        $provident_fund_deduction = 0;
                        $others_deduction = 0;
                        $stamp_deduction = 0;
                        $total_deduction = 0;
                        $commission_addition = 0;
                        $transport_bill_addition = 0;
                        $paid_leave_addition = 0;
                        $overtime_addition = 0;
                        $advance_salary_deduction = 0;
                        $others_addition = 0;
                        $festival_bonus_addition = 0;
                        $total_addition = 0;
                        $salary_earn = 0;
                        $net_salary = 0;

                        $attendance_summary = AttendanceSummary::where([
                            'employee_id' => $employee->id,
                            'attendance_month' => $month,
                            'attendance_year' => $year
                        ])->first();

                        if ($attendance_summary) {
                            $number_of_days = $attendance_summary->number_of_days;
                            $weekend = $attendance_summary->weekend;
                            $holiday = $attendance_summary->holiday;
                            $need_to_work = $attendance_summary->need_to_work;
                            $present = $attendance_summary->present;
                            $late = $attendance_summary->late;
                            $absent = $attendance_summary->absent;
                            $unpaid_leave = $attendance_summary->unpaid_leave;
                            $paid_leave = $attendance_summary->paid_leave;
                            $need_to_pay = $attendance_summary->need_to_pay;

                            // Now Salary Calculation
                            if ($number_of_days != 0) {
                                $per_day_salary = $salary_info->gross_salary / $number_of_days;

                                // Late deduction
                                $late_deduction_days = floor($late / 3);
                                $late_deduction = $per_day_salary * $late_deduction_days;

                                // Absent Na Unpaid Deduction
                                $absent_deduction = $per_day_salary * ($absent + $unpaid_leave);

                                // Tas Deduction
                                if ($employee->tax_status == 1) {
                                    $tax_info = Tax::where('id', $employee->tax_id)->first();

                                    if ($tax_info) {
                                        $tax_deduction = ($salary_info->basic_salary * $tax_info->percentage) / 100;
                                    }
                                }

                                // Provident Found Deduction
                                if ($employee->provident_fund_status == 1) {
                                    $provident_fund_info = ProvidentFund::where('id', $employee->provident_fund_id)->first();

                                    if ($provident_fund_info) {
                                        $provident_fund_deduction = ($salary_info->basic_salary * $provident_fund_info->percentage) / 100;
                                    }
                                }

                                // Advance Salary
                                $advance_salary_deduction = AdvanceSalary::where([
                                    'employee_id' => $employee->id,
                                    'payment_month' => $month,
                                    'payment_year' => $year,
                                ])->sum('amount');

                                // $other Addition
                                $others_deduction = OtherPayment::where([
                                    'employee_id' => $employee->id,
                                    'payment_month' => $month,
                                    'payment_year' => $year,
                                    'status' => 'Minus',
                                ])->sum('amount');

                                $others_addition = OtherPayment::where([
                                    'employee_id' => $employee->id,
                                    'payment_month' => $month,
                                    'payment_year' => $year,
                                    'status' => 'Plus',
                                ])->sum('amount');

                                // Total Deduction
                                $total_deduction = $late_deduction + $absent_deduction + $tax_deduction + $provident_fund_deduction  + $advance_salary_deduction + $others_deduction + $stamp_deduction;

                                // Transport Allowance Added
                                if ($employee->transport_allowance_status == 1) {
                                    $transport_bill_addition = TransportPayment::where([
                                        'employee_id' => $employee->id,
                                        'payment_month' => $month,
                                        'payment_year' => $year,
                                    ])->sum('amount');
                                }

                                // Commission Added
                                if ($employee->commission_status == 1) {
                                    $commission_addition = CommissionPayment::where([
                                        'employee_id' => $employee->id,
                                        'payment_month' => $month,
                                        'payment_year' => $year,
                                    ])->sum('amount');
                                }

                                // Paid Leave Addition
                                $paid_leave_addition = $per_day_salary * $paid_leave;

                                // Total addition
                                $total_addition = $transport_bill_addition + $commission_addition + $paid_leave_addition + $others_addition + $festival_bonus_addition + $overtime_addition;

                                $salary_earn = $need_to_pay * $per_day_salary;

                                $net_salary = ($salary_info->gross_salary - $total_deduction ) + $total_addition;
                            }
                        }

                        $salary_exists = SalarySheet::where([
                            'employee_id' => $employee->id,
                            'salary_month' => $month,
                            'salary_year' => $year
                        ])->first();

                        if ($salary_exists) { // Exists checking start

                            $old_salary = SalarySheet::findOrFail($salary_exists->id);

                            $old_salary->employee_id = $employee->id;
                            $old_salary->salary_month = $month;
                            $old_salary->salary_year = $year;
                            $old_salary->employee_name = $employee->employee_name;
                            $old_salary->designation = $employee->designation->designation_name;
                            $old_salary->department = $employee->department->department_name;
                            $old_salary->joining_date = $employee->joining_date;
                            $old_salary->gross_salary = $salary_info->gross_salary;
                            $old_salary->basic_salary = $salary_info->basic_salary;
                            $old_salary->house_allowance = $salary_info->house_rent;
                            $old_salary->medical_allowance = $salary_info->medical_allowance;
                            $old_salary->transport_allowance = $salary_info->transport_allowance;
                            $old_salary->food_allowance = $salary_info->food_allowance;
                            $old_salary->number_of_days = $number_of_days;
                            $old_salary->weekend = $weekend;
                            $old_salary->holiday = $holiday;
                            $old_salary->need_to_work = $need_to_work;
                            $old_salary->present = $present;
                            $old_salary->late = $late;
                            $old_salary->absent = $absent;
                            $old_salary->unpaid_leave = $unpaid_leave;
                            $old_salary->paid_leave = $paid_leave;
                            $old_salary->need_to_pay = $need_to_pay;
                            $old_salary->late_deduction = $late_deduction;
                            $old_salary->absent_deduction = $absent_deduction;
                            $old_salary->tax_deduction = $tax_deduction;
                            $old_salary->provident_fund_deduction = $provident_fund_deduction;
                            $old_salary->advance_salary_deduction = $advance_salary_deduction;
                            $old_salary->others_deduction = $others_deduction;
                            $old_salary->stamp_deduction = $stamp_deduction;
                            $old_salary->total_deduction = $total_deduction;
                            $old_salary->commission_addition = $commission_addition;
                            $old_salary->transport_bill_addition = $transport_bill_addition;
                            $old_salary->paid_leave_addition = $paid_leave_addition;
                            $old_salary->overtime_addition = $overtime_addition;
                            $old_salary->others_addition = $others_addition;
                            $old_salary->festival_bonus_addition = $festival_bonus_addition;
                            $old_salary->total_addition = $total_addition;
                            $old_salary->salary_earn = $salary_earn;
                            $old_salary->net_salary = $net_salary;

                            $old_salary->save();

                        } else {
                            $salary_sheet = new SalarySheet;

                            $salary_sheet->employee_id = $employee->id;
                            $salary_sheet->salary_month = $month;
                            $salary_sheet->salary_year = $year;
                            $salary_sheet->employee_name = $employee->employee_name;
                            $salary_sheet->designation = $employee->designation->designation_name;
                            $salary_sheet->department = $employee->department->department_name;
                            $salary_sheet->joining_date = $employee->joining_date;
                            $salary_sheet->gross_salary = $salary_info->gross_salary;
                            $salary_sheet->basic_salary = $salary_info->basic_salary;
                            $salary_sheet->house_allowance = $salary_info->house_rent;
                            $salary_sheet->medical_allowance = $salary_info->medical_allowance;
                            $salary_sheet->transport_allowance = $salary_info->transport_allowance;
                            $salary_sheet->food_allowance = $salary_info->food_allowance;
                            $salary_sheet->number_of_days = $number_of_days;
                            $salary_sheet->weekend = $weekend;
                            $salary_sheet->holiday = $holiday;
                            $salary_sheet->need_to_work = $need_to_work;
                            $salary_sheet->present = $present;
                            $salary_sheet->late = $late;
                            $salary_sheet->absent = $absent;
                            $salary_sheet->unpaid_leave = $unpaid_leave;
                            $salary_sheet->paid_leave = $paid_leave;
                            $salary_sheet->need_to_pay = $need_to_pay;
                            $salary_sheet->late_deduction = $late_deduction;
                            $salary_sheet->absent_deduction = $absent_deduction;
                            $salary_sheet->tax_deduction = $tax_deduction;
                            $salary_sheet->provident_fund_deduction = $provident_fund_deduction;
                            $salary_sheet->advance_salary_deduction = $advance_salary_deduction;
                            $salary_sheet->others_deduction = $others_deduction;
                            $salary_sheet->stamp_deduction = $stamp_deduction;
                            $salary_sheet->total_deduction = $total_deduction;
                            $salary_sheet->commission_addition = $commission_addition;
                            $salary_sheet->transport_bill_addition = $transport_bill_addition;
                            $salary_sheet->paid_leave_addition = $paid_leave_addition;
                            $salary_sheet->overtime_addition = $overtime_addition;
                            $salary_sheet->others_addition = $others_addition;
                            $salary_sheet->festival_bonus_addition = $festival_bonus_addition;
                            $salary_sheet->total_addition = $total_addition;
                            $salary_sheet->salary_earn = $salary_earn;
                            $salary_sheet->net_salary = $net_salary;

                            $salary_sheet->save();
                        } // Existing checking end

                        
                    } // Employees foreach loop end
                } // Cronjobs foreach loop end
            } // Checking cronjobs exists end
        } /* Try End */ catch (\Exception $e) {

            return $e->getMessage();
        } // Catch end
    }
}
