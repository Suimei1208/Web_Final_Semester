<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Home</title>
        <link rel="stylesheet" href="./assets/css/style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    </head>
    <body>
        <?php
            include 'API/setup.php';
            include 'component/header.php';
            if(isset($_GET['movie_name'])){
                $name_films =$_GET['movie_name'];

            }
        ?>













































        <?php
            include 'component/footer.php';
        ?>
        <script 
        src="assets/js/script.js">     
        </script>
    </body>
</html>