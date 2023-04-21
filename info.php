<?php
    // session_start();
    if(isset($_GET['movie_name'])){
        $name_films =$_GET['movie_name'];
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?=$name_films?><?php } ?></title>
        <link rel="stylesheet" href="./assets/css/style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    </head>
    <body>
    <main>
        <?php
            include 'API/setup.php';
            include 'component/header.php';
            if(isset($_GET['movie_name'])){
                $name_films =$_GET['movie_name'];
                update_view($name_films);
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
                                        
                                          
                                        <span class="cont-star">
                                        <?php 
                                            $count_users = count_rate_users($name_films);
                                            $count = count_rate_users($name_films); 
                                            $rate_flim = get_rate_by_film($name_films);
                                        ?>
                                        <span class="star-widget">
                                            <div class="rating-logo">
                                                <span style="font-size: 20px;"><?=$rate_flim * 100 / 5?>%</span>
                                            </div>
                                            <div class="star-widget-1">
                                            <input type="radio" name="rate" id="rate-5">
                                            <label for="rate-5" class="fas fa-star"></label>
                                            <input type="radio" name="rate" id="rate-4">
                                            <label for="rate-4" class="fas fa-star"></label>
                                            <input type="radio" name="rate" id="rate-3">
                                            <label for="rate-3" class="fas fa-star"></label>
                                            <input type="radio" name="rate" id="rate-2">
                                            <label for="rate-2" class="fas fa-star"></label>
                                            <input type="radio" name="rate" id="rate-1">
                                            <label for="rate-1" class="fas fa-star"></label>
                                           
                                            <div class="vote" style="margin-left: 10px;">
                                                (<?=$count?> votes, rating: <?=$rate_flim?> out of 5)
                                            </div>
                                            </div>
                                        </span>
                                    </span>
                                    </div>
                                </div>
                                <div class="part-2">
                                    <div class="trailer">
                                        <h3>Trailer:</h3>
                                        <div class="trailer-box">
                                            <div class="trailer-position">
                                                <span><a href="" style="text-decoration: none; color: #ffffff;">Trailer 1</a></span>
                                            <span><a href="" style="text-decoration: none; color: #ffffff;">Trailer 2</a></span>
                                            </div>
                                        </div>
                                        <h3>Episodes:</h3>
                                        <div class="episodes-box">
                                            <div class="episodes-position">
                                                <span><a href="" style="text-decoration: none; color: #ffffff;">1</a></span>
                                            <span><a href="" style="text-decoration: none; color: #ffffff;">2</a></span>
                                            <span><a href="" style="text-decoration: none; color: #ffffff;">3</a></span>
                                            <span><a href="" style="text-decoration: none; color: #ffffff;">4</a></span>
                                            <span><a href="" style="text-decoration: none; color: #ffffff;">5</a></span>
                                            <span><a href="" style="text-decoration: none; color: #ffffff;">6</a></span>
                                            </div>
                                        </div>
                                    </div>
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
        <h3 class="update-content1" style="color: #ffffff; font-size: 50px;">Similar Movies</h3>
        </div>
        <div class="update">
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
        
        <?php
            include 'component/footer.php';
        ?>
    </main>
        <script 
        src="assets/js/script.js">     
        </script>
    </body>
</html>