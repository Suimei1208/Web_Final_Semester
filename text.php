<?php 
    include("API/connect.php");
    $name= get_film("Solo Leveling");
    foreach ($name as $film) {
        echo "Tên phim: " . $film["name_flim"] . "<br>";
        echo "Thể loại: " . $film["genre"] . "<br>";
        echo "Đạo diễn: " . $film["director"] . "<br>";
        echo "Năm sản xuất: " . $film["year"] . "<br>";
        echo "Thời lượng: " . $film["time"] . " phút" . "<br>";
        echo "Nội dung: " . $film["content"] . "<br>";
        echo "Diễn viên: " . $film["actor"] . "<br>";
    }

?>