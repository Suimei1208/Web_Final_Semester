<?php 
    if(isset($_POST['submit'])){
        $username = $_POST['username'];
        $password = $_POST['password'];

        $host = "localhost:3306";
        $user = "root";
        $passwd = "";
        $db = "webfinal";
        $conn = new mysqli($host, $user, $passwd, $db);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $stmt = $conn->prepare("SELECT * FROM account WHERE UserName = ? AND Password = ?");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            header('Location: ../../home.html');
            exit();
        } else {
            $error = "Error Username or Password. Please try again!";
        }
        $stmt->close();
        $conn->close();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</head>
<body>
    <header>
        <h2 class="logo">Logo</h2>
        <nav class="navigation">
            <a href="../../home.html">Home</a>
            <a href="#">About</a>
            <a href="#">Services</a>
            <a href="#">Contact</a>
            <button class="btnLogin-popup">Login</button>
        </nav>
    </header>
    <div class="wrapper">
        <div class="form-box login">
            <h2>Login</h2>
            <form  id="loginForm" action="" method="post">
                <div class="input-box" >
                    <span class="icon"><ion-icon name="mail-outline"></ion-icon></span>
                    <input type="text" name="username">
                    <label >UserName</label>
                </div>
                <div class="input-box" >
                    <span class="icon"><ion-icon name="lock-closed-outline"></ion-icon></span>
                    <input  name="password" type="password">
                    <label >Password</label>
                </div>

                <?php 
                    if(isset($error) && !empty($error)){ 
                ?>
                <div class="error"><?php echo $error; ?></div>
                <?php } ?>

                <div class="remember-forgot">
                    <label><input type="checkbox">Remember me?</label>
                    <a href="#">Forgot Password?</a>
                </div>
                <button type="submit" class="btn" name = "submit" id="submit-btn">Login</button>
                <div class="login-register">
                    <p>Don't have a account?
                        <a href="#" class="register-link">Register</a>
                    </p>
                </div>
            </form>
        </div>

        <div class="form-box register">
            <h2>Registration</h2>
            <form action="#">
                <div class="input-box">
                    <span class="icon"><ion-icon name="person-outline"></ion-icon></span>
                    <input type="text" required>
                    <label >Username</label>
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="mail-outline"></ion-icon></span>
                    <input type="email" required>
                    <label >Email</label>
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="lock-closed-outline"></ion-icon></span>
                    <input type="password" required>
                    <label >Password</label>
                </div>
                <div class="remember-forgot">
                    <label><input type="checkbox">I agree to the term & conditons</label>
                </div>
                <button type="submit" class="btn">Register</button>
                <div class="login-register">
                    <p>Already have a account?<a href="#" class="login-link">Login</a></p>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
<script src="script.js"></script>


