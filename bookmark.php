<?php
// Kiểm tra action là add hay remove
    include('API/connect.php');
if ($_POST['action'] == 'add') {
    // Gọi hàm PHP add_bookmark() với các tham số từ $_POST
    add_bookmark($_POST['username'], $_POST['movie_name']);
    echo "Bookmark added!";
} elseif ($_POST['action'] == 'remove') {
    // Gọi hàm PHP del_bookmark() với các tham số từ $_POST
    del_bookmark($_POST['username'], $_POST['movie_name']);
    echo "Bookmark removed!";
}
?>
