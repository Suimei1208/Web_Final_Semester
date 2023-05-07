<?php
include 'API/setup.php';
if (isset($_POST['submit_avatar']) && isset($_FILES["poster_small"])) {
    $name = get_info($_GET['username']);
    $target_dir = "assets/avatar/";
    foreach ($name as $p) {
        if ($p['avatar'] == null) $p['avatar'] = "user.png";
        if ($p['avatar'] != "user.png") {
            $file_path = $target_dir . $p['avatar'];
            if (file_exists($file_path)) {
                unlink($file_path);
            }
        }
    }
    $poster_small = basename($_FILES["poster_small"]["name"]);
    move_uploaded_file($_FILES["poster_small"]["tmp_name"], $target_dir . $poster_small);
    update_avatar($poster_small, $_GET['username']);
    $content = "Update Avatar Successful";
}
if (isset($_POST['submit_pro'])) {
    $email = $_POST['email'];
    $tel = $_POST['phone'];
    update_pro($_GET['username'], $email, $tel);
    $content = "Update Profile Successful";
}
if (isset($_POST['submit_pass'])) {
    $old_password = $_POST['old-password'];
    $new_password = $_POST['new-password'];
    $username = $_GET['username'];
    $confirm = $_POST['Confirm-password'];
    if (get_old_password($username) == $old_password) {
        if($new_password === $confirm){
            update_pass($username, $new_password);
            $content = "Update Password Successful"; 
        }else{
            $content = "Confirm Error!!!";
        }            
    } else {
        $content = "Error password!!!";
    }
}

?>

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
        header {
            background-color: black;
        }
    </style>
</head>

<body>
    <?php
    include 'component/header.php';
    $name = get_info($_GET['username']);
    foreach ($name as $p) {
        if ($p['avatar'] == null) $p['avatar'] = "user.png"; ?>?>
    <div class="information-page">
        <h3 style="justify-content: center; padding: 10px; margin-bottom: 40px;">Your Info</h3>
        <div class="image-container">
            <form method="post" enctype="multipart/form-data">
                <img src="assets/avatar/<?= $p['avatar'] ?>" alt="Default Image" id="image">
                <div class="overlay">
                    <input type="file" name="poster_small" accept="image/*" id="file-input">
                    <label onclick="changeImage()" for="file-input"><i class="fas fa-camera" style="color: white; font-size: 30px; cursor: pointer;"></i></label>
                </div>
        </div>
        <button type="submit" name="submit_avatar" class="bu">Update Avatar</button>
        <?php if (isset($_POST['submit_avatar']) && isset($_FILES["poster_small"]))
            echo "<label class='bu3' style='margin: 5% 25% 5% 31%; font-size: 20px; color: white; '>$content</label>"; ?>
        </form>
        <div id="pro">
            <h3>Your Profile</h3>
            <form class="Show-Profile" style="flex-direction: column;" method="post">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" class="col" required disabled value="<?= $p['UserName'] ?>">

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" class="col" required value="<?= $p['Email'] ?>">

                <label for="phone">Phone Number:</label>
                <input type="tel" id="phone" name="phone" class="col" required value="<?= $p['Phone'] ?>">
                <button type="submit" name="submit_pro" class="bu2">Update Profile</button>
                <?php if (isset($_POST['submit_pro']))
                    echo "<label class='bu3'>$content</label>"; ?>
            </form>
        </div>
    <?php } ?>
    <div id="change-password">
        <h3>Change password</h3>
        <form class="change-password" style="flex-direction: column;" method="post">
            <label for="old-password">Old Password:</label>
            <input type="password" id="old-password" name="old-password" class="col" required>

            <label for="new-password">New Password:</label>
            <input type="password" id="new-password" name="new-password" class="col" required>

            <label for="new-password">Confirm Password:</label>
            <input type="password" id="Confirm-password" name="Confirm-password" class="col" required>

            <button type="submit" name="submit_pass" class="bu2">Update Password</button>
            <?php if (isset($_POST['submit_pass']))
                echo "<label class='bu3'>$content</label>"; ?>
        </form>
    </div>

    <h3><a href="library.php?username=<?= $_SESSION['username'] ?>">Library</a></h3>
    </div>

    <div onclick="scrollToTop()" class="scrollTop"><img src="assets/icon/go-up.png" alt=""></div>



    <?php
    include 'component/footer.php';
    ?>
    <script src="assets/js/script.js">
    </script>
</body>

</html>