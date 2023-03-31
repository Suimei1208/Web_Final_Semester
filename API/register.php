<?php 
    if(isset($_POST['submit'])){
        $username_dk = $_POST['username_dk'];
        $password_dk = $_POST['password_dk'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];

        require_once('connect.php');
        $conn = connect();

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        if($username_dk === "" || $password_dk === "" || $email === "" || $phone ===""){
            $error = "You must to fill in all required information.";
        }
        else{
            $stmt = $conn->prepare("SELECT * FROM account WHERE UserName = ?");
            $stmt->bind_param("s", $username_dk);
            $stmt->execute();
            $result = $stmt->get_result();
    
            if ($result->num_rows == 1) {
                $error = "Username already exists. Please try again!";
            } else {
                if (isset($_POST['terms'])) {
                    $stmt_1 = $conn->prepare("INSERT INTO account VALUES (?, ?, ?, ?)");
                    $stmt_1->bind_param("ssss", $username_dk, $password_dk, $email, $phone);
                    $stmt_1->execute();
                    
                    header('Location: action.html');
                    exit();
                } else {
                    $error = "You must agree to the terms and conditions to register";
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
    <link rel="stylesheet" href="style.css">
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
                        <img src="./Những thức rác linh tinh/user.gif" alt="">
                        <input  name="username" id="username" type="text">
                </div>

                <label for="password">Password:</label>
                <div class="form-group">
                    <img src="./Những thức rác linh tinh/pass.gif" alt="">
                    <input name="password" id="password" type="password">
                </div>
            <label>Email:</label>
            <div class="form-group">
                <img src="./Những thức rác linh tinh/email.gif" alt="">
                <input name="email" id="email" type="text">
            </div>
            <label>Phone number:</label>
            <div class="form-group">
                <img src="./Những thức rác linh tinh/phone.gif" alt="">
                <input  name="phone" id="phone" type="text">
            </div>
            <?php 
                    if(isset($error) && !empty($error)){ 
                ?>
                <div class="error"><?php echo $error; ?></div>
            <?php } ?>

            <div class="remember-forgot">
                <input type="checkbox" name="terms[]">
                <label>I agree to the term & conditons</label>
            </div>

            <div class="form-group">
                <div class="main_div1">
                    <button type="submit" class="btn" name = "submit" id="submit-btn">Register</button>
                </div>
            </div>

            <p>Already have a account?
                <a href="login.php" class="register-link">Login</a>
            </p>    
        </form>
      </div>    
</body>
</html>