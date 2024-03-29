<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta charset="utf-8" />
	<title>{{ env('APP_NAME') }}</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="{{ env('APP_DESC') }}">
	<meta content="IT" name="author" />
	<meta property="og:url" content="{{ env('APP_URL') }}">
	<meta property="og:description" content="{{ env('APP_DESC') }}">
	<meta property="og:title" content="{{ env('APP_NAME') }}">
	<meta property="og:type" content="website">
	<meta property="og:locale" content="en_ID">

	<link rel="stylesheet" href="{{ asset('assets/font-awesome/4.5.0/css/font-awesome.min.css') }}" />

	<!-- ace styles -->
	<link rel="stylesheet" href="{{ asset('css/ace.css') }}" />

</head>

<body class="login-layout blur-login">
	<div class="main-container">
		<div class="main-content">
			<div class="row">
				<div class="col-sm-10 col-sm-offset-1">
					<div class="login-container">
						<div class="center">
							<h1>
								<i class="ace-icon fa fa-leaf green"></i>
								<span class="red">HRMS</span>
								<span class="white" id="id-text2">Application</span>
							</h1>
							<h4 class="blue" id="id-company-text">&copy; PT Borine Technology Indonesia</h4>
						</div>

						<div class="space-6"></div>

						<div class="position-relative">
							<div id="login-box" class="login-box visible widget-box no-border">
								<div class="widget-body">
									<div class="widget-main">

										<img src="{{ asset('assets/images/borine.png') }}" alt="logo-img" class="img-responsive">

										<h4 class="header blue lighter bigger">
											<i class="ace-icon fa fa-coffee green"></i>
											Please Enter Your Information
										</h4>

										<div class="space-6"></div>

										@if(session('error'))
										<div class="alert alert-danger">
											<b>Opps!</b> {{session('error')}}
										</div>
										@endif

										<form method="post" action="{{ route('auth.authenticate') }}">
											<fieldset>
												@csrf
												<label class="block clearfix">
													<span class="block input-icon input-icon-right">
														<input type="text" class="form-control" name="username" placeholder="Username" required />
														<i class="ace-icon fa fa-user"></i>
													</span>
												</label>

												<label class="block clearfix">
													<span class="block input-icon input-icon-right">
														<input type="password" class="form-control" name="password" placeholder="Password"
															required />
														<i class="ace-icon fa fa-lock"></i>
													</span>
												</label>

												<div class="space"></div>

												<div class="clearfix">
													<button type="submit" class="width-35 pull-right btn btn-sm btn-primary">
														<i class="ace-icon fa fa-key"></i>
														<span class="bigger-110">Login</span>
													</button>
												</div>

												<div class="space-4"></div>
											</fieldset>
										</form>

									</div><!-- /.widget-main -->
								</div><!-- /.widget-body -->
							</div><!-- /.login-box -->
						</div><!-- /.position-relative -->

						<div class="navbar-fixed-top align-right">
							<br />
							&nbsp;
							<a id="btn-login-dark" href="#">Dark</a>
							&nbsp;
							<span class="blue">/</span>
							&nbsp;
							<a id="btn-login-blur" href="#">Blur</a>
							&nbsp;
							<span class="blue">/</span>
							&nbsp;
							<a id="btn-login-light" href="#">Light</a>
							&nbsp; &nbsp; &nbsp;
						</div>
					</div>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.main-content -->
	</div><!-- /.main-container -->

	<!-- basic scripts -->

	<!--[if !IE]> -->
	<script src="{{ asset('js/jquery.js') }}"></script>

	<!-- <![endif]-->

	<!--[if IE]>
<script src="assets/js/jquery-1.11.3.min.js"></script>
<![endif]-->
	{{-- <script type="text/javascript">
		if('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
	</script> --}}

	<!-- inline scripts related to this page -->
	<script type="text/javascript">
		jQuery(function($) {
			 $(document).on('click', '.toolbar a[data-target]', function(e) {
				e.preventDefault();
				var target = $(this).data('target');
				$('.widget-box.visible').removeClass('visible');//hide others
				$(target).addClass('visible');//show target
			 });
			});
			
			
			
			//you don't need this, just used for changing background
			jQuery(function($) {
			 $('#btn-login-dark').on('click', function(e) {
				$('body').attr('class', 'login-layout');
				$('#id-text2').attr('class', 'white');
				$('#id-company-text').attr('class', 'blue');
				
				e.preventDefault();
			 });
			 $('#btn-login-light').on('click', function(e) {
				$('body').attr('class', 'login-layout light-login');
				$('#id-text2').attr('class', 'grey');
				$('#id-company-text').attr('class', 'blue');
				
				e.preventDefault();
			 });
			 $('#btn-login-blur').on('click', function(e) {
				$('body').attr('class', 'login-layout blur-login');
				$('#id-text2').attr('class', 'white');
				$('#id-company-text').attr('class', 'light-blue');
				
				e.preventDefault();
			 });
			 
			});
	</script>
</body>

</html>