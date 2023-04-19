<?php 
    $ten = "Dungeons & Dragons: Honor Among Thieves";
    $kyTuDacBiet = array("&");
    $kyTuThayThe = array("\\&");
    $tenDaThemGachCheo = str_replace($kyTuDacBiet, $kyTuThayThe, $ten);
    echo $tenDaThemGachCheo;
    
    

?>