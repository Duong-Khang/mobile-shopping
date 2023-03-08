<?php

    include "../connect.php";
    
    include "../Model/ModelDeleteUser.php";

    $user_id = isset($_GET['user_id'])?$_GET['user_id']:'';

    $de = new DeleteUser();

    $de->removeUser('user', $conn, $user_id);

?>