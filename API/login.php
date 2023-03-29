<?php   
    if(isset($_POST['submit'])){
        $username = $_POST['username'];
        $password = $_POST['password'];

        require_once('connect.php');
        $conn = connect();

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $stmt = $conn->prepare("SELECT * FROM account WHERE UserName = ? AND Password = ?");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            header('Location: ../home.html');
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
</head>
<body>
    <header>
        <h2 class="logo">Logo</h2>
        <nav class="navigation">
            <a href="../../home.html">Home</a>
            <a href="#">About</a>
            <a href="#">Services</a>
            <a href="#">Contact</a>
        </nav>
    </header>
    <div class="login-card">
        <div class="card-header">
          <div class="log">Login</div>
        </div>
        <form method="post">
            <div class="form-group">
                <label for="username">Username:</label>
                <input  name="username" id="username" type="text">
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input name="password" id="password" type="password">
            </div>

            <?php 
                    if(isset($error) && !empty($error)){ 
                ?>
                <div class="error"><?php echo $error; ?></div>
            <?php } ?>

            <div class="form-group">
                <div class="main_div">
                    <button type="submit" class="btn" name = "submit" id="submit-btn">Sign up</button>
                </div>
            </div>
          
            <p>Don't have a account?
                <a href="#" class="register-link">Register</a>
            </p>        
        </form>
      </div>   
</body>
</html>
