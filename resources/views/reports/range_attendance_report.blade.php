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
		.padding {
			padding: .25rem .7rem;
		}

		.border {
			border-bottom:1px solid #eceff4;
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
<htmlpageheader name="page-header">

</htmlpageheader>


	<?php echo $output; ?>


<htmlpagefooter name="page-footer">
	<p class="text-center">Page: {PAGENO}</p>
</htmlpagefooter>

</body>
</html>
