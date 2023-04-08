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
        include 'component/search_genre.php';
    ?>
</body>

