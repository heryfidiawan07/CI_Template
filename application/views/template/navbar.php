<?php if ($auth): ?>
	<nav class="navbar mb-4 p-2">
	    <div class="container-fluid">
	        <i class="fas fa-align-justify text-muted bold" id="sidebar-btn-collapse"></i>
			<div class="dropdown">
				<a href="#" role="button" id="admin-online" data-toggle="dropdown">
                	<h6 class="pt-2 text-muted">
                		<i class="fas fa-user"></i>
                		<?= $auth[0]->user_name; ?>
						<i class="fas fa-caret-down"></i>
                	</h6>
				</a>
				<div class="dropdown-menu" aria-labelledby="admin-online">
					<a class="dropdown-item" href="<?= base_url().'logout'; ?>">Logout</a>
				</div>
			</div>
	    </div>
	</nav>
<?php endif ?>