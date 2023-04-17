<?php 
    $host = "localhost:3306";
    $user = "root";
    $passwd = "";
    $db = "webfinal";
    $conn = new mysqli($host, $user, $passwd, $db);

// Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

if(isset($_POST['add_film'])) {
    $name_flim = $_POST['name_film'];
    $rate = $_POST['rate'];
    $time = $_POST['time'];
    $year = $_POST['year'];
    $content = $_POST['content'];
    $director = $_POST['director'];
    $genre = $_POST['genre'];
    $pg = $_POST['pg'];
    $quality = $_POST['quality'];
    $actor = $_POST['actor'];
    $view = null;

    $target_dir = "../assets/img/";
    $poster_small = basename($_FILES["poster_small"]["name"]);
    $poster_big = basename($_FILES["poster_big"]["name"]);
    $poster_cut = basename($_FILES["poster_cut"]["name"]);

    move_uploaded_file($_FILES["poster_small"]["tmp_name"], $target_dir . $poster_small);
    move_uploaded_file($_FILES["poster_big"]["tmp_name"], $target_dir . $poster_big);
    move_uploaded_file($_FILES["poster_cut"]["tmp_name"], $target_dir . $poster_cut);

    $result = mysqli_query($conn, "SELECT COUNT(*) as count FROM films");
    $row = mysqli_fetch_assoc($result);
    $id = $row['count'] + 1;

    $query = "INSERT INTO films (id, name_flim, rate, time, year, content, director, genre, pg, poster_small, poster_big, poster_cut, quality, actor, view) 
              VALUES ('$id', '$name_flim', '$rate', '$time', '$year', '$content', '$director', '$genre', '$pg', '$poster_small', '$poster_big', '$poster_cut', '$quality', '$actor', '$view')";
    if(mysqli_query($conn, $query)) {
        echo "Film added successfully";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}
?>
