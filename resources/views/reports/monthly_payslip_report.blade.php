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
			header: page-header;
			footer: page-footer;
		}
		body{
			font-size: 1rem;
            font-family: "Times New Roman";
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
		.white-color *,
		.white-color{
			color:#fff;
		}
		
		.padding {
			padding: .25rem .7rem;
		}

		.border {
			border-bottom:1px solid #000;
		}
		
		.border-bottom td,
		.border-bottom th{
			border-bottom:1px solid #000;
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

		.line-height *, .line-height {
			line-height: 5px;
		}

		table, table td, table th {
		  	border-collapse: collapse; 
		  	border: 1px solid black;
		}
		table {
			width: 95%;
		 	border-width: 1px 1px 0 0;
		 	padding: .25rem .7rem;
		 	margin: 0px auto;
		}
		table td, table th {
		  border-width: 0 0 1px 1px;
		}
	</style>
</head>
<body>
<htmlpageheader name="page-header">

</htmlpageheader>


	<?php echo $output; ?>


<htmlpagefooter name="page-footer">
		<div style="width: 20%; float: right; display: inline-block;">
			<span style="text-align: center;border-top: 1px solid #000;">Authorized Signature</span>
		</div>
</htmlpagefooter>

</body>
</html>
