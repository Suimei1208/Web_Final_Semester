<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <style>
        header {
            background-color: black;
        }
    </style>
</head>

<body>
    <?php
    include 'API/setup.php';
    include 'component/header.php';
    ?>

    <main>
        <div class="container"></div>
        <div class="img-slider">
            <?php
            $count = 0;
            foreach ($rand_flim as $p) {
                $count++;
                if ($p['director'] === null) $p['director'] = "Updating.....";
                if ($p['actor'] === null) $p['actor'] = "Updating.....";
                if ($p['view'] === null)  $p['view'] = "0";
                if ($count >= 6) break;
                elseif ($count == 1) {
            ?>
                    <div class="slide active" name="slide">
                        <img src="assets/img/<?= $p['poster_cut'] ?>" alt="" class="poster">
                        <div class="info">
                            <h2 name="name"><?= $p['name_flim'] ?></h2>
                            <div class="size">
                                <div style="color: #fffb00">
                                    <div class="main_poster_header">
                                        <span style="margin-right: 10px;">
                                            <i class="fa-solid fa-star"></i> <?= $p['rate'] ?>/5
                                        </span>
                                        <span style="margin-right: 10px;">
                                            <i class="fa-regular fa-clock"></i> <span class="col-while"><?= $p['time'] ?> minutes</span>
                                        </span>
                                        <i class="fa-regular fa-calendar"></i> <span class="col-while"><?= $p['year'] ?></span>
                                    </div>
                                </div>
                                <?php
                                $words = str_word_count($p['content']);
                                if ($words > 50) {
                                    $shortText = implode(' ', array_slice(str_word_count($p['content'], 1), 0, 50)) . '...';
                                    echo '<p class="col-while">' . $shortText . ' <a href="info.php?movie_name=' . $p['name_flim'] . '" class="red_see_more" style="color: red;">See more</a></p>';
                                } else { ?>
                                    <p class="col-while"><?= $p['content'] ?></p>
                                <?php } ?>
                                <p class="INFO">Author: <span class="col-while"><?= $p['director'] ?></span></p>
                                <p class="INFO">Actor: <span class="col-while"> <?= $p['actor'] ?></span></p>
                                <p class="INFO">Genres: <span class="col-while"> <?= $p['genre'] ?></span></p>
                                <span class="play-3">
                                    <i class="fa-solid fa-play" style="color: #ffffff;"></i>
                                    <a href="info.php?movie_name=<?= $p['name_flim'] ?>" class="watch-btn">WATCH</a>
                                </span>

                            </div>
                        </div>

                    </div>
                <?php
                } else {
                ?>
                    <div class="slide">
                        <img src="assets/img/<?= $p['poster_cut'] ?>" alt="" class="poster">
                        <div class="info">
                            <h2 name="name"><?= $p['name_flim'] ?></h2>
                            <div class="size">
                                <div style="color: #fffb00">
                                    <div class="main_poster_header">
                                        <span style="margin-right: 10px;">
                                            <i class="fa-solid fa-star"></i> <?= $p['rate'] ?>/5
                                        </span>
                                        <span style="margin-right: 10px;">
                                            <i class="fa-regular fa-clock"></i> <span class="col-while"><?= $p['time'] ?> minutes</span>
                                        </span>
                                        <i class="fa-regular fa-calendar"></i> <span class="col-while"><?= $p['year'] ?></span>
                                    </div>
                                </div>
                                <?php
                                $words = str_word_count($p['content']);
                                if ($words > 50) {
                                    $shortText = implode(' ', array_slice(str_word_count($p['content'], 1), 0, 50)) . '...';
                                    echo '<p class="col-while">' . $shortText . ' <a href="info.php?movie_name=' . $p['name_flim'] . '" class="red_see_more" style="color: red;">See more</a></p>';
                                } else { ?>
                                    <p class="col-while"><?= $p['content'] ?></p>
                                <?php } ?>
                                <p class="INFO">Author: <span class="col-while"><?= $p['director'] ?></span></p>
                                <p class="INFO">Actor: <span class="col-while"> <?= $p['actor'] ?></span></p>
                                <p class="INFO">Genres: <span class="col-while"> <?= $p['genre'] ?></span></p>

                                <span class="play-3">
                                    <i class="fa-solid fa-play" style="color: #ffffff;"></i>
                                    <a href="info.php?movie_name=<?= $p['name_flim'] ?>" class="watch-btn">WATCH</a>
                                </span>

                            </div>
                        </div>
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
        <div class="update-content1">
            <strong class="up">NEW FILMS</strong>
        </div>
        <div class="update">
            <div class="card-content" style="display: none;">
                <?php foreach ($flims_des as $p) {
                    if ($p['poster_small'] == null) $p['poster_small'] = 'fake.png';
                    if ($p['name_flim'] == null) $p['name_flim'] = 'Updating...';
                    if ($p['actor'] == null) $p['actor'] = 'Updating...';
                ?>
                    <a href="info.php?movie_name=<?= $p['name_flim'] ?>" class="color_info">
                        <div class="card">
                            <div class="card-image">
                                <img src="assets/img/<?= $p['poster_small'] ?>" alt="">
                            </div>
                            <div class="tooltip">
                                <div class="item">
                                    <div class="NameFilm"><?= $p['name_flim'] ?></div>
                                    <div class="Story"><?= preg_replace("/\r\n|\r|\n/", "<br>", $p['content']); ?> </div>
                                    <div class="STD" style="color: #fffb00">
                                        <span style="margin-right: 10px;">
                                            <i class="fa-solid fa-star"></i><span class="col-while" style="color: #000000"> <?= $p['rate'] ?>/5 </span>
                                        </span>
                                        <span style="margin-right: 10px;">
                                            <i class="fa-regular fa-clock"></i> <span class="col-while" style="color: #000000"><?= $p['time'] ?> minutes</span>
                                        </span>
                                        <i class="fa-regular fa-calendar"></i> <span class="col-while" style="color: #000000"><?= $p['year'] ?></span>
                                    </div>
                                    <div class="AG">
                                        <div class="AU"><span>Director:</span> <?= $p['director'] ?></div>
                                        <div class="AC"><span>Actor:</span> <?= $p['actor'] ?></div>
                                        <div class="GE"><span>Genres:</span> <?= $p['genre'] ?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-info">
                                <h3><?= $p['name_flim'] ?></h3>
                                <p>View: <?= number_format($p['view']) ?></p>
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
    <script src="assets/js/script.js">
    </script>
</body>

</html>