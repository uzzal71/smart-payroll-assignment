<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="app-url" content="{{ env('APP_URL')}}">

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Favicon -->
    <link rel="icon" href="{{ static_asset('assets/img/favicon.png') }}">
  	<title>Smart Payroll</title>

    <!-- google font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700">

    <!-- aiz core css -->
    <link rel="stylesheet" href="{{ static_asset('assets/css/vendors.css') }}">
    <link rel="stylesheet" href="{{ static_asset('assets/css/aiz-core.css') }}">
    <link rel="stylesheet" href="{{ static_asset('assets/css/dhtmlx.css') }}">

    <style type="text/css">
        body {
        background: #ececec;
    }
    /*Hidden class for adding and removing*/
    .lds-dual-ring.hidden {
        display: none;
    }

    /*Add an overlay to the entire page blocking any further presses to buttons or other elements.*/
    .overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100vh;
        background: rgba(0,0,0,.8);
        z-index: 999;
        opacity: 1;
        transition: all 0.5s;
    }
    
    /*Spinner Styles*/
    .lds-dual-ring {
        display: inline-block;
        width: 80px;
        height: 80px;
        margin: 100px auto;

    }
    .lds-dual-ring:after {
        content: " ";
        display: block;
        width: 64px;
        height: 64px;
        margin: 5% auto;
        border-radius: 50%;
        border: 6px solid #fff;
        border-color: #fff transparent #fff transparent;
        animation: lds-dual-ring 1.2s linear infinite;
    }
    @keyframes lds-dual-ring {
        0% {
            transform: rotate(0deg);
        }
        100% {
            transform: rotate(360deg);
        }
    }
    </style>

    <script>
        var AIZ = AIZ || {};
        AIZ.local = {
            nothing_selected: 'Nothing selected',
            nothing_found: 'Nothing found',
            choose_file: 'Choose file',
            file_selected: 'File selected',
            files_selected: 'Files selected',
            add_more_files: 'Add more files',
            adding_more_files: 'Adding more files',
            drop_files_here_paste_or: 'Drop files here, paste or',
            browse: 'Browse',
            upload_complete: 'Upload complete',
            upload_paused: 'Upload paused',
            resume_upload: 'Resume upload',
            pause_upload: 'Pause upload',
            retry_upload: 'Retry upload',
            cancel_upload: 'Cancel upload',
            uploading: 'Uploading',
            processing: 'Processing',
            complete: 'Complete',
            file: 'File',
            files: 'Files',
        }
    </script>
</head>
<body onload="doOnLoad();">
<div class="aiz-main-wrapper">
        @include('inc.admin_sidenav')
		<div class="aiz-content-wrapper">
            @include('inc.admin_nav')
			<div class="aiz-main-content">
				<div class="px-15px px-lg-25px">
                    @yield('content')
				</div>
				<div class="bg-white text-center py-3 px-15px px-lg-25px mt-auto">
					<p class="mb-0">&copy; SmartPay v1.0.1</p>
				</div>
			</div><!-- .aiz-main-content -->
		</div><!-- .aiz-content-wrapper -->
	</div><!-- .aiz-main-wrapper -->

    <!-- Loading -->
    <div id="loading" class="lds-dual-ring hidden overlay"></div>

    @yield('modal')

    <script src="{{ static_asset('assets/js/vendors.js') }}" ></script>
    <script src="{{ static_asset('assets/js/aiz-core.js') }}" ></script>
    <script src="{{ static_asset('assets/js/dhtmlx.js') }}" ></script>
    
    @yield('script')

    <script type="text/javascript">
    @foreach (session('flash_notification', collect())->toArray() as $message)
        AIZ.plugins.notify('{{ $message['level'] }}', '{{ $message['message'] }}');
    @endforeach
    </script>

    <script type="text/javascript">
        var myCalendar;
        function doOnLoad() {
            myCalendar = new dhtmlXCalendarObject([
                "calendar",
                "calendar2",
                "calendar3",
                "calendar4",
                "calendar5",
                "calendar6",
                "calendar7",
                "calendar8",
                "calendar9",
                "calendar10", 
                "from_date", 
                "to_date",
                "weekend_date",
                "effective_date"
            ]);
        }
    </script>
    <script type="text/javascript">
        // Binds to the global ajax scope
         $( document ).ajaxStart(function() {
            $( "#loading" ).show();
         });

         $( document ).ajaxComplete(function() {
            $( "#loading" ).hide();
         });
    </script>
</body>
</html>
