<div class="container-fluid">
    
    <!-- Content -->    
    <div class="row mb-2">
        <div class="col-md-12 pl-0 pr-0">
            <div class="card mb-3 border-unset p-0">
                <div class="card-body row">
                    <div class="col-md-4 text-center">
                        <h4 class="text-primary"><i class="fas fa-user-cog"></i></h4>
                        <h1 class="total bold" data-count="<?= $all; ?>"></h1>
                        <p class="description-tabs text-muted">
                            TOTAL |<button class="get_data_role border-unset bg-unset text-muted" data-status="">SHOW</button>
                        </p>
                    </div>
                    <div class="col-md-4 text-center border-left">
                        <h4 class="text-success"><i class="fas fa-user-cog"></i></h4>
                        <h1 class="total bold" data-count="<?= $active; ?>"></h1>
                        <p class="description-tabs text-muted">
                            ACTIVE |<button class="get_data_role border-unset bg-unset text-muted" data-status="1">SHOW</button>
                        </p>
                    </div>
                    <div class="col-md-4 text-center border-left">
                        <h4 class="text-danger"><i class="fas fa-user-cog"></i></h4>
                        <h1 class="total bold" data-count="<?= $inactive; ?>"></h1>
                        <p class="description-tabs text-muted">
                            INACTIVE |<button class="get_data_role border-unset bg-unset text-muted" data-status="'0'">SHOW</button>
                        </p>
                    </div>
                </div>
                </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-12 pl-0 pr-0">
            <div class="card border-unset">
                <div class="card-body row">
                    <h4 class="col-md-9 bold"><?= $title; ?></h4>
                    <button class="col-md-3 btn btn-add create font-12" data-toggle="modal" data-target="#modal-create">
                        <i class="fas fa-plus mr-2"></i> ADD ROLE
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="card p-3 col-md-12">
            <div class="table-responsive">
                <table id="role_table" class="table table-hover font-12">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NAME</th>
                            <th>STATUS</th>
                            <th>MENU ACCESS</th>
                            <th>DETAILS</th>
                            <th>EDIT</th>
                            <th>DELETE</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    <!-- End Content -->

</div>

<input type="hidden" id="base_url" value="<?= base_url(); ?>">

<?php 
    include('modal_edit.php');
    include('modal_create.php');
    include('modal_delete.php');
    include('modal_role_details.php'); 
?>

<script type="text/javascript" src="<?= base_url().'assets/js/role.js'; ?>"></script>
