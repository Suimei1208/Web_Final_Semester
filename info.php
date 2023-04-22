<?php
    include 'API/setup.php';
    if (isset($_GET['movie_name'])){
        $name_film1 = $_GET['movie_name'];
        $name_film = trim($_GET['movie_name']);
        $currentTime = time();
        $lastUpdateTime = isset($_SESSION[$name_film1]) ? $_SESSION[$name_film1] : 0;
        if ($currentTime - $lastUpdateTime >= 120) { 
            update_view($name_film); 
            $_SESSION[$name_film1] = $currentTime; 
        }
    } else {
        if (isset($name_film1) && isset($_SESSION[$name_film1])) { 
            unset($_SESSION[$name_film1]); 
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?=$name_film1?></title>
        <link rel="stylesheet" href="./assets/css/style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    </head>
    <body>
    <main>
        <?php
            include 'component/header.php';
            if (isset($_POST['submit'])) {
                $name_films = $_GET['movie_name'];
                if(isset($_SESSION['username'])){
                    $rating = $_POST['rate'];
                    $check = get_rate_username($_SESSION['username'], $name_films);
                    if( $check == true){
                        update_rates($rating, $_SESSION['username'], $name_films);
                    } 
                    else {
                        insert_rate($_SESSION['username'], $_GET['movie_name'], $rating);

                    }
                    update_rate_all_flims();
                }
            }
            
            if (isset($_GET['movie_name'])) {
                $name_films = $_GET['movie_name'];             
                $p  =  get_film($name_films); 
                foreach ($p as $p) {
                    if($p['poster_small'] == null) $p['poster_small'] = 'fake.png';
                    if($p['name_flim'] == null) $p['name_flim'] = 'Updating...';  
                    if($p['actor'] == null) $p['actor'] = 'Updating...';    
                    if($p['director'] == null) $p['director'] = 'Updating...';    
                    if($p['Status'] == null) $p['Status'] = 'Updating...'; ?>
                <div>
                    <div class="chosen-film">
                        <div class="film">
                            <img src="assets/img/<?=$p['poster_big']?>" alt="" class="big-chosen-film">
                            <div class="card">
                                <img src="assets/img/<?=$p['poster_small']?>" alt="">
                                <div class="infor">
                                    <h3><?=$p['name_flim']?></h3>
                                    <div class="infor-1">
                                        <span class="age">PG <?=$p['pg']?></span>
                                        <span class="quality"><?=$p['quality']?></span>
                                        <span><i class="fa-regular fa-calendar" style="color: yellow;"></i> <?=$p['year']?></span>
                                        <span><i class="fa-regular fa-clock" style="color: yellow;"></i> <?=$p['time']?> minutes</span>
                                    </div>
                                    <p><?=preg_replace("/\r\n|\r|\n/","<br>", $p['content']);?></p>
                                    <div class="AG-1">
                                        <div class="AUT"><span>Director:</span> <?=$p['director']?></div>
                                        <div class="GEN"><span>Genres:</span> <?=$p['genre']?></div>
                                        <div class="GEN"><span>Actor :</span> <?=$p['actor']?></div>
                                        <div class="GEN"><span>Status:</span> <?=$p['Status']?></div>
                                    </div>
                                    <div class="btn-film">
                                        <span class="play-2"><i class="fa-solid fa-play" style="color: #ffffff;"></i> <button style="background: red; color: #ffffff; cursor: pointer;">WATCH</button></span>
                                        <span class="share"><i class="fa-solid fa-share" style="color: #ffffff;"></i> <button style="background: blue; color: #ffffff; cursor: pointer;">SHARE</button></span>
                                        
                                        
                                        <?php 
                                        
                                        ?>
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        <span class="bookmark">
                                            <i id="bookmark-icon" class="fa-solid fa-bookmark" style="color: #ffffff;cursor: pointer;"></i>
                                            <button id="bookmark-button" style="background: green; color: #ffffff; cursor: pointer;" onclick="changeIcon()"> BOOKMARK</button>
                                         </span>
                                        
                                         <form method="post">
                                        <span class="cont-star">
                                            <?php 
                                                $count_users = count_rate_users($name_films);
                                                $count = count_rate_users($name_films); 
                                                $rate_flim = get_rate_by_film($name_films);
                                            ?>
                                            <span class="star-widget">
                                                <div class="rating-logo">
                                                    <span style="font-size: 20px;"><?=round($rate_flim * 100 / 5, 2)?>%</span>
                                                </div>
                                                <div class="star-widget-1">
                                                <input type="radio" name="rate" id="rate-5" value="5">
                                                <label for="rate-5" class="fas fa-star"></label>
                                                <input type="radio" name="rate" id="rate-4" value="4">
                                                <label for="rate-4" class="fas fa-star"></label>
                                                <input type="radio" name="rate" id="rate-3" value="3">
                                                <label for="rate-3" class="fas fa-star"></label>
                                                <input type="radio" name="rate" id="rate-2" value="2"> 
                                                <label for="rate-2" class="fas fa-star"></label>
                                                <input type="radio" name="rate" id="rate-1" value="1">
                                                <label for="rate-1" class="fas fa-star"></label>
                                            
                                                <div class="vote" style="margin-left: 10px;">
                                                    (<?=$count?> votes, Rating: <?=$rate_flim?> out of 5)
                                                </div>
                                                </div>
                                            <?php if(isset($_SESSION['username'])){ ?>
                                                 </span>
                                                 <input type="submit" name="submit" value="Submit Rating" class="smt-rate">
                                                 </span>
                                            <?php } ?>                    
                                        </form>
                                        <script>
                                            const ratingInputs = document.getElementsByName('rate');
                                            for (let i = 0; i < ratingInputs.length; i++) {
                                                ratingInputs[i].addEventListener('change', function() {
                                                    const rating = this.value;  
                                                });
                                            }
                                        </script>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            <?php $ep_tr = select_tr_ep($name_films);?>             
                <div class="part-2">
                    <div class="trailer">
                        <h3>Trailer:</h3>
                        <div class="trailer-box">
                            <div class="trailer-position">
                         <?php foreach($ep_tr as $p){ 
                            if($p['trailer'] == null) continue; ?>
                                <span><a href="" style="text-decoration: none; color: #ffffff;">Trailer <?=$p['trailer']?></a></span> <?php } ?>
                            </div>
                        </div>
                        <h3>Episodes:</h3>
                        <div class="episodes-box">
                            <div class="episodes-position">
                            <?php foreach($ep_tr as $p){ 
                                if($p['Episodes'] == null) continue;?>
                                <span><a href="" style="text-decoration: none; color: #ffffff;"><?=$p['Episodes']?></a></span> <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                    <div class="update" style="margin-top: 200px;">
                        <div class="card-content">          
                        </div>
                    </div>
                </div>  
            <?php }}
        ?>
        <div>
        <h3 class="update-content1" style="color: #ffffff; font-size: 50px;">Other Movies</h3>
        </div>
        <div class="update" >
            <div class="card-content" style="display: none;">
            <?php foreach($flims as $p){
                        if($p['poster_small'] == null) $p['poster_small'] = 'fake.png';
                        if($p['name_flim'] == null) $p['name_flim'] = 'Updating...';  
                        if($p['actor'] == null) $p['actor'] = 'Updating...';    
                        if($p['director'] == null) $p['director'] = 'Updating...';    
                        if($p['Status'] == null) $p['Status'] = 'Updating...';          
                ?>
                <a href="info.php?movie_name=<?=$p['name_flim']?>" class = "color_info">
                    <div class="card">
                        <div class="card-image">
                            <img src="assets/img/<?=$p['poster_small']?>" alt=""></div>
                        <div class="tooltip">
                        <div class="item">
                            <div class="NameFilm"><?=$p['name_flim']?></div>                  
                            <div class="Story"><?=preg_replace("/\r\n|\r|\n/","<br>", $p['content']);?> </div> 
                            <div class="STD" style="color: #fffb00">
                                    <span style="margin-right: 10px;">
                                        <i class="fa-solid fa-star"></i><span class="col-while" style="color: #000000"> <?=$p['rate']?>/5 </span> 
                                    </span>
                                    <span style="margin-right: 10px;">
                                        <i class="fa-regular fa-clock" ></i> <span class="col-while" style="color: #000000"><?=$p['time']?> minutes</span> 
                                    </span>                
                                    <i class="fa-regular fa-calendar"></i> <span  class="col-while" style="color: #000000"><?=$p['year']?></span>
                            </div>
                            <div class="AG">
                                <div class="AU"><span>Director:</span> <?=$p['director']?></div>
                                <div class="AC"><span>Actor:</span> <?=$p['actor']?></div>
                                <div class="GE"><span>Genres:</span> <?=$p['genre']?></div>
                            </div>
                        </div>
                    </div>
                        <div class="card-info">
                            <h3><?=$p['name_flim']?></h3>
                            <p>View: <?=number_format($p['view'])?></p>
                        </div>
                    </div>
                    </a>
            <?php } ?>
        </div>
        <div class="pagination"></div>     
        <div onclick="scrollToTop()" class="scrollTop"><img src="assets/icon/go-up.png" alt=""></div>
    </main>
    <?php
            include 'component/footer.php';
        ?>
        <script 
        src="assets/js/script.js">     
        </script>
    </body>
</html>