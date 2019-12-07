<script>
	$('#content').css('padding','0');
</script>
<link rel="stylesheet" href="<?= base_url().'assets/css/login.css'; ?>">

<div id="register-background">
	
	
	<div class="col-md-6 offset-md-3 pt-5 pb-5">
		
		<div class="d-flex justify-content-center mb-4">
			<h1>CI TEMPLATE</h1>
		</div>

		<div class="card p-4">
			<div class="card-body">
				
				<h4 class="text-center"><b>THE TITLE</b></h4>
				<?= $this->session->flashdata('message'); ?>
				<form action="<?= base_url('register/register'); ?>" method="POST" id="form_register">
					<div class="form-group">
						<label>Name</label>
						<?= form_error('name', '<small class="text-danger">', '</small>'); ?>
						<div class="input-group input-group--inline border-0">
							<input type="text" class="form-control" id="name" name="name" value="<?= set_value('name'); ?>" placeholder="Name" required autofocus>
						</div>
					</div>
					<div class="form-group">
						<label>Username</label>
						<?= form_error('username', '<small class="text-danger">', '</small>'); ?>
						<div class="input-group input-group--inline border-0">
							<input type="text" class="form-control" id="username" name="username" value="<?= set_value('username'); ?>" placeholder="Username" required autofocus>
						</div>
					</div>
					<div class="form-group">
						<label>Email</label>
						<?= form_error('email', '<small class="text-danger">', '</small>'); ?>
						<div class="input-group input-group--inline border-0">
							<input type="text" class="form-control" id="email" name="email" value="<?= set_value('email'); ?>" placeholder="Email" required autofocus>
						</div>
					</div>
					<div class="form-group">
						<label>
							Password
							<i id="toggle-password" class="fas fa-eye-slash"></i>
						</label>
						<?= form_error('password', '<small class="text-danger">', '</small>'); ?>
						<div class="input-group input-group--inline border-0">
							<input type="password" class="form-control" id="password" name="password" value="" placeholder="Password" required>
						</div>
					</div>
					<div class="form-group">
						<label>
							Repeat password
							<i id="toggle-repassword" class="fas fa-eye-slash"></i>
						</label>
						<?= form_error('password', '<small class="text-danger">', '</small>'); ?>
						<div class="input-group input-group--inline border-0">
							<input type="password" class="form-control" id="repeat_password" name="repeat_password" value="" placeholder="Repeat password" required>
						</div>
					</div>
					<div class="text-center">
						<button id="btnLogin" type="submit" class="btn btn-primary btn-block">Register</button>
					</div>
				</form>
				<!-- <div class="d-flex mt-3 justify-content-center">
					<a href="#" data-toggle="modal" data-target="#modal-forgot-password"><span class="mr-2">Forgot your password?</span></a>
				</div> -->

			</div>
		</div>

	</div>

	<script type="text/javascript">
		$(document).ready(function() {
			// Prevent space username input
		    var usernameInput = document.querySelector('[name="username"]');

		    usernameInput.addEventListener('keypress', function ( event ) {
				var key = event.keyCode;
				if (key === 32) {
					event.preventDefault();
				}
		    });
		    $('#username').keyup(function(){
		        $(this).val($(this).val().toLowerCase());
		    });
		    $('#email').keyup(function(){
		        $(this).val($(this).val().toLowerCase());
		    });

		    $(document).on('submit', '#form_register', function(e) {
		    	var password = $('#password').val();
			    var repass   = $('#repeat_password').val();
			    if (password != repass) {
			    	e.preventDefault();
			    	alert('Password dont match with repeat password !');
			    }
		    });

		    // toggle password
		    const tooglePassword = document.getElementById("toggle-password");
			var passwordInput = document.getElementById("password");
			tooglePassword.addEventListener('click', function(e) {
				if (passwordInput.type === "password") {
					passwordInput.type = "text";
					tooglePassword.className = 'fas fa-eye';
				} else {
					passwordInput.type = "password";
					tooglePassword.className = 'fas fa-eye-slash';
				}
			});

			// toggle repassword
		    const tooglerePassword = document.getElementById("toggle-repassword");
			var repasswordInput = document.getElementById("repeat_password");
			tooglerePassword.addEventListener('click', function(e) {
				if (repasswordInput.type === "password") {
					repasswordInput.type = "text";
					tooglerePassword.className = 'fas fa-eye';
				} else {
					repasswordInput.type = "password";
					tooglerePassword.className = 'fas fa-eye-slash';
				}
			});
		});
	</script>

</div>