<?php
session_start();
$current_url = $_SESSION['current_url'];
session_unset();
session_destroy();
setcookie('username', '', time() - 3600, '/');
setcookie('password', '', time() - 3600, '/');

$exclude_pages = array('library.php', 'your_info.php');

if (strpos($current_url, 'username=') !== false) {
    header('Location: index.php');
    exit();
} else {
    header('Location: '.$current_url);
    exit();
}
?>
