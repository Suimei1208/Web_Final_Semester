<?php

$_SESSION['current_url'] = $_SERVER['REQUEST_URI'];

if (isset($_SESSION['username'])) {
    $loggedIn = true;
} else {
    $loggedIn = false;
}

if (isset($_COOKIE['username']) && isset($_COOKIE['password'])) {
    $savedUsername = $_COOKIE['username'];
    $savedPassword = $_COOKIE['password'];
    $loggedIn = true;
    $_SESSION['username'] = $savedUsername;
}
?>


<link rel="stylesheet" href="../assets/css/style.css">

<body>
    <header class="header">
        <img src="assets/img/LOGOMOUNT.png" alt="logo" class="logo">
        <nav class="navigation">
            <a href="./index.php">HOME</a>
            <div class="dropdown">
                <table class="dropdown-table">
                    <tr>
                        <td>
                            <a href="" class="dropbtn">GENRES</a>
                            <div class="dropdown-content">
                                <table>
                                    <?php
                                    $rows = count($genre);
                                    $cols = 7;
                                    $count = 0;
                                    foreach ($genre as $p) {
                                        if ($count % $cols == 0) {
                                            echo '<tr>';
                                        }
                                    ?>
                                        <td><a href="search.php?genres=<?= $p['genre'] ?>"><?= $p['genre'] ?></a></td>
                                    <?php
                                        $count++;
                                        if ($count % $cols == 0) {
                                            echo "</tr>";
                                        }
                                        if ($count == $rows * $cols) {
                                            break;
                                        }
                                    } ?>

                                </table>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>

            <a href="search.php?type=TV SERIES">TV SERIES</a>
            <a href="search.php?type=MOVIE">MOVIE</a>
            <a href="top.php?top_films=top">TOP FILMS</a>
            <a href="search.php?advanced_search=1" name="advanced_search">ADVANCED SEARCH</a>
            <form action="search.php" method="get" class="he">
                <a class="search" id="exception">
                    <input type="text" class="search__input" placeholder="Search film name" name="film_name">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </a>
            </form>

            <?php if ($loggedIn) : ?>
                <section id="user-section">
                    <div class="dropdown-Log">
                        <?php $avatar = get_avatar($_SESSION['username']);
                        foreach ($avatar as $a) {
                            if ($a['avatar'] == null) $a['avatar'] = "user.png"; ?>
                            <button onclick="myFunction()" class="dropbtn-Log" style="background-color: transparent;"><img src="assets/avatar/<?= $a['avatar'] ?>" alt="" style="width: 30px; height: 30px; border-radius: 50%; margin-right: 9px;"><?php echo $_SESSION['username']; ?> <i class="fa-solid fa-caret-down" style="margin-left: 5px;font-size: 30px;"></i></button>
                            <div id="myDropdown" class="dropdown-content-Log">
                                <a href="your_info.php?username=<?= $_SESSION['username'] ?>">Your profile</a>
                                <a href="library.php?username=<?= $_SESSION['username'] ?>">Library</a>
                                <a href="#">Help</a>
                                <a href="your_info.php?username=<?= $_SESSION['username'] ?>#change-password">Change password</a>
                                <a href="logout.php">Logout</a>
                            </div>
                    </div>
                </section>
            <?php }
                    else : ?>
            <a href="login.php">LOGIN</a>
        <?php endif; ?>
        </nav>
    </header>
</body>