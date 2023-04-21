<?php
    include('API/connect.php');
    $s = get_rate_username("admin", "Solo Leveling");
    if($s == true) echo 'done';
    else echo 'error';

?>
