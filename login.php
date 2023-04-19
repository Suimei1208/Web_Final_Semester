<?php   
    session_start();
    $current_url = $_SESSION['current_url']; 
    if(isset($_POST['submit'])){
        $username = $_POST['username'];
        $password = $_POST['password'];

        require_once('API/connect.php');
        $conn = connect();

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $stmt = $conn->prepare("SELECT * FROM account WHERE UserName = ? AND Password = ?");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $loggedIn = true;
            $_SESSION['username'] = $username;
    
            if (isset($_POST['remember_me']) && $_POST['remember_me'] == '1') {
                setcookie('username', $username, time() + 86400 * 30, '/');
                setcookie('password', $password, time() + 86400 * 30, '/');
            }
            header('Location: '.$current_url); 
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
    <link rel="stylesheet" href="assets/css/style_lg_re.css">
</head>
<body>
    <header>
        <h2 class="logo">Logo</h2>
        <nav class="navigation">
            <a href="./index.php">Home</a>
            <a href="#">About</a>
            <a href="#">Services</a>
            <a href="#">Contact</a>
        </nav>
    </header>
    <main>
        <div class="login-card">
        <div class="card-header">
          <div class="log">Login</div>
        </div>
        <form method="post">
            <label for="username">Username:</label1>
            <div class="form-group">
                    <img src="assets/gif/user.gif" alt="">
                    <input class ="lg" name="username" id="username" type="text">
            </div>
            <label for="password">Password:</label>
            <div class="form-group">
                <img src="assets/gif/pass.gif" alt="">
                <input class ="lg" name="password" id="password" type="password">
            </div>
            <?php 
                    if(isset($error) && !empty($error)){ 
                ?>
                <div class="error"><?php echo $error; ?></div>
            <?php } ?>
            <div class="form-group">
                <input type="checkbox" name="remember_me" id="remember_me">
                <label for="remember_me">Remember Me</label>
            </div>

            <div class="form-group">
                <div class="main_div">
                    <button type="submit" class="btn" name = "submit" id="submit-btn">Sign up</button>
                </div>
            </div>
          
            <p>Don't have a account?
                <a href="register.php" class="register-link">Register</a>
            </p>        
        </form>
      </div>
    </main>   
</body>
</html>
