<?php 
    require_once('API/connect.php');
    if(isset($_GET['genres'])){
        $name = $_GET['genres'];
        $genre = "$name";
        echo $genre;
        $search_flim = getFlims_Genre($genre);
        if ($search_flim) {
            foreach($search_flim as $p){
                echo $p['name_flim'];
            }}
        } 
    
?>
