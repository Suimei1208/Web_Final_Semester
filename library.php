<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Library</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
            header{
                background-color: black;
            }
    </style>
</head>
<body>
    <?php       
        include 'API/setup.php';
        include 'component/header.php';
        $flims_user = get_fa_film("admin"); ?>
        <main style="margin-top: 80px;">
            <div class="update-content1">
        <strong class="up">My Library:</strong>
            </div>
            <div class="update">
                <div class="card-content" style="display: none;">
                <?php foreach($flims_user as $p){
                            if($p['poster_small'] == null) $p['poster_small'] = 'fake.png';
                            if($p['name_flim'] == null) $p['name_flim'] = 'Updating...';      
                            if($p['actor'] == null) $p['actor'] = 'Updating...';             
                    ?>
                    <a href="info.php?movie_name=<?=$p['name_flim']?>" class = "color_info">
                        <div class="card">
                            <div class="card-image"><img src="assets/img/<?=$p['poster_small']?>" alt=""></div>
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
    </main>
    <?php
        include 'component/footer.php';
    ?>
    <script 
    src="assets/js/script.js">     
    </script>
</body>
</html>