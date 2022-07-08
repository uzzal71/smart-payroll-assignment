<?php

namespace App\Http\Controllers;

use App\Models\SalarySheet;
use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;


class SalaryReportController extends Controller
{
	/**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function monthly_salary_details(Request $request)
    {
        $month = date('m');
        $year = date('Y');

    	return view('salary_reports.monthly_salary_details', compact('month', 'year'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function monthly_salary_details_report(Request $request)
    {
        $company = Company::orderBy('id', 'desc')->first();

        $month = $request->month;
        $year = $request->year;
        $employee_id = $request->employee_id;
        $employees = Employee::with(['department', 'designation', 'schedule'])->whereIn('id', $employee_id)->get();

        $month_name = date("F", mktime(0, 0, 0, $month, 10));

        $output = '<div>
                <h2 class="text-center p-0 m-0">'.$company->company_full_name.'</h2>
                <p class="text-center">'.$company->address.'</p>
                <h3 class="text-center">'.$month_name.' - '.$year.' Salary Sheet</h3>';

        $output .= '
                <table class="padding text-center small table-bordered">
                    <thead>
                        <tr class="gry-color" style="background: #eceff4;">
                            <th class="text-center" rowspan="2">SL</th>
                            <th class="text-center" rowspan="2">Employee</th>
                            <th class="text-center" rowspan="2">Designation</th>
                            <th class="text-center" rowspan="2">Gross Salary</th>
                            <th class="text-center" colspan="9">Attendance</th>
                            <th class="red-color text-center" colspan="4">Deduction</th>
                            <th class="text-center" colspan="6">Addition</th>
                            <th class="text-center" rowspan="2">Net Salary</th>
                        </tr>
                        <tr class="gry-color" style="background: #eceff4;">
                            <th class="text-center">Total Days</th>
                            <th class="text-center">W</th>
                            <th class="text-center">H</th>
                            <th class="text-center">P</th>
                            <th class="text-center">L</th>
                            <th class="text-center">A</th>
                            <th class="text-center">UP</th>
                            <th class="text-center">PL</th>
                            <th class="text-center">Need Pay</th>
                            <th class="text-center">LD</th>
                            <th class="text-center">AD</th>
                            <th class="text-center">ASD</th>
                            <th class="text-center">TLD</th>
                            <th class="text-center">COA</th>
                            <th class="text-center">TB</th>
                            <th class="text-center">PLA</th>
                            <th class="text-center">OTT</th>
                            <th class="text-center">Bonus</th>
                            <th class="text-center">TLD</th>
                        </tr>
                    </thead><tbody class="strong">';

        foreach ($employees as $key => $employee) { 

            $row = SalarySheet::where('salary_month', $month)
                ->where('salary_year', $year)
                ->where('employee_id', $employee->id)
                ->first();

            if (!empty($row)) {
            
                $output .= '<tr>';
                    $output .= '<td>'.$row->employee_id.'</td>';
                    $output .= '<td>'.$row->employee_name.'</td>';
                    $output .= '<td>'.$row->designation.'</td>';
                    $output .= '<td>'.$row->gross_salary.'</td>';
                    $output .= '<td>'.$row->number_of_days.'</td>';
                    $output .= '<td>'.$row->weekend.'</td>';
                    $output .= '<td>'.$row->holiday.'</td>';
                    $output .= '<td>'.$row->present.'</td>';
                    $output .= '<td>'.$row->late.'</td>';
                    $output .= '<td>'.$row->absent.'</td>';
                    $output .= '<td>'.$row->unpaid_leave.'</td>';
                    $output .= '<td>'.$row->paid_leave.'</td>';
                    $output .= '<td>'.$row->need_to_pay.'</td>';
                    $output .= '<td>'.$row->late_deduction.'</td>';
                    $output .= '<td>'.$row->absent_deduction.'</td>';
                    $output .= '<td>'.$row->advance_salary_deduction.'</td>';
                    $output .= '<td>'.$row->total_deduction.'</td>';
                    $output .= '<td>'.$row->commission_addition.'</td>';
                    $output .= '<td>'.$row->transport_bill_addition.'</td>';
                    $output .= '<td>'.$row->paid_leave_addition.'</td>';
                    $output .= '<td>'.$row->overtime_addition.'</td>';
                    $output .= '<td>'.$row->festival_bonus_addition.'</td>';
                    $output .= '<td>'.$row->total_addition.'</td>';
                    $output .= '<td>'.$row->net_salary.'</td>';
                $output .= '</tr>';          
            } else {
                $output .= '<h5 class="text-center">Data not found!</h5>';
            }
        }

        $output .= '</tbody>
                </table>
                <div>'; 

        $pdf = PDF::loadView('reports.monthly_salary_details_report', ['output' => $output], [], ['orientation' => 'L', 'format' => 'A5-L']);
        $pdf->save('pdf/monthly_salary_details_report.pdf');
        return response()->download('pdf/monthly_salary_details_report.pdf');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function monthly_salary_sheet(Request $request)
    {
        $month = date('m');
        $year = date('Y');

        return view('salary_reports.monthly_salary_sheet', compact('month', 'year'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function monthly_salary_sheet_report(Request $request)
    {
        $company = Company::orderBy('id', 'desc')->first();

        $month = $request->month;
        $year = $request->year;
        $employee_id = $request->employee_id;
        $employees = Employee::with(['department', 'designation', 'schedule'])->whereIn('id', $employee_id)->get();

        $month_name = date("F", mktime(0, 0, 0, $month, 10));

        $output = '';

        $output .= '
                <div><br/>
                <div class="text-center line-height">
                    <p style="font-weight: bolder;">'.$company->company_full_name.'</p>
                    <p>'.$company->address.'</p>
                    <p>'.$month_name.' - '.$year.' Payslip</p>
                </div>
                ';
                

        $output .= '
                <table class="padding text-center small table-bordered">
                    <thead>
                        <tr class="gry-color" style="background: #eceff4;">
                            <th class="text-center" rowspan="2">SL</th>
                            <th class="text-center" rowspan="2">Employee</th>
                            <th class="text-center" rowspan="2">Designation</th>
                            <th class="text-center" rowspan="2">Department</th>
                            <th class="text-center" rowspan="2">Joining Date</th>
                            <th class="text-center" colspan="6">Salary Info</th>
                            <th class="text-center" colspan="9">Attendance</th>
                            <th class="red-color text-center" colspan="6">Deduction</th>
                            <th class="text-center" colspan="8">Addition</th>
                            <th class="text-center" rowspan="2">Net Salary</th>
                        </tr>
                        <tr class="gry-color" style="background: #eceff4;">
                            <th class="text-center">Gross</th>
                            <th class="text-center">Basic</th>
                            <th class="text-center">House</th>
                            <th class="text-center">Medical</th>
                            <th class="text-center">Transport</th>
                            <th class="text-center">Food</th>
                            <th class="text-center">Total Days</th>
                            <th class="text-center">W</th>
                            <th class="text-center">H</th>
                            <th class="text-center">P</th>
                            <th class="text-center">L</th>
                            <th class="text-center">A</th>
                            <th class="text-center">UP</th>
                            <th class="text-center">PL</th>
                            <th class="text-center">Need Pay</th>
                            <th class="text-center">LD</th>
                            <th class="text-center">AD</th>
                            <th class="text-center">TX</th>
                            <th class="text-center">PFD</th>
                            <th class="text-center">OD</th>
                            <th class="text-center">TLD</th>
                            <th class="text-center">COA</th>
                            <th class="text-center">TB</th>
                            <th class="text-center">PLA</th>
                            <th class="text-center">OTT</th>
                            <th class="text-center">ASD</th>
                            <th class="text-center">OD</th>
                            <th class="text-center">Bonus</th>
                            <th class="text-center">TLD</th>
                        </tr>
                    </thead><tbody class="strong">';

        foreach ($employees as $key => $employee) { 

            $row = SalarySheet::where('salary_month', $month)
                ->where('salary_year', $year)
                ->where('employee_id', $employee->id)
                ->first();

                if (!empty($row)) {
            
                $output .= '<tr>';
                    $output .= '<td>'.$row->employee_id.'</td>';
                    $output .= '<td>'.$row->employee_name.'</td>';
                    $output .= '<td>'.$row->designation.'</td>';
                    $output .= '<td>'.$row->department.'</td>';
                    $output .= '<td>'.$row->joining_date.'</td>';
                    $output .= '<td>'.$row->gross_salary.'</td>';
                    $output .= '<td>'.$row->basic_salary.'</td>';
                    $output .= '<td>'.$row->house_allowance.'</td>';
                    $output .= '<td>'.$row->medical_allowance.'</td>';
                    $output .= '<td>'.$row->transport_allowance.'</td>';
                    $output .= '<td>'.$row->food_allowance.'</td>';
                    $output .= '<td>'.$row->number_of_days.'</td>';
                    $output .= '<td>'.$row->weekend.'</td>';
                    $output .= '<td>'.$row->holiday.'</td>';
                    $output .= '<td>'.$row->present.'</td>';
                    $output .= '<td>'.$row->late.'</td>';
                    $output .= '<td>'.$row->absent.'</td>';
                    $output .= '<td>'.$row->unpaid_leave.'</td>';
                    $output .= '<td>'.$row->paid_leave.'</td>';
                    $output .= '<td>'.$row->need_to_pay.'</td>';
                    $output .= '<td>'.$row->late_deduction.'</td>';
                    $output .= '<td>'.$row->absent_deduction.'</td>';
                    $output .= '<td>'.$row->tax_deduction.'</td>';
                    $output .= '<td>'.$row->provident_fund_deduction.'</td>';
                    $output .= '<td>'.$row->others_deduction.'</td>';
                    $output .= '<td>'.$row->total_deduction.'</td>';
                    $output .= '<td>'.$row->commission_addition.'</td>';
                    $output .= '<td>'.$row->transport_bill_addition.'</td>';
                    $output .= '<td>'.$row->paid_leave_addition.'</td>';
                    $output .= '<td>'.$row->overtime_addition.'</td>';
                    $output .= '<td>'.$row->advance_salary_addition.'</td>';
                    $output .= '<td>'.$row->others_addition.'</td>';
                    $output .= '<td>'.$row->festival_bonus_addition.'</td>';
                    $output .= '<td>'.$row->total_addition.'</td>';
                    $output .= '<td>'.$row->net_salary.'</td>';
                $output .= '</tr>'; 
                
            } else {
                $output .= '<h5 class="text-center">Data not found!</h5>';
            }
        }

        $output .= '</tbody>
                </table>
                <div>'; 

        $pdf = PDF::loadView('reports.monthly_salary_sheet_report', ['output' => $output], [], ['orientation' => 'L', 'format' => 'A5-L']);
        $pdf->save('pdf/monthly_salary_sheet_report.pdf');
        return response()->download('pdf/monthly_salary_sheet_report.pdf');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function monthly_payslip(Request $request)
    {
        $month = date('m');
        $year = date('Y');

    	return view('salary_reports.monthly_payslip', compact('month', 'year'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function monthly_payslip_report(Request $request)
    {
        $company = Company::orderBy('id', 'desc')->first();

        $month = $request->month;
        $year = $request->year;
        $employee_id = $request->employee_id;
        $employees = Employee::with(['department', 'designation', 'schedule'])->whereIn('id', $employee_id)->get();

        $month_name = date("F", mktime(0, 0, 0, $month, 10));

        $output = '';
        $count = count($employee_id);

        foreach ($employees as $key => $employee) { 
            $count = $count - 1;

            $output .= '
                <div><br/>
                <div class="text-center line-height">
                    <p style="font-weight: bolder;">'.$company->company_full_name.'</p>
                    <p>'.$company->address.'</p>
                    <p>'.$month_name.' - '.$year.' Payslip</p>
                </div>
                ';

            $output .= '
                <table style="background-color: #cce7ed">
                        <tr>
                            <td class="text-center">Employee name</td>
                            <td class="text-center">'.$employee->employee_name.'</td>
                            <td class="text-center">Joining Date</td>
                            <td class="text-center">'.$employee->joining_date.'</td>
                        </tr>

                        <tr>
                            <td class="text-center">Designation</td>
                            <td class="text-center">'.$employee->designation->designation_name.'</td>
                            <td class="text-center">Department</td>
                            <td class="text-center">'.$employee->department->department_name.'</td>
                        </tr>

                </table> <br />';

            $row = SalarySheet::where('salary_month', $month)
                ->where('salary_year', $year)
                ->where('employee_id', $employee->id)
                ->first();

            if (!empty($row)) {

            $output .= '
                <table>
                    <thead>
                        <tr class="white-color" style="background: #8ab6bf;">
                            <th class="text-center">Earnings</th>
                            <th class="text-center">Amount</th>
                            <th class="text-center">Deductions</th>
                            <th class="text-center">Amount</th>
                        </tr>
                    </thead>
                <tbody>';
        
            $output .= '<tr>';
                $output .= '<td>Basic</td>';
                $output .= '<td>'.$row->basic_salary.'</td>';
                $output .= '<td>Late Deduction</td>';
                $output .= '<td>'.$row->late_deduction.'</td>';
            $output .= '</tr>'; 

            $output .= '<tr>';
                $output .= '<td>House Allowance</td>';
                $output .= '<td>'.$row->house_allowance.'</td>';
                $output .= '<td>Absent Deduction</td>';
                $output .= '<td>'.$row->absent_deduction.'</td>';
            $output .= '</tr>';
            
            $output .= '<tr>';
                $output .= '<td>Medical Allowance</td>';
                $output .= '<td>'.$row->medical_allowance.'</td>';
                $output .= '<td>Tax Deduction</td>';
                $output .= '<td>'.$row->tax_deduction.'</td>';
            $output .= '</tr>';

            $output .= '<tr>';
                $output .= '<td>Transport Allowance</td>';
                $output .= '<td>'.$row->transport_allowance.'</td>';
                $output .= '<td>Provident Fund</td>';
                $output .= '<td>'.$row->provident_found_deduction.'</td>';
            $output .= '</tr>';

            $output .= '<tr>';
                $output .= '<td>Food Allowance</td>';
                $output .= '<td>'.$row->transport_allowance.'</td>';
                $output .= '<td>Advance Salary</td>';
                $output .= '<td>'.$row->advance_salary_deduction.'</td>';
            $output .= '</tr>'; 

            $output .= '<tr>';
                $output .= '<td>Commission</td>';
                $output .= '<td>'.$row->commission_addition.'</td>';
                $output .= '<td>Others Deduction</td>';
                $output .= '<td>'.$row->others_deduction.'</td>';
            $output .= '</tr>';
            
            $output .= '<tr>';
                $output .= '<td>Transport Bill</td>';
                $output .= '<td>'.$row->transport_bill_addition.'</td>';
                $output .= '<td colspan="2"></td>';
            $output .= '</tr>';

            $output .= '<tr>';
                $output .= '<td>Leave Earn</td>';
                $output .= '<td>'.$row->paid_leave_addition.'</td>';
                $output .= '<td colspan="2"></td>';
            $output .= '</tr>'; 

            $output .= '<tr>';
                $output .= '<td>Overtime Earn</td>';
                $output .= '<td>'.$row->overtime_addition.'</td>';
                $output .= '<td colspan="2"></td>';
            $output .= '</tr>';
            
            $output .= '<tr>';
                $output .= '<td>Others Earn</td>';
                $output .= '<td>'.$row->other_addition.'</td>';
                $output .= '<td colspan="2"></td>';
            $output .= '</tr>';

            $output .= '<tr>';
                $output .= '<td>Bonus</td>';
                $output .= '<td>'.$row->bonus_aaddition.'</td>';
                $output .= '<td colspan="2"></td>';
            $output .= '</tr>';

            $output .= '<tr class="border-top">';
                $output .= '<th>Total Earning</th>';
                $output .= '<td>'.$row->salary_earn.'</td>';
                $output .= '<td>Total Deductions</td>';
                $output .= '<td>'.$row->total_deduction.'</td>';
            $output .= '</tr>'; 

            $output .= '<tr class="border-top">';
                $output .= '<th>Net Salary</th>';
                $output .= '<td colspan="3">'.$row->net_salary.'</td>';
            $output .= '</tr>';          


            $output .= '</tbody>
                    </table>
                    <div>'; 
            } else {
                $output .= '<h5 class="text-center">Data not found!</h5>';
            }

            if ($count) {
                $output .= '<pagebreak></pagebreak>';
            }
        }

        $pdf = PDF::loadView('reports.monthly_payslip_report', ['output' => $output], [], ['orientation' => 'L', 'format' => 'A5-L']);
        $pdf->save('pdf/monthly_payslip_report.pdf');
        return response()->download('pdf/monthly_payslip_report.pdf');
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function tax_report(Request $request)
    {
        $month = date('m');
        $year = date('Y');

    	return view('salary_reports.monthly_tax', compact('month', 'year'));
    }
}
