<div class="container-fluid">
    
    <div class="row">
        <div class="col-md-12 pl-0 pr-0">
            <div class="card mb-2 border-unset p-0">
                <div class="card-body row">
                    <div class="col-md-4 text-center">
                        <h4 class="text-primary"><i class="far fa-credit-card"></i></h4>
                        <h1 class="total bold" data-count="387"></h1>
                        <p class="description-tabs text-muted">TOTAL</p>
                    </div>
                    <div class="col-md-4 text-center border-left">
                        <h4 class="text-success"><i class="far fa-credit-card"></i></h4>
                        <h1 class="total bold" data-count="300"></h1>
                        <p class="description-tabs text-muted">ACTIVE</p>
                    </div>
                    <div class="col-md-4 text-center border-left">
                        <h4 class="text-danger"><i class="far fa-credit-card"></i></h4>
                        <h1 class="total bold" data-count="87"></h1>
                        <p class="description-tabs text-muted">INACTIVE</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<input type="hidden" id="base_url" value="<?= base_url(); ?>">

<script type="text/javascript" src="<?= base_url().'assets/js/chart.js'; ?>"></script>
<script type="text/javascript" src="<?= base_url().'assets/js/dashboard.js'; ?>"></script>
