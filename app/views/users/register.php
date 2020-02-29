<?php require HEADER; ?>

<div class="row pb-5">
    <div class="col-lg-6 mx-auto pt-5">
        <div class="card card-body bg-dark text-white">
            <?php flash('register_failed'); ?>
            <?php flash('code_error'); ?>
            <h2>Regisztráció</h2>
            <p>Ha még nem rendelkezik felhasználói fiókkal kérem töltse ki a beviteli mezőket</p>
            <form action="<?php echo URLROOT; ?>/users/register" method="POST">
                <div class="form-group row p-3">
                    <label for="username">Felhasználónév <sup>*</sup></label>
                    <input class="form-control form-control-lg" name="username"  value="<?php echo $data['username']; ?>"  placeholder="Felhasználónév..." type="text" required>        
                </div>
                <div class="form-group row p-3">
                    <label for="email">Email <sup>*</sup></label>
                    <input class="form-control form-control-lg" name="email" value="<?php echo $data['email']; ?>" placeholder="Email cím..." type="email" required>
                    <span class="text-warning"><?php echo $data['email_err']; ?></span>
                </div>
                <div class="form-group row p-3">
                    <label for="password">Jelszó <sup>*</sup></label>
                    <input class="form-control form-control-lg" name="password" value="<?php echo $data['password']; ?>" placeholder="Jelszó..." type="password" required>
                </div>
                <div class="form-group row p-3">
                    <label for="password2">Jelszó újra <sup>*</sup></label>
                    <input class="form-control form-control-lg" name="password2" placeholder="Jelszó újra..." value="<?php echo $data['confirm_password']; ?>" type="password" required>            
                    <span id="pass" class="text-warning"><?php echo $data['passwords'] ?></span>
                </div>
                <div class="row">
                    <div class="col">
                        <input type="submit" class="btn btn-success mb-2 btn-block" value="Regisztráció!">
                    </div>
                    <div class="col">
                        <a href="<?php echo URLROOT; ?>/users/login" class="btn btn-warning btn-block">Már van felhasználói fiókja?</a>
                    </div>
                </div>  
            </form>
        </div>
    </div>
</div>

<?php require FOOTER; ?>