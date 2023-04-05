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
    $genre ='';
    $flims = showFlims();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <!-- <header>
        <img src="assets/img/LOGOMOUNT.png" alt="" class="logo">
        <nav class="navigation">
            <a href="#">HOME</a>
            <a href="#">GENRES</a>
            <a href="#">TV SERIES</a>
            <a href="#">MOVIE</a>
            <a href="#">TOP FILMS</a>
            <a href="#">NEW FILMS</a>
            <a href="#">ADVANCED SEARCH</a>
            <a href="#" class="search">
                <input type="text" class="search__input" placeholder="Search film name">
                <i class="fa-solid fa-magnifying-glass"></i>
            </a>
            <a href="./login.php">LOGIN</a>
        </nav>
    </header> -->
    <?php
        include 'component/header.php';
    ?>

    <main>
        <div class="container"></div>
        <div class="img-slider" >
            <?php  
                $count = 0;
                foreach($flims as $p){
                    $count++;
                    if($p['actor'] === null){
                        $p['actor'] = "Updating.....";
                    }

                    if ($count >= 6) {
                        break;
                    }
                    elseif($count ==1){            
            ?>
            <div class="slide active" name="slide">
                <img src="assets/img/<?=$p['poster_cut']?>" alt="" class="poster">
                <div class="info">
                    <h2 name="name"><?=$p['name_flim']?></h2>
                    <div class="size">
                        <div style="color: #fffb00">
                            <div class="main_poster_header">
                                <span style="margin-right: 10px;">
                                    <i class="fa-solid fa-star"></i> <?=$p['rate']?>/5 
                                </span>
                                <span style="margin-right: 10px;">
                                    <i class="fa-regular fa-clock" ></i> <span class="col-while"><?=$p['time']?> minutes</span> 
                                </span>                
                                <i class="fa-regular fa-calendar"></i> <span  class="col-while"><?=$p['year']?></span>
                            </div>
                        </div>
                        <p class="col-while"><?=$p['content']?></p>
                        <p class="INFO">Author: <span class="col-while"><?=$p['director']?></span></p>
                        <p class="INFO">Actor: <span class="col-while"> <?=$p['actor']?></span></p>
                        <p class="INFO">Genres: <span class="col-while"> <?=$p['genre']?></span></p>
                    </div>             
                </div>
                <input type="button" class="play" class="fa-solid fa-play" value="WATCH">
            </div>
            <?php
                    }
                    else{
            ?>  
            <div class="slide">
                <img src="assets/img/<?=$p['poster_cut']?>" alt="" class="poster">
                <div class="info">
                    <h2 name="name"><?=$p['name_flim']?></h2>
                    <div class="size">
                        <div style="color: #fffb00">
                            <div class="main_poster_header">
                                <span style="margin-right: 10px;">
                                    <i class="fa-solid fa-star"></i> <?=$p['rate']?>/5 
                                </span>
                                <span style="margin-right: 10px;">
                                    <i class="fa-regular fa-clock" ></i> <span class="col-while"><?=$p['time']?> minutes</span> 
                                </span>                
                                <i class="fa-regular fa-calendar"></i> <span  class="col-while"><?=$p['year']?></span>
                            </div>
                        </div>
                        <p class="col-while"><?=$p['content']?></p>
                        <p class="INFO">Author: <span class="col-while"><?=$p['director']?></span></p>
                        <p class="INFO">Actor: <span class="col-while"> <?=$p['actor']?></span></p>
                        <p class="INFO">Genres: <span class="col-while"> <?=$p['genre']?></span></p>
                    </div>               
                </div>
                <input type="button" class="play" class="fa-solid fa-play" value="WATCH">
            </div>
            <?php
                    }
                }
            ?>            
            <div class="radio-btn">
                <div class="btn active"></div>
                <div class="btn"></div>
                <div class="btn"></div>
                <div class="btn"></div>
                <div class="btn"></div>
            </div>
        </div>
    </div>
    
    <div class="update">
    <?php
        $count = 0;
        foreach($flims as $p){
            $count++;
            if($count===5) break;
            if($p['poster_small'] == null) $p['poster_small'] = 'fake.png';
            if($p['name_flim'] == null) $p['name_flim'] = 'Bị vấp phải cứt rồi isekai!';
    ?>     
            <div class="cell">
                <img src="./assets/img/<?=$p['poster_small']?>"/>
                <div class="user-info">
                    <span class="title"><?=$p['name_flim']?></p>
                    <span class="position">View: 10,000,000</p>
                </div>
            </div>
        
        <?php             
        }
        ?>
    </div>
    
    <div class="update">
    <?php
        $count = 0;
        foreach($flims as $p){
            $count++;
            if($count <5) continue;
            if($count===9) break;
            if($p['poster_small'] == null) $p['poster_small'] = 'fake.png';
            if($p['name_flim'] == null) $p['name_flim'] = 'Bị vấp phải cứt rồi isekai!';
    ?>     
            <div class="cell">
                <img src="./assets/img/<?=$p['poster_small']?>"/>
                <div class="user-info">
                    <span class="title"><?=$p['name_flim']?></p>
                    <span class="position">View: 10,000,000</p>
                </div>
            </div>
        
        <?php             
        }
        ?>
    </div>

    <div class="update">
    <?php
        $count = 0;
        foreach($flims as $p){
            $count++;
            if($count <9) continue;
            if($count===13) break;
            if($p['poster_small'] == null) $p['poster_small'] = 'fake.png';
            if($p['name_flim'] == null) $p['name_flim'] = 'Bị vấp phải cứt rồi isekai!';
    ?>     
            <div class="cell">
                <img src="./assets/img/<?=$p['poster_small']?>"/>
                <div class="user-info">
                    <span class="title"><?=$p['name_flim']?></p>
                    <span class="position">View: 10,000,000</p>
                </div>
            </div>
        
        <?php             
        }
        ?>
    </div>

    <div class="update">
    <?php
        $count = 0;
        foreach($flims as $p){
            $count++;
            if($count <13) continue;
            if($count===17) break;
            if($p['poster_small'] == null) $p['poster_small'] = 'fake.png';
            if($p['name_flim'] == null) $p['name_flim'] = 'Bị vấp phải cứt rồi isekai!';
    ?>     
            <div class="cell">
                <img src="./assets/img/<?=$p['poster_small']?>"/>
                <div class="user-info">
                    <span class="title"><?=$p['name_flim']?></p>
                    <span class="position">View: 10,000,000</p>
                </div>
            </div>
        
        <?php             
        }
        ?>
    </div>

    <?php
        include 'component/footer.php';
    ?>
    </main>
    <script src="assets/js/script.js">     
    </script>
</body>