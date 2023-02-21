<?php $this->view('admin/admin-header'); ?>

<?php if($action == 'new'):?>

    <div class="col-md-6 mx-auto p-3">

        <h3>Dodaj administratora</h3>

        <?php  if (!empty($errors)):?>
            <div class="alert alert-danger text-center"><?=implode("<br>", $errors)?></div>
        <?php endif;?>

        <form method="post">
            <input value="<?=old_value('username')?>" type="text" class="form-control mt-3" name="username" placeholder="Korisničko ime" autofocus>
            <input value="<?=old_value('email')?>" type="email" class="form-control mt-3" name="email" placeholder="Email">
            <input value="<?=old_value('password')?>" type="text" class="form-control mt-3" name="password" placeholder="Lozinka">

            <button class="btn btn-primary my-3">Spremi</button>

            <a href="<?=ROOT?>/admin/admins">
                <button type="button" class="float-end btn btn-secondary my-3">Odustani</button>
            </a>
        </form>

    </div>

<?php elseif($action == 'edit'):?>

    <div class="col-md-6 mx-auto p-3">

        <h3>Uredi administratora</h3>

        <?php  if (!empty($errors)):?>
            <div class="alert alert-danger text-center"><?=implode("<br>", $errors)?></div>
        <?php endif;?>

        <?php if (!empty($row)):?>
            <form method="post">
                <input value="<?=old_value('username', $row->username)?>" type="text" class="form-control mt-3" name="username" placeholder="Korisničko ime" autofocus>
                <input value="<?=old_value('email', $row->email)?>" type="email" class="form-control mt-3" name="email" placeholder="Email">
                <input value="<?=old_value('password')?>" type="text" class="form-control mt-3" name="password" placeholder="Lozinka (ostavite prazno da zadržite staru lozinku)">

                <button class="btn btn-primary my-3">Spremi</button>

                <a href="<?=ROOT?>/admin/admins">
                    <button type="button" class="float-end btn btn-secondary my-3">Odustani</button>
                </a>
            </form>
        <?php else:?>
            <div class="alert alert-danger text-center">Odabir nije pronađen</div>
            <a href="<?=ROOT?>/admin/admins">
                <button type="button" class="float-end btn btn-secondary my-3">Nazad</button>
            </a>
        <?php endif;?>

    </div>

<?php elseif($action == 'delete'):?>

    <div class="col-md-6 mx-auto p-3">

        <h3>Ukloni administratora</h3>

        <?php  if (!empty($errors)):?>
            <div class="alert alert-danger text-center"><?=implode("<br>", $errors)?></div>
        <?php endif;?>

        <?php if (!empty($row)):?>
            <form method="post">
                <div class="form-control mt-3"><?=old_value('username', $row->username)?></div>
                <div class="form-control mt-3"><?=old_value('email', $row->email)?></div>

                <button class="btn btn-danger my-3">Delete</button>

                <a href="<?=ROOT?>/admin/admins">
                    <button type="button" class="float-end btn btn-secondary my-3">Odustani</button>
                </a>
            </form>
        <?php else:?>
            <div class="alert alert-danger text-center">Odabir nije pronađen</div>
            <a href="<?=ROOT?>/admin/admins">
                <button type="button" class="float-end btn btn-secondary my-3">Nazad</button>
            </a>
        <?php endif;?>

    </div>

<?php else:?>

    <h3>
        Lista aktivnih administratora
        <a href="<?=ROOT?>/admin/admins/new">
            <button class="btn btn-primary">Dodaj</button>
        </a>
    </h3>

    <table class="table table-striped table-bordered">
        <tr>
            <th>#</th>
            <th>Korisničko ime</th>
            <th>Email</th>
            <th>Radnja</th>
        </tr>

        <?php if(!empty($rows)):?>
            <?php foreach($rows as $row):?>
                <tr>
                    <td><?=$row->id?></td>
                    <td><?=$row->username?></td>
                    <td><?=$row->email?></td>
                    <td>
                        <a href="<?=ROOT?>/admin/admins/edit/<?=$row->id?>">
                            <button class="btn btn-primary">Uredi</button>
                        </a>
                        <a href="<?=ROOT?>/admin/admins/delete/<?=$row->id?>">
                            <button class="btn btn-danger">Ukloni</button>
                        </a>
                    </td>
                </tr>
            <?php endforeach;?>
        <?php endif;?>
    </table>
<?php endif;?>

<?php $this->view('admin/admin-footer'); ?>