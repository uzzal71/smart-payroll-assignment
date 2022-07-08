<?php

namespace App\Console\Commands;

use App\Models\Employee;
use App\Models\EmployeePromotion;
use App\Models\EmployeePromotionOld;
use Illuminate\Console\Command;
use DateTime;

class employee_promotion_checkup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'employee_promotion_checkup:name';

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
        $employee_promotions = EmployeePromotion::where('effective_date', $current_date)->get();

        foreach ($employee_promotions as $key => $row)
        {
            $effective_date   = new DateTime( $row->effective_date );
            
            $year = $effective_date->format('Y');
            $month = $effective_date->format('m');
                
            $promotion_exists = EmployeePromotionOld::where([
                'effective_date' => $row->effective_date,
                'employee_id'   => $row->employee_id,
                'promotion_month' => $month,
                'promotion_year' => $year,
                ])->orderBy('created_at', 'desc')->first();
            
            if (!$promotion_exists) {
                $employee_promotion = new EmployeePromotionOld;
                
                $employee_promotion->employee_id  = $row->employee_id;
                $employee_promotion->department_id   = $row->department_id;
                $employee_promotion->designation_id   = $row->designation_id;
                $employee_promotion->promotion_month   = $month ;
                $employee_promotion->promotion_year   = $year;
                $employee_promotion->effective_date  = $row->effective_date;
                $employee_promotion->remarks  = $row->remarks;
                $employee_promotion->status	 = "active";
                $employee_promotion->save();
    
                $employee = Employee::where('id',$row->employee_id)->first();
    
                $employee->department_id                    = $row->department_id;
                $employee->designation_id                   = $row->designation_id;
    
                $employee->save();
            }
        }
    }
}
