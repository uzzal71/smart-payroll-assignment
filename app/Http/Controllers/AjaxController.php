<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function get_employee(Request $request)
    {
    	$output = '
    	<table class="table table-bordered">
    	<thead>
    		<tr>
    			<th>
    				<label class="aiz-checkbox">
                        <input type="checkbox" class="check-all">
                        <span class="aiz-square-check"></span>
                    </label>
    			</th>
    			<th>
    				Employee Card
    			</th>
    			<th>
    				Employee Name
    			</th>
    		</tr>
    		</thead>
    		<tbody>
    	';

        $employees = Employee::orderBy('id', 'asc');

        if ($request->department_id != 'all' && $request->department_id != "") {
            $employees = $employees->orWhere('department_id', $request->department_id);
        }

        if ($request->designation_id != 'all' && $request->designation_id != "") {
            $employees = $employees->where('designation_id', $request->designation_id);
        }

        if ($request->schedule_id != 'all' && $request->schedule_id != "") {
            $employees = $employees->where('schedule_id', $request->schedule_id);
        }

        if ($request->status != 'all' && $request->status != "") {
            $employees = $employees->where('status', $request->status);
        }

        $employees = $employees->get();

        foreach ($employees as $employee) {
            $output .= '

    		<tr>
    			<th>
    				<label class="aiz-checkbox">
                        <input type="checkbox" class="check-one" id="employee_id[]" name="employee_id[]" value=" '.$employee->id.' ">
                         <span class="aiz-square-check"></span>
                    </label>
    			</th>
    			<th>
    				'.$employee->employee_punch_card.'
    			</th>
    			<th>
    				'.$employee->employee_name.'
    			</th>
    		</tr>

    	';
        }

        $output .= '</tbody></table>';

        return response()->json([
            'output' => $output
        ]);
    }
}
