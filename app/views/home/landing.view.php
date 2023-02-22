<?php $this->view('home/home-header'); ?>

        <h1>Provjerite status Vašeg naloga</h1>
        <p class="lead text-black">Podatke potrebne za popunjavanje formulara možete pronaći na radnom nalogu</p>
        <p class="lead">
        <form class="row g-2" method="post" >
            <div class="col-md-5">
                <input type="text" class="form-control form-control-lg" id="exampleFormControlInput1" name="id" placeholder="Broj radnog naloga" required>
            </div>
            <div class="col-md-5">
                <input type="text" class="form-control form-control-lg" id="exampleFormControlInput1" name="phone_imei" placeholder="Serijski broj (IMEI)" required>
            </div>
            <div class="col-md-2">
                <a href="<?=ROOT?>/home" class="btn btn-lg">PROVJERI STATUS</a>
            </div>
        </form>
        </p>

<?php $this->view('home/home-footer'); ?>




