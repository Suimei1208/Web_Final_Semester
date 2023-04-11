<link rel="stylesheet" href="../assets/css/style.css">
<body>
    <header>
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
                                    foreach($genre as $p){
                                        if ($count % $cols == 0) {
                                        echo '<tr>';
                                        }
                                    ?>              
                                            <td><a href="search.php?genres=<?=$p['genre']?>"><?=$p['genre']?></a></td>
                                    <?php 
                                        $count++;
                                        if ($count % $cols == 0) {
                                            echo "</tr>";
                                        }
                                        if ($count == $rows * $cols) {
                                            break;
                                        }
                                    }?>

                                </table>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>          
            
            <a href="#">TV SERIES</a>
            <a href="#">MOVIE</a>
            <a href="#">TOP FILMS</a>
            <a href="#">NEW FILMS</a>
            <a href="#">ADVANCED SEARCH</a>
            <form action="search.php" method="post" class="he">
                <a class="search">
                    <input type="text" class="search__input" placeholder="Search film name" name="search">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </a>
            </form>
            <a href="login.php">LOGIN</a>
        </nav>
    </header>
</body>