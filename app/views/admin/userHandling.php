<?php require HEADER; ?>    
    
        <h1 class="h1 mb-5 mt-5 text-center">A felhasználók kezelése, Törlése, Módosítása</h1>
        <div class="container">
            <?php 
                flash('modosit_siker');
                flash('deleted');
            ?>
        </div>
        <table class="table table-hover table-sm bg-warning mb-5 ">
            <thead>
                <tr>
                    <th scope="col">Művelet: </th>
                    <th scope="col">Email: </th>
                    <th scope="col">Felhasználó: </th>                           
                    <th scope="col">Jog: </th>                    
                </tr>
            </thead>
            <tbody>
                <?php foreach($data['userinfo'] as $user) : ?>
                <tr class="table-warning">
                    <td>
                        <div class="form-row">
                            <form action="<?php echo URLROOT; ?>/admins/deleteUser/<?php echo $user->email1; ?>/<?php echo $user->telefon; ?>" method="POST">
                                <input type="submit" value="Törlés" class="btn btn-danger btn-sm">
                            </form>
                            <form action="<?php echo URLROOT; ?>/admins/editUser/<?php echo $user->email1;?>/<?php echo $user->username; ?>" method="POST">
                                <input type="submit" name="updateBTN" value="Módosítás" class="btn btn-warning btn-sm">
                            </form>
                        </div>
                    </td>
                    <td><?php echo $user->email1; ?></td>
                    <td><?php echo $user->username; ?></td>
                    <td><?php echo $user->jogosultsag; ?></td>                                     
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>  
    
<?php require FOOTER; ?>