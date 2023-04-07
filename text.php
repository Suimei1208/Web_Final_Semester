<?php 
    require_once('API/connect.php');
    if(isset($_POST['search'])){
        $search = $_POST['search'];
    }
    $search_flim = getFlims($search);
    if(isset($search_flim)) {
        foreach($search_flim as $flim) {
            echo $flim['name_flim'];
        }
    }

?>
