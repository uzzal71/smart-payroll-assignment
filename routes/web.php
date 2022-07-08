<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();
Route::group(['middleware' => 'auth'], function () {
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Software Settings
Route::resource('companies', 'CompanyController');
Route::get('/companies/destroy/{id}', 'CompanyController@destroy')->name('companies.destroy');

Route::resource('departments', 'DepartmentController');
Route::get('/departments/destroy/{id}', 'DepartmentController@destroy')->name('departments.destroy');

Route::resource('designations', 'DesignationController');
Route::get('/designations/destroy/{id}', 'DesignationController@destroy')->name('designations.destroy');

Route::resource('schedules', 'ScheduleController');
Route::get('/schedules/destroy/{id}', 'ScheduleController@destroy')->name('schedules.destroy');

Route::resource('leaves', 'LeaveController');
Route::get('/leaves/destroy/{id}', 'LeaveController@destroy')->name('leaves.destroy');

Route::resource('taxs', 'TaxController');
Route::get('/taxs/destroy/{id}', 'TaxController@destroy')->name('taxs.destroy');

// salary settings
Route::resource('salary_settings', 'SalarySettingController');
Route::post('get_salary_settings', 'SalarySettingController@get_salary_settings')->name('Get.Salary.Setting');

Route::resource('provident_funds', 'ProvidentFundController');
Route::get('/provident_funds/destroy/{id}', 'ProvidentFundController@destroy')->name('provident_funds.destroy');

// Employee Management
Route::resource('employees', 'EmployeeController');
Route::get('/employees/destroy/{id}', 'EmployeeController@destroy')->name('employees.destroy');


// Payment Management
Route::resource('advance_salaries', 'AdvanceSalaryController');
Route::post('/advance_salaries/approval/{id}', 'AdvanceSalaryController@approval')->name('advance_salaries.approval');
Route::get('/advance_salaries/destroy/{id}', 'AdvanceSalaryController@destroy')->name('advance_salaries.destroy');

Route::resource('commissions', 'CommissionController');
Route::get('/commissions/destroy/{id}', 'CommissionController@destroy')->name('commissions.destroy');

Route::resource('transport_payments', 'TransportBillController');
Route::get('/transport_payments/destroy/{id}', 'TransportBillController@destroy')->name('transport_payments.destroy');

Route::resource('other_payments', 'OtherPaymentController');
Route::get('/other_payments/destroy/{id}', 'OtherPaymentController@destroy')->name('other_payments.destroy');


// HR Management All Route
Route::resource('employee_leaves', 'EmployeeLeaveController');

Route::post('/employee_leaves/approval/{id}', 'EmployeeLeaveController@approval')->name('employee_leaves.approval');

Route::get('/employee_leaves/destroy/{id}', 'EmployeeLeaveController@destroy')->name('employee_leaves.destroy');

Route::resource('holiday_entries', 'HolidayEntryController');
Route::get('/holiday_entries/destroy/{id}', 'HolidayEntryController@destroy')->name('holiday_entries.destroy');

Route::resource('employee_promotions', 'EmployeePromotionController');
Route::get('/employee_promotions/destroy/{id}', 'EmployeePromotionController@destroy')->name('employee_promotions.destroy');

Route::resource('salary_increments', 'SalaryIncrementController');
Route::get('/salary_increments/destroy/{id}', 'SalaryIncrementController@destroy')->name('salary_increments.destroy');

// Payroll
Route::resource('upload', 'UploadController');
Route::get('/upload/destroy/{id}', 'UploadController@destroy')->name('upload.destroy');

//Manual Attendance Logs
Route::resource('attendances', 'AttendanceController');
Route::get('/approval/attendance', 'AttendanceController@approval_attendance')->name('approval.attendance');
Route::post('/approval/attendance/save', 'AttendanceController@approval_attendance_save')->name('approval.attendance.save');

// Cron Jobs
Route::resource('cronjobs', 'CronJobController');
Route::get('/cronjobs/destroy/{id}', 'CronJobController@destroy')->name('cronjobs.destroy');

// HR Report Route
Route::get('/daily-present', 'HRReportController@daily_present')->name('daily.present');
Route::post('/daily-present-preport', 'HRReportController@daily_present_report')->name('daily.present.report');

// Daily Absent Reports
Route::get('/daily-absent', 'HRReportController@daily_absent')->name('daily.absent');
Route::post('/daily-absent-preport', 'HRReportController@daily_absent_report')->name('daily.absent.report');

// Daily Late Reports
Route::get('/daily-late', 'HRReportController@daily_late')->name('daily.late');
Route::post('/daily-late-preport', 'HRReportController@daily_late_report')->name('daily.late.report');

// Daily Leave Reports
Route::get('/daily-leave', 'HRReportController@daily_leave')->name('daily.leave');
Route::post('/daily-leave-preport', 'HRReportController@daily_leave_report')->name('daily.leave.report');

// Daily Overtime Reports
Route::get('/daily-overtime', 'HRReportController@daily_overtime')->name('daily.overtime');
Route::post('/daily-overtime-preport', 'HRReportController@daily_overtime_report')->name('daily.overtime.report');

// Range Attendance
Route::get('/range-attendance', 'HRReportController@range_attendance')->name('range.attendance');
Route::post('/range-attendance-report', 'HRReportController@range_attendance_report')->name('range.attendance.report');

// Monthly Attendance Reports
Route::get('/monthly-attendance', 'HRReportController@monthly_attendance')->name('monthly.attendance');
Route::post('/monthly-attendance-preport', 'HRReportController@monthly_attendance_report')->name('monthly.attendance.report');

// Month Overtime Reports
Route::get('/monthly-overtime', 'HRReportController@monthly_overtime')->name('monthly.overtime');

// Salary Reports Route
Route::get('/monthly-salary-details', 'SalaryReportController@monthly_salary_details')->name('monthly.salary.details');
Route::post('/monthly-salary-details-report', 'SalaryReportController@monthly_salary_details_report')->name('monthly.salary.details.report');

Route::get('/monthly-salary-sheet', 'SalaryReportController@monthly_salary_sheet')->name('monthly.salary.sheet');
Route::post('/monthly-salary-sheet-report', 'SalaryReportController@monthly_salary_sheet_report')->name('monthly.salary.sheet.report');

Route::get('/monthly-payslip', 'SalaryReportController@monthly_payslip')->name('monthly.payslip');
Route::post('/monthly-payslip-report', 'SalaryReportController@monthly_payslip_report')->name('monthly.payslip.report');

Route::get('/tax-report', 'SalaryReportController@tax_report')->name('tax.report');


// Employee Report Controller
Route::get('/employee/view/attendance', 'EmployeeReportController@employee_view_attendance')->name('employee.view.attendance');
Route::get('/employee/apply/attendance', 'EmployeeReportController@employee_apply_attendance')->name('employee.apply.attendance');
Route::post('/employee/submit/attendance', 'EmployeeReportController@employee_submit_attendance')->name('employee.submit.attendance');
Route::get('/employee/view/payslip', 'EmployeeReportController@employee_view_payslip')->name('employee.view.payslip');
Route::get('/employee/view/provident_fund', 'EmployeeReportController@employee_view_provident_fund')->name('employee.view.provident_fund');
Route::get('/employee/view/tax', 'EmployeeReportController@employee_view_tax')->name('employee.view.tax');

Route::get('/employee/apply/advance_salary', 'EmployeeReportController@employee_apply_advance_salary')->name('employee.apply.advance_salary');
Route::post('/employee/apply/advance_salary/save', 'EmployeeReportController@employee_apply_advance_salary_save')->name('employee.apply.advance_salary.save');
Route::get('/employee/view/advance_salary', 'EmployeeReportController@employee_view_advance_salary')->name('employee.view.advance_salary');

Route::get('/employee/apply/leave', 'EmployeeReportController@employee_apply_leave')->name('employee.apply.leave');
Route::post('/employee/apply/leave/save', 'EmployeeReportController@employee_apply_leave_save')->name('employee.apply.leave.save');
Route::get('/employee/view/leaves', 'EmployeeReportController@employee_view_leaves')->name('employee.view.leaves');

// Systems Route
Route::resource('/users', 'UserController');
Route::get('/user/profile/{id}', 'UserController@show_profile')->name('user.profile');
Route::get('/user/destroy/{id}', 'UserController@destroy')->name('user.destroy');
Route::patch('/user/profile/update/{id}', 'UserController@update_profile')->name('user.profile.update');
Route::get('/system-information', 'SystemController@system_information')->name('system.information');

// Ajax Route
Route::post('/ajax-get-employee', 'AjaxController@get_employee')->name('ajax.get_employee');

Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    Artisan::call('storage:link');
    return redirect()->route('home');
})->name('clear-cache');

});
