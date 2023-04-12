<?php 
    require_once('connect.php');
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
    $flims = showFlims();
    $rand = generateRandomNumbers();
    $rand_flim = showFilmsRand($rand);
?>