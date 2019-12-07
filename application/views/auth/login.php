<script>
	$('#content').css('padding','0');
</script>
<link rel="stylesheet" href="<?= base_url().'assets/css/login.css'; ?>">

<div id="login-background">
	
	
	<div class="col-md-6 offset-md-3 pt-5">
		
		<div class="d-flex justify-content-center mb-4">
			<h1>CI TEMPLATE</h1>
		</div>

		<div class="card p-4">
			<div class="card-body">
				
				<h4 class="text-center"><b>THE TITLE</b></h4>
				<?= $this->session->flashdata('message'); ?>
				<form action="<?= base_url('login/login'); ?>" method="POST" id="flogin" name="flogin" class="flogin">
					<div class="form-group">
						<label>Username</label>
						<div class="input-group input-group--inline border-0">
							<input type="text" class="form-control" id="username" name="username" value="<?= set_value('username'); ?>" placeholder="Username" autofocus>
							<?= form_error('username', '<small class="text-danger">', '</small>'); ?>
						</div>
					</div>
					<div class="form-group">
						<div class="d-flex">
							<label>
								Password
								<i id="toggle-password" class="fas fa-eye-slash"></i>
							</label>
						</div>
						<div class="input-group input-group--inline border-0">
							<input type="password" class="form-control" id="password" name="password" value="" placeholder="Password">
							<?= form_error('password', '<small class="text-danger">', '</small>'); ?>
						</div>
					</div>
					<div class="text-center">
						<button id="btnLogin" type="submit" class="btn btn-primary btn-block">Login</button>
					</div>
				</form>
				<!-- <div class="d-flex mt-3 justify-content-center">
					<a href="#" data-toggle="modal" data-target="#modal-forgot-password"><span class="mr-2">Forgot your password?</span></a>
				</div> -->

			</div>
		</div>

	</div>
	
	
	<!-- Modal Forgot password -->
	<!-- <div id="modal-forgot-password" class="modal fade" tabindex="-1" role="dialog">
	    <div class="modal-dialog">
	        <form method="POST" id="form_forgot_password">
	            <div class="modal-content">
	                <div class="modal-header">
	                    <h4>Forgot Password</h4>
	                    <button type="button" class="close" data-dismiss="modal">&times;</button>
	                </div>
	                <div class="modal-body">
	                   	<label>Email</label>
                    	<input type="email" name="email" id="email" class="form-control">
	                </div>
	                <div class="modal-footer">
	                    <button type="submit" class="btn btn-success btn-sm" id="btn-create">Send Email</button>
	                    <button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Close</button>
	                </div>
	            </div>
	        </form>
	    </div>
	</div> -->
	<!-- End Modal Forgot Password -->


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
		});
	</script>

</div>