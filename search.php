<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
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
            $search_flim = getFlims($search);?>
            <main style="margin-top: 80px;">
                        <div class="update-content1">
                    <strong class="up">Upcoming:</strong>
                </div>
                <div class="update">
                    <div class="card-content" style="display: none;">
                    <?php foreach($search_flim as $p){
                                if($p['poster_small'] == null) $p['poster_small'] = 'fake.png';
                                if($p['name_flim'] == null) $p['name_flim'] = 'Updating...';                
                        ?>
                            <div class="card">
                                <div class="card-image"><img src="assets/img/<?=$p['poster_small']?>" alt=""></div>
                                <div class="card-info">
                                    <h3><?=$p['name_flim']?></h3>
                                    <p>View: <?=number_format($p['view'])?></p>
                                </div>
                            </div>
                    <?php } ?>
                </div>
                <div class="pagination"></div>
        <?php }}
                    elseif(isset($_GET['genres'])){
                        if(getFlims_Genre($_GET['genres']) == false){?>
                            <main style="margin-top: 80px;">
                            <?php include 'component/404.php';?>
                            </main>      
                        <?php }else{
                        $search_flim = getFlims_Genre($_GET['genres']);   
                        ?>
                        <main style="margin-top: 80px;">
                        <div class="update-content1">
                            <strong class="up">Upcoming:</strong>
                        </div>
                        <div class="update">
                            <div class="card-content" style="display: none;">
                            <?php foreach($search_flim as $p){
                                        if($p['poster_small'] == null) $p['poster_small'] = 'fake.png';
                                        if($p['name_flim'] == null) $p['name_flim'] = 'Updating...';                
                                ?>
                                    <div class="card">
                                        <div class="card-image"><img src="assets/img/<?=$p['poster_small']?>" alt=""></div>
                                        <div class="card-info">
                                            <h3><?=$p['name_flim']?></h3>
                                            <p>View: <?=number_format($p['view'])?></p>
                                        </div>
                                    </div>
                            <?php } ?>
                        </div>
                        <div class="pagination"></div>
                        <?php }}
                        ?>
    </main>
    <?php
        include 'component/footer.php';
    ?>
    <script 
    src="assets/js/script.js">     
    </script>
</body>
</html>