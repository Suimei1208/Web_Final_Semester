<?php 
    require_once('API/connect.php');
       $search_flim = getFlims_Genre('Action');
        if ($search_flim) {
            foreach($search_flim as $p){
                echo $p['name_flim'];
            }}

    
?>
