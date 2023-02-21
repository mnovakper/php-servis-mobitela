<?php $this->view('admin/admin-header'); ?>

<?php if($action == 'new'):?>

    <div class="col-md-6 mx-auto p-3">

        <h3>Dodaj nalog</h3>

        <?php  if (!empty($errors)):?>
            <div class="alert alert-danger text-center"><?=implode("<br>", $errors)?></div>
        <?php endif;?>

        <form method="post">
            <input value="<?=old_value('name_surname')?>" type="text" class="form-control mt-3" name="name_surname" placeholder="Ime i prezime" autofocus>
            <input value="<?=old_value('address')?>" type="text" class="form-control mt-3" name="address" placeholder="Adresa stanovanja">
            <input value="<?=old_value('contact_number')?>" type="text" class="form-control mt-3" name="contact_number" placeholder="Broj telefona">
            <input value="<?=old_value('email')?>" type="email" class="form-control mt-3" name="email" placeholder="Email">
            <input value="<?=old_value('phone_model')?>" type="text" class="form-control mt-3" name="phone_model" placeholder="Proizvođač i model uređaja">
            <input value="<?=old_value('phone_imei')?>" type="text" class="form-control mt-3" name="phone_imei" placeholder="IMEI uređaja">
            <input value="<?=old_value('phone_damage')?>" type="text" class="form-control mt-3" name="phone_damage" placeholder="Vidljiva oštećenja">
            <input value="<?=old_value('phone_malfunction')?>" type="text" class="form-control mt-3" name="phone_malfunction" placeholder="Opis kvara">
            <input value="<?=old_value('phone_status')?>" type="text" class="form-control mt-3" name="phone_status" placeholder="Status uređaja (u obradi / gotovo)">

            <button class="btn btn-primary my-3">Spremi</button>

            <a href="<?=ROOT?>/admin/reports">
                <button type="button" class="float-end btn btn-secondary my-3">Odustani</button>
            </a>
        </form>

    </div>

<?php elseif($action == 'edit'):?>

    <div class="col-md-6 mx-auto p-3">

        <h3>Uredi nalog</h3>

        <?php  if (!empty($errors)):?>
            <div class="alert alert-danger text-center"><?=implode("<br>", $errors)?></div>
        <?php endif;?>

        <?php if (!empty($row)):?>
            <form method="post">
                <input value="<?=old_value('name_surname', $row->name_surname)?>" type="text" class="form-control mt-3" name="name_surname" placeholder="Ime i prezime">
                <input value="<?=old_value('address', $row->address)?>" type="text" class="form-control mt-3" name="address" placeholder="Adresa stanovanja">
                <input value="<?=old_value('contact_number', $row->contact_number)?>" type="text" class="form-control mt-3" name="contact_number" placeholder="Broj telefona">
                <input value="<?=old_value('email', $row->email)?>" type="email" class="form-control mt-3" name="email" placeholder="Email">
                <input value="<?=old_value('phone_model', $row->phone_model)?>" type="text" class="form-control mt-3" name="phone_model" placeholder="Proizvođač i model uređaja">
                <input value="<?=old_value('phone_imei', $row->phone_imei)?>" type="text" class="form-control mt-3" name="phone_imei" placeholder="IMEI uređaja">
                <input value="<?=old_value('phone_damage', $row->phone_damage)?>" type="text" class="form-control mt-3" name="phone_damage" placeholder="Vidljiva oštećenja">
                <input value="<?=old_value('phone_malfunction', $row->phone_malfunction)?>" type="text" class="form-control mt-3" name="phone_malfunction" placeholder="Opis kvara">
                <input value="<?=old_value('phone_status', $row->phone_status)?>" type="text" class="form-control mt-3" name="phone_status" placeholder="Status uređaja (u obradi / gotovo)">

                <button class="btn btn-primary my-3">Spremi</button>

                <a href="<?=ROOT?>/admin/reports">
                    <button type="button" class="float-end btn btn-secondary my-3">Odustani</button>
                </a>
            </form>
        <?php else:?>
            <div class="alert alert-danger text-center">Odabir nije pronađen</div>
            <a href="<?=ROOT?>/admin/reports">
                <button type="button" class="float-end btn btn-secondary my-3">Nazad</button>
            </a>
        <?php endif;?>

    </div>

<?php elseif($action == 'delete'):?>

    <div class="col-md-6 mx-auto p-3">

        <h3>Izbriši nalog</h3>

        <?php  if (!empty($errors)):?>
            <div class="alert alert-danger text-center"><?=implode("<br>", $errors)?></div>
        <?php endif;?>

        <?php if (!empty($row)):?>
            <form method="post">
                <div class="form-control mt-3"><?=old_value('name_surname', $row->name_surname)?></div>
                <div class="form-control mt-3"><?=old_value('address', $row->address)?></div>
                <div class="form-control mt-3"><?=old_value('contact_number', $row->contact_number)?></div>
                <div class="form-control mt-3"><?=old_value('email', $row->email)?></div>
                <div class="form-control mt-3"><?=old_value('phone_model', $row->phone_model)?></div>
                <div class="form-control mt-3"><?=old_value('phone_imei', $row->phone_imei)?></div>
                <div class="form-control mt-3"><?=old_value('phone_damage', $row->phone_damage)?></div>
                <div class="form-control mt-3"><?=old_value('phone_malfunction', $row->phone_malfunction)?></div>
                <div class="form-control mt-3"><?=old_value('phone_status', $row->phone_status)?></div>
                <div class="form-control mt-3"><?=old_value('date', $row->date)?></div>

                <button class="btn btn-danger my-3">Delete</button>

                <a href="<?=ROOT?>/admin/reports">
                    <button type="button" class="float-end btn btn-secondary my-3">Odustani</button>
                </a>
            </form>
        <?php else:?>
            <div class="alert alert-danger text-center">Odabir nije pronađen</div>
            <a href="<?=ROOT?>/admin/reports">
                <button type="button" class="float-end btn btn-secondary my-3">Nazad</button>
            </a>
        <?php endif;?>

    </div>

<?php else:?>

    <h3>
        Lista aktivnih naloga
        <a href="<?=ROOT?>/admin/reports/new">
            <button class="btn btn-primary">Dodaj</button>
        </a>
    </h3>

    <table class="table table-striped table-bordered">
        <tr>
            <th>#</th>
            <th>Ime i prezime</th>
            <th>Telefon</th>
            <th>E-mail</th>
            <th>Model uređaja</th>
            <th>Datum zaprimanja</th>
            <th>Status</th>
            <th>Opcije</th>
        </tr>

        <?php if(!empty($rows)):?>
            <?php foreach($rows as $row):?>
                <tr>
                    <td><?=$row->id?></td>
                    <td><?=$row->name_surname?></td>
                    <td><?=$row->contact_number?></td>
                    <td><?=$row->email?></td>
                    <td><?=$row->phone_model?></td>
                    <td><?=$row->date?></td>
                    <td><?=$row->phone_status?></td>
                    <td>
                        <a href="<?=ROOT?>/admin/reports/edit/<?=$row->id?>">
                            <button class="btn btn-primary">Uredi</button>
                        </a>
                        <a href="<?=ROOT?>/admin/reports/delete/<?=$row->id?>">
                            <button class="btn btn-danger">Ukloni</button>
                        </a>
                    </td>
                </tr>
            <?php endforeach;?>
        <?php endif;?>
    </table>
<?php endif;?>

<?php $this->view('admin/admin-footer'); ?>
