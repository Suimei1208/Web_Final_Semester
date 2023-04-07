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
            
            $search_flim = getFlims($search);
            
            ?>
            <main style="margin-top: 80px;">
            <div class="update content">
                <strong class="up">Search for: </strong> 
            </div>
            <div class="update">
            <?php
                $count = 0;
                foreach($search_flim as $p){
                    $count++;
                    if($count===5) break;
                    if($p['poster_small'] == null) $p['poster_small'] = 'fake.png';
                    if($p['name_flim'] == null) $p['name_flim'] = 'Updating...';
            ?>     
                    <div class="cell">
                        <img src="./assets/img/<?=$p['poster_small']?>"/>
                        <div class="user-info">
                            <span class="title"><?=$p['name_flim']?></p>
                            <span class="position">View: <?=number_format($p['view'])?></p>
                        </div>
                    </div>
                
                <?php             
                }
                ?>
            </div>
            
            <div class="update">
            <?php
                $count = 0;
                foreach($search_flim as $p){
                    $count++;
                    if($count <5) continue;
                    if($count===9) break;
                    if($p['poster_small'] == null) $p['poster_small'] = 'fake.png';
                    if($p['name_flim'] == null) $p['name_flim'] = 'Updating...';
            ?>     
                    <div class="cell">
                        <img src="./assets/img/<?=$p['poster_small']?>"/>
                        <div class="user-info">
                            <span class="title"><?=$p['name_flim']?></p>
                            <span class="position">View: <?=number_format($p['view'])?></p>
                        </div>
                    </div>
                
                <?php             
                }
                ?>
            </div>

            <div class="update">
            <?php
                $count = 0;
                foreach($search_flim as $p){
                    $count++;
                    if($count <9) continue;
                    if($count===13) break;
                    if($p['poster_small'] == null) $p['poster_small'] = 'fake.png';
                    if($p['name_flim'] == null) $p['name_flim'] = 'Updating...';
            ?>     
                    <div class="cell">
                        <img src="./assets/img/<?=$p['poster_small']?>"/>
                        <div class="user-info">
                            <span class="title"><?=$p['name_flim']?></p>
                            <span class="position">View: <?=number_format($p['view'])?></p>
                        </div>
                    </div>
                
                <?php             
                }
                ?>
            </div>

            <div class="update">
            <?php
                $count = 0;
                foreach($search_flim as $p){
                    $count++;
                    if($count <13) continue;
                    if($count===17) break;
                    if($p['poster_small'] == null) $p['poster_small'] = 'fake.png';
                    if($p['name_flim'] == null) $p['name_flim'] = 'Updating...';
            ?>     
                    <div class="cell">
                        <img src="./assets/img/<?=$p['poster_small']?>"/>
                        <div class="user-info">
                            <span class="title"><?=$p['name_flim']?></p>
                            <span class="position">View: <?=number_format($p['view'])?></p>
                        </div>
                    </div>
                
                <?php             
                }
                ?>
            </div>
<?php   
}
elseif(isset($_GET['genres'])){
    $search_flim = getFlims_Genre($_GET['genres']);
?>

    ?>
    <main style="margin-top: 80px;">
    <div class="update content">
        <strong class="up">Search for: </strong> 
    </div>
    <div class="update">
    <?php
        $count = 0;
        foreach($search_flim as $p){
            $count++;
            if($count===5) break;
            if($p['poster_small'] == null) $p['poster_small'] = 'fake.png';
            if($p['name_flim'] == null) $p['name_flim'] = 'Updating...';
    ?>     
            <div class="cell">
                <img src="./assets/img/<?=$p['poster_small']?>"/>
                <div class="user-info">
                    <span class="title"><?=$p['name_flim']?></p>
                    <span class="position">View: <?=number_format($p['view'])?></p>
                </div>
            </div>
        
        <?php             
        }
        ?>
    </div>
    
    <div class="update">
    <?php
        $count = 0;
        foreach($search_flim as $p){
            $count++;
            if($count <5) continue;
            if($count===9) break;
            if($p['poster_small'] == null) $p['poster_small'] = 'fake.png';
            if($p['name_flim'] == null) $p['name_flim'] = 'Updating...';
    ?>     
            <div class="cell">
                <img src="./assets/img/<?=$p['poster_small']?>"/>
                <div class="user-info">
                    <span class="title"><?=$p['name_flim']?></p>
                    <span class="position">View: <?=number_format($p['view'])?></p>
                </div>
            </div>
        
        <?php             
        }
        ?>
    </div>

    <div class="update">
    <?php
        $count = 0;
        foreach($search_flim as $p){
            $count++;
            if($count <9) continue;
            if($count===13) break;
            if($p['poster_small'] == null) $p['poster_small'] = 'fake.png';
            if($p['name_flim'] == null) $p['name_flim'] = 'Updating...';
    ?>     
            <div class="cell">
                <img src="./assets/img/<?=$p['poster_small']?>"/>
                <div class="user-info">
                    <span class="title"><?=$p['name_flim']?></p>
                    <span class="position">View: <?=number_format($p['view'])?></p>
                </div>
            </div>
        
        <?php             
        }
        ?>
    </div>

    <div class="update">
    <?php
        $count = 0;
        foreach($search_flim as $p){
            $count++;
            if($count <13) continue;
            if($count===17) break;
            if($p['poster_small'] == null) $p['poster_small'] = 'fake.png';
            if($p['name_flim'] == null) $p['name_flim'] = 'Updating...';
    ?>     
            <div class="cell">
                <img src="./assets/img/<?=$p['poster_small']?>"/>
                <div class="user-info">
                    <span class="title"><?=$p['name_flim']?></p>
                    <span class="position">View: <?=number_format($p['view'])?></p>
                </div>
            </div>
        
        <?php             
        }
        ?>
    </div>
    <?php
        }
                include 'component/footer.php';
            ?>
            </main>
            <script src="assets/js/script.js">     
            </script>
</body>