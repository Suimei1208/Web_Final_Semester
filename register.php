<?php
if (isset($_POST['submit'])) {
    $username_dk = $_POST['username_dk'];
    $password_dk = $_POST['password_dk'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    require_once('API/connect.php');
    $conn = connect();

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($username_dk === "" || $password_dk === "" || $email === "" || $phone === "") {
        $error1 = "You must to fill in all required information.";
    } else {
        $stmt = $conn->prepare("SELECT * FROM account WHERE UserName = ?");
        $stmt->bind_param("s", $username_dk);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $error1 = "Username already exists. Please try again!";
        } else {
            if (isset($_POST['terms'])) {
                $stmt_1 = $conn->prepare("INSERT INTO account (UserName, Password, Email, Phone)VALUES (?, ?, ?, ?)");
                $stmt_1->bind_param("ssss", $username_dk, $password_dk, $email, $phone);
                $stmt_1->execute();

                header('Location: action.html');
                exit();
            } else {
                $error1 = "You must agree to the terms and conditions to register";
            }
        }
        $stmt->close();
        $conn->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="assets/css/style_lg_re.css">
</head>

<body>
    <header>
        <h2 class="logo">Logo</h2>
        <nav class="navigation">
            <a href="../home.html">Home</a>
            <a href="#">About</a>
            <a href="#">Services</a>
            <a href="#">Contact</a>
        </nav>
    </header>
    <div class="register-card">
        <div class="card-header">
            <div class="log">Register</div>
        </div>
        <form method="post">
            <label for="username">Username:</label1>
                <div class="form-group">
                    <img src="assets/gif/user.gif" alt="">
                    <input name="username_dk" id="username" type="text" required>
                </div>

                <label for="password">Password:</label>
                <div class="form-group">
                    <img src="assets/gif/pass.gif" alt="">
                    <input name="password_dk" id="password" type="password" required>
                </div>
                <label>Email:</label>
                <div class="form-group">
                    <img src="assets/gif/email.gif" alt="">
                    <input name="email" id="email" type="text" required>
                </div>
                <label>Phone number:</label>
                <div class="form-group">
                    <img src="assets/gif/phone.gif" alt="">
                    <input name="phone" id="phone" type="text" required>
                </div>
                <?php
                if (isset($error1) && !empty($error1)) {
                ?>
                    <div class="error1"><?php echo $error1; ?></div>
                <?php } ?>

                <div class="remember-forgot">
                    <input type="checkbox" name="terms[]">
                    <label>I agree to the term & conditons</label>
                </div>

                <div class="form-group">
                    <div class="main_div1">
                        <button type="submit" class="btn" name="submit" id="submit-btn">Register</button>
                    </div>
                </div>

                <p>Already have a account?
                    <a href="login.php" class="register-link">Login</a>
                </p>
        </form>
    </div>

</body>

</html>