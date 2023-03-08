
<?php

    include "../connect.php";

    include "../Model/ModelChangePassword.php";

    $passwordOld = isset($_POST['passwordOld'])?$_POST['passwordOld']:'';
    $passwordNew = isset($_POST['passwordNew'])?$_POST['passwordNew']:'';
    $admin = isset($_POST['admin'])?$_POST['admin']:'';

    $change = new ChangePassword();

    $change->changePassword('tb_admin', $conn, $passwordOld, $passwordNew, $admin);

?>