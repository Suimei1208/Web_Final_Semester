<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <?php       
        require_once('API/connect.php');
        $conn = connect();
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $name = '';
        $rate = '';
        $time = '';
        $year = '';
        $content = '';
        $director = '';
        $genre = getGenres();
        include 'component/header.php';
        if(isset($_POST['search'])){
            $search = $_POST['search'];  
            if(getFlims($search) == false){?>
                <main style="margin-top: 80px;">
                <?php include 'component/404.php';?>
                </main>      
            <?php }else{       
            $search_flim = getFlims($search);    
            ?>
            <main style="margin-top: 80px;">
            <div class="update content">
                <strong class="up">Search for: </strong> 
            </div>
        <?php 
        $rows = 4;
        $cols = 4;
        $count = 0;
        $total = count($search_flim);
        foreach($search_flim as $p){
            if($p['poster_small'] == null) $p['poster_small'] = 'fake.png';
            if($p['name_flim'] == null) $p['name_flim'] = 'Updating...';
            if ($count % $cols == 0) {
            echo '<div class="update">';
            }
        ?>              
            <div class="cell">
                <img src="./assets/img/<?=$p['poster_small']?>"/>
                <div class="user-info">
                    <span class="title"><?=$p['name_flim']?></p>
                    <span class="position">View: <?=number_format($p['view'])?></p>
                </div>
            </div>
        <?php
            $count++;
            if ($count % $cols == 0) {
                echo "</div>";
            }
            if ($count == $total) {
                echo "</div>";
            }
            if ($count == $rows * $cols) {
                break;
            }
        }       
}}
elseif(isset($_GET['genres'])){
    if(getFlims_Genre($_GET['genres']) == false){?>
        <main style="margin-top: 80px;">
        <?php include 'component/404.php';?>
        </main>      
    <?php }else{
    $search_flim = getFlims_Genre($_GET['genres']);   
    ?>
    <main style="margin-top: 80px;">
    <div class="update content">
        <strong class="up">Search for: </strong> 
    </div>
    <?php 
        $rows = 4;
        $cols = 4;
        $count = 0;
        $total = count($search_flim);
        foreach($search_flim as $p){
            if($p['poster_small'] == null) $p['poster_small'] = 'fake.png';
            if($p['name_flim'] == null) $p['name_flim'] = 'Updating...';
            if ($count % $cols == 0) {
            echo '<div class="update">';
            }
        ?>              
            <div class="cell">
                <img src="./assets/img/<?=$p['poster_small']?>"/>
                <div class="user-info">
                    <span class="title"><?=$p['name_flim']?></p>
                    <span class="position">View: <?=number_format($p['view'])?></p>
                </div>
            </div>
        <?php
            $count++;
            if ($count % $cols == 0) {
                echo "</div>";
            }
            if ($count == $total) {
                echo "</div>";
            }
            if ($count == $rows * $cols) {
                break;
            }
        }
    }}
    ?>
            </main>
           
</body>
<?php 
 include 'component/footer.php';
?>
<script 
src="assets/js/script.js">     
</script>