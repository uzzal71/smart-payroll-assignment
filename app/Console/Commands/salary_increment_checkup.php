<?php

namespace App\Console\Commands;

use App\Models\SalaryIncrement;
use App\Models\SalaryIncrementOld;
use App\Models\SalaryInformation;
use Illuminate\Console\Command;
use DateTime;

class salary_increment_checkup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'salary_increment_checkup:name';

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
        $current_date = date('Y-m-d');
        $salary_increments = SalaryIncrement::where('effective_date', $current_date)->get();

        foreach ($salary_increments as $key => $row)
        {
            $effective_date   = new DateTime( $row->effective_date );
            
            $year = $effective_date->format('Y');
            $month = $effective_date->format('m');
            
            $salary_exists = SalaryIncrementOld::where([
                'effective_date' => $row->effective_date,
                'employee_id'   => $row->employee_id,
                'increment_month' => $month,
                'increment_year' => $year,
                ])->orderBy('created_at', 'desc')->first();
            
            if (!$salary_exists) {
                $salary_increment = new SalaryIncrementOld();
                
                $salary_increment->employee_id = $row->employee_id;
                $salary_increment->gross_salary = $row->gross_salary;
                $salary_increment->basic_salary = $row->basic_salary;
                $salary_increment->house_rent = $row->house_rent;
                $salary_increment->medical_allowance = $row->medical_allowance;
                $salary_increment->transport_allowance = $row->transport_allowance;
                $salary_increment->food_allowance = $row->food_allowance;
                $salary_increment->increment_month = $month;
                $salary_increment->increment_year = $year;
                $salary_increment->effective_date = $row->effective_date;
                $salary_increment->remarks	 = $row->remarks;
                $salary_increment->status	 = 'active';
    
                $salary_increment->save();
    
                $salary = SalaryInformation::where('employee_id', $row->employee_id)->first();
    
                $salary->employee_id            = $row->employee_id;
                $salary->gross_salary           = $row->gross_salary;
                $salary->basic_salary           = $row->basic_salary;
                $salary->house_rent             = $row->house_rent;
                $salary->medical_allowance      = $row->medical_allowance;
                $salary->transport_allowance    = $row->transport_allowance;
                $salary->food_allowance         = $row->food_allowance;
                $salary->save();
            }
        }
    }
}
