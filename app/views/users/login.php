<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="row pb-5">
    <div class="col-md-6 mx-auto">
        <div class="card card-body bg-dark text-white mt-5">
            <?php flash('register_success'); ?>
            <h2>Bejelentkezés</h2>
            <p>Ha már rendelkezik felhasználói fiókkal</p>
            <form action="<?php echo URLROOT; ?>/users/login" method="POST">
                <div class="form-group row p-3">
                    <label for="email">Email <sup>*</sup></label>
                    <input class="form-control form-control-lg" name="email" value="<?php echo $data['email']; ?>" placeholder="Email cím..." type="email" required>
                    <span id="email" class="text-warning"><?php echo $data['email_err']; ?></span>
                </div>
                <div class="form-group row p-3">
                    <label for="password">Jelszó <sup>*</sup></label>
                    <input class="form-control form-control-lg" name="password" value="<?php echo $data['password']; ?>" placeholder="Jelszó..." type="password" required>
                    <span id="pass" class="text-warning"><?php echo $data['pass_err']; ?></span>
                </div>
                <div class="row">
                    <div class="col">
                        <input type="submit" class="btn btn-success mb-2 btn-block" value="Belépés!">
                    </div>
                    <div class="col">
                        <a href="<?php echo URLROOT; ?>/users/register" class="btn btn-warning btn-block">Nincs még felhasználói fiókja?</a>
                    </div>
                </div>                
            </form>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>