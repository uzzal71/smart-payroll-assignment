<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daily Present Report</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta charset="UTF-8">
	<style media="all">
        @page {
			margin: 0;
			padding:0;
		}
		body{
			font-size: 0.875rem;
            font-family: 'Times New Roman';
            font-weight: normal;
            direction: '';
            text-align: '';
			padding:0;
			margin:0; 
		}
		.gry-color *,
		.gry-color{
			color:#000;
		}
		table{
			width: 100%;
		}
		table th{
			font-weight: normal;
		}
		table.padding th{
			padding: .25rem .7rem;
		}
		table.padding td{
			padding: .25rem .7rem;
		}
		table.sm-padding td{
			padding: .1rem .7rem;
		}
		.border-bottom td,
		.border-bottom th{
			border-bottom:1px solid #eceff4;
		}

		.table-border {
			border:1px solid #eceff4;
			border-collapse: collapse;
		}

		.table-border td,
		.table-border th{
			border:1px solid #eceff4;
			border-collapse: collapse;
		}
		
		.text-left{
			text-align: '';
		}
		.text-right{
			text-align: '';
		}
		.text-center {
			text-align: center;
		}
		.p-0 {
			padding: 0px;
		}
		.m-0 {
			margin: 0px;
		}
	</style>
</head>
<body>
	<div>

		<div style="padding: 1rem;">
			<h2 class="text-center p-0 m-0">{{ $company->company_full_name }}</h2>
			<p class="text-center">{{ $company->address }}</p>
			<h3 class="text-center">Daily Late</h3>
		</div>

	    <div style="padding: 1rem;">
			<table class="padding text-left small table-border">
				<thead>
	                <tr class="gry-color" style="background: #eceff4;">
	                    <th width="20%" class="text-left">Name / ID</th>
						<th width="15%" class="text-left">Date</th>
	                    <th width="10%" class="text-left">In-Time</th>
	                    <th width="15%" class="text-left">Out-Time</th>
	                    <th width="10%" class="text-left">Late-Time</th>
	                    <th width="15%" class="text-left">Status</th>
	                    <th width="15%" class="text-left">Remarks</th>
	                </tr>
				</thead>
				<tbody class="strong">
					@foreach ($results as $key => $row)
	                <tr>
		                <td>{{ $row->employee->employee_name }}({{ $row->employee->employee_punch_card }})</td>
						<td>{{ $row->attendance_date }}</td>
						<td>{{ $row->in_time }}</td>
						<td>{{ $row->out_time }}</td>
						<td>{{ $row->late_time }}</td>
						<td>{{ $row->attendance_status }}</td>
						<td>{{ $row->remarks }}</td>
	                </tr>
	                @endforeach
	            </tbody>
			</table>
		</div>

	</div>
</body>
</html>
