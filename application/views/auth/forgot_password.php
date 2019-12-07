<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= $title; ?></title>
    <meta name="robots" content="noindex">
    <link type="text/css" href="<?= base_url(); ?>/assets/reference/css/app.css" rel="stylesheet">
    <link type="text/css" href="<?= base_url(); ?>/assets/reference/css/app.rtl.css" rel="stylesheet">
    <link type="text/css" href="<?= base_url(); ?>/assets/reference/vendor/simplebar.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
	<style>
		body{
			font-family: 'Source Sans Pro', sans-serif !important;
			background: #fff !important;
		}

		.form-group{
			border: 1px solid #eee;
			padding: 5px 25px;
		}

		label{
			font-size: 11px;
			font-weight: 500;
			color: #888;
			text-transform: uppercase;
			margin:0 !important;
			padding:0 !important;
		}

		.input-group{
			border: none !important;
			font-weight: 600;
		}

		.form-control{
			border: none !important;
			padding: 2px 0;
			margin: 0;
			font-weight: 600;
			font-size: 14px;
			color: #000 !important;
			padding:5px 0 !important;
		}

		.form-control:focus{
			box-shadow: none !important;
		}

		#btnLogin {
			height: 50px !important;
			background: #00aeef !important;
			border: 0 !important;
			font-weight: 600;
			margin-top:40px !important;
		}

		.field-icon {
			float: right;margin-right: 
			0px;margin-top: 
			5px;position: relative;
			z-index: 2;
			color: #888 ; 
		}
	</style>
</head>

<body style="background:url('<?= base_url(); ?>/assets/reference/images/MARITIME-PORTS.jpg') !important; background-size:cover !important;">
	<div class="mdk-drawer-layout js-mdk-drawer-layout" data-fullbleed data-push data-has-scrolling-region>
		<div class="mdk-drawer-layout__content mdk-header-layout__content--scrollable" style="overflow-y: auto;" data-simplebar data-simplebar-force-enabled="true">
			<div class="container h-vh d-flex justify-content-center align-items-center flex-column">
				<div class="d-flex justify-content-center align-items-center mb-3">
					<a href="index.html" class="mr-2">
						<img src="<?= base_url(); ?>/assets/reference/images/ILCS-LOGO-4.png" height="55px">
					</a>
				</div>
				<!-- <h2 class="ml-2 text-bg mb-0"><strong>Welcome</strong></h2> -->
				<div class="row w-100">
					<div class="card card-form col-md-6 border-0" style="padding:0px !important;margin: 0px auto auto;">
						<div class="card-body">
							<h4 style="text-align: center;font-weight: 700;font-size: 24px;color: #6c7592;">BUFFER AREA SYSTEM</h4>
							<?= $this->session->flashdata('message'); ?>
							<form class="user" method="POST" action="<?= base_url('forgot_password/send_mail'); ?>">
								<div class="form-group">
									<input type="email" name="email" class="form-control form-control-user" id="email" placeholder="Enter Email Address..." value="<?= set_value('email'); ?>">
									<?= form_error('email', '<small class="text-danger">', '</small>'); ?>
								</div>
								<button type="submit" class="btn btn-primary btn-user btn-block">
								Send Mail
								</button>
							</form>
							<div class="d-flex mt-3 justify-content-center">
								<a href="<?= base_url('login'); ?>"><span class="mr-2">Login</span></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal Forgot password -->
	<div class="modal fade" id="modalForgot" tabindex="-1" role="dialog" aria-labelledby="exampleAlertModalLabel1" aria-hidden="true">
		<div class="modal-dialog modal-md" role="document">
			<div class="modal-content">
				<form id="fforgotpassword" method="post">
				<div class="modal-header">
					<h3 class="modal-title" id="exampleAlertModalLabel1">Forgot password</h3>
				</div>
				<div class="modal-body">
					<div class="col-md-12">
					<div class="form-group">
						<label>Username</label>
						<div class="input-group input-group--inline border-0">
							<input type="text" class="form-control" id="usernameForgot" name="usernameForgot" value="" placeholder="Username">
						</div>
						<label id="WarnusernameForgot" style="color: red; display: none;"><i class="fa fa-exclamation-circle"></i> Required field.</label>
					</div>
					</div><br>
					<div class="col-md-12">
					<div class="form-group">
						<label>Email</label>
						<div class="input-group input-group--inline border-0">
							<input type="text" class="form-control" id="emailForgot" name="emailForgot" value="" placeholder="Email">
						</div>
						<label id="WarnemailForgot" style="color: red; display: none;"><i class="fa fa-exclamation-circle"></i> Required field.</label>
					</div>
					</div><br>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-success textOrigin" id="btnSavepassword">OK</button>
					<button type="button" class="btn btn-secondary textOrigin" data-dismiss="modal">Cancel</button>
				</div>
				</form>
			</div>
		</div>
	</div>

    <script src="<?= base_url(); ?>/assets/reference/vendor/jquery.min.js"></script>
    <script src="<?= base_url(); ?>/assets/reference/vendor/bootstrap.min.js"></script>
	<script src="<?= base_url(); ?>/assets/js/login.js"></script>
</body>

</html>
