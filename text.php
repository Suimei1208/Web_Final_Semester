<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
<form action="#" method="post">
    <label for="genre1">Select genres:</label>
    <br>
    <input type="checkbox" id="genre1" name="genre[]" value="Action">
    <label for="genre1">Action</label>
    <br>
    <input type="checkbox" id="genre2" name="genre[]" value="Comedy">
    <label for="genre2">Comedy</label>
    <br>
    <input type="checkbox" id="genre3" name="genre[]" value="Drama">
    <label for="genre3">Drama</label>
    <br><br>
    <button type="submit" name="submit">Submit</button>
</form>

<?php
    if(isset($_POST['submit'])){
        $selectedGenres = $_POST['genre'];
        if(empty($selectedGenres)){
            echo "You didn't select any genres.";
        } else {
            $genres = implode(", ", $selectedGenres);
            echo "You selected the following genres: $genres.";
        }
    }
?>

</body>

