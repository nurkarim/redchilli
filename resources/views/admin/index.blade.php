
<!DOCTYPE html>
<html lang="en">

<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<title>Admin</title>
		<meta name="description" content="">
		<meta name="author" content="">

		@include('admin._partials.header')
		<!-- END CSS for this page -->
		<style type="text/css">
      .btn-group-sm>.btn, .btn-xs {
            padding: 0.10rem .5rem;
            font-size: .775rem;
            line-height: 1.5;
            border-radius: .2rem;
        }      
        </style>
</head>

<body class="adminbody">

<div id="main">

	<!-- top bar navigation -->
	<div class="headerbar">

		<!-- LOGO -->
        <div class="headerbar-left">
			<a href="index.html" class="logo"> <span>Admin</span></a>
        </div>

        <nav class="navbar-custom">

                    <ul class="list-inline float-right mb-0">
						
						
						
                        
                        
						<li class="list-inline-item dropdown notif">
                            <a class="nav-link dropdown-toggle arrow-none" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false" onclick="activeAll()">
                                <i class="fa fa-fw fa-bell-o"></i><span class="notif-bullet"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-arrow dropdown-lg"  id="loadContent">
								<!-- item-->
                              
					

                            </div>
                        </li>

                        <li class="list-inline-item dropdown notif">
                            <a class="nav-link dropdown-toggle nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <i class="fa fa-user"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                                <!-- item-->
                                <div class="dropdown-item noti-title">
                                    <h5 class="text-overflow"><small>Hello, admin</small> </h5>
                                </div>

                                <!-- item-->
                                <a href="#" class="dropdown-item notify-item">
                                    <i class="fa fa-user"></i> <span>Profile</span>
                                </a>

							
                            </div>
                        </li>

                    </ul>

                    <ul class="list-inline menu-left mb-0">
                        <li class="float-left">
                            <button class="button-menu-mobile open-left">
								<i class="fa fa-fw fa-bars"></i>
                            </button>
                        </li>                        
                    </ul>

        </nav>

	</div>
	<!-- End Navigation -->
	
 
	<!-- Left Sidebar -->
	<div class="left main-sidebar">
	
		@include('admin._partials.nav')

	</div>
	<!-- End Sidebar -->


    <div class="content-page">
	
		<!-- Start content -->
        <div class="content">

            @yield('broadcast')
    @include('errors.messages')
            
            @yield('content')
			<!-- END container-fluid -->

	
        </div>
		<!-- END content -->

    </div>
	<!-- END content-page -->
    
	<footer class="footer">
		<span class="text-right">
		Copyright <a target="_blank" href="#">Redchili</a>
		</span>
		
	</footer>

</div>
<!-- END main -->


@include('admin._partials.footer')
@include('admin._partials.modal')
<script type="text/javascript">
      $(document).ready(function () {
        $("#loadContent").load("{{route('sync-data')}}");
        setInterval(function () {
            $("#loadContent").load("{{route('sync-data')}}");
        },10000);
    })

        function activeAll() {
                $.ajax({
                type: 'GET',
                async:false,
                url: '{{ route('activeNotify') }}',
                dataType: "json",
                success: function(data) {
                if (data.status==true) {
                  
                  
                }else{
                    
                    }
                },
                error: function(data) {
                }
              });
            }
</script>
</body>

</html>