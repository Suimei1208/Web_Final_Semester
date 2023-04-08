<?php 
    require_once('API/connect.php');
    if(getFlims_Genre('Sport') == false){
        echo "loi";
        header("HTTP/1.0 404 Not Found");
   }
       $search_flim = getFlims_Genre('Sport');
       
       
       echo $search_flim;
        if ($search_flim) {
            foreach($search_flim as $p){
                echo $p['name_flim'];
            }}  
?>
