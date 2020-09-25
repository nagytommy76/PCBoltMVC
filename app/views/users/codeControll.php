<?php require HEADER; ?>

<div class="row pt-5 pb-5 w-100">
    <div class="col-md-5 mx-auto">
        <div class="card card-header bg-dark text-white">
            <h1>Regisztráció hitelesítése</h1>
            <p>Kérem adja meg az email címére küldött ellenörző kódot</p>
            <hr>
        </div>
        <div class="card card-body bg-light">
            <form action="<?php echo URLROOT; ?>/users/codeControll" method="POST">
                <label for="code">Regisztrációs kód: </label>
                <input class="form-control" placeholder="Kód helye..." type="text" name="code" value="<?php echo $data['fromEmailCode']; ?>">
                <input type="submit" class="btn btn-success mt-2" value="Regisztráció">
            </form>
        </div>
    </div>
</div>

<?php require FOOTER; ?>