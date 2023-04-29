<?php

    include('API/connect.php');
if ($_POST['action'] == 'add') {

    add_bookmark($_POST['username'], $_POST['movie_name']);
    echo "Bookmark added!";
} elseif ($_POST['action'] == 'remove') {

    del_bookmark($_POST['username'], $_POST['movie_name']);
    echo "Bookmark removed!";
}
