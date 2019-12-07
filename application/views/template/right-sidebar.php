<!-- Modal -->
<div class="modal right fade" id="right-sidebar" tabindex="-1" role="dialog" aria-labelledby="right-sidebar">
	<div class="modal-dialog" role="document">
		<div class="modal-content">

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>

			<div class="modal-body">
                <div class="profile mb-2 text-center">
                    <i class="fas fa-user fa-3x"></i>
                    <h5 class="mt-2"><?= $auth[0]->name; ?></h5>
                </div>
                <a href="<?= base_url('logout'); ?>" class="logout">Logout</a>
                <a href="#" data-dismiss="modal" aria-label="Close" class="logout">Close</a>
			</div>

		</div><!-- modal-content -->
	</div><!-- modal-dialog -->
</div><!-- modal -->
	
