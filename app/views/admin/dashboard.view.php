<?php $this->view('admin/admin-header'); ?>

<div class="row">

    <div class="card bg-primary text-white text-center col-md-3 m-3 p-3">
            <h1 class="display-1"><?=$total_reports->total?></h1>
            <p>Broj aktivnih naloga</p>
    </div>

    <div class="card bg-success text-white text-center col-md-3 m-3 p-3">
        <h1 class="display-1"><?=$total_admins->total?></h1>
        <p>Broj administratora</p>
    </div>

</div>

<?php $this->view('admin/admin-footer'); ?>
