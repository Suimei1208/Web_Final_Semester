<div class="advance">
    <form action="#" method="post" class="test">
    <p>Advance Search</p>
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
                <td>
                    <label class="containerad" >
                    <?=$p['genre']?>
                    <?php 
                    ?>
                    <input type="checkbox"  name="genre[]" value="<?=$p['genre']?>">
                    <span class="checkmark"></span>
                    </label>
                </td>
            <?php 
                $count++;
                if ($count % $cols == 0) {
                    echo "</tr>";
                }
                if ($count == $rows * $cols) {
                    break;
                }
            }?>
            </tr>
    </table>
    <div class="btn-ADS">
        <button type="submit" name="submit">Search</button>
    </div>             
    </form>
</div>

<?php
    if(isset($_POST['submit'])) {
        echo "<style>
        ..advance{
            margin-bottom: 0px;
        }
            </style>";
        if(isset($_POST['genre'])) {
            $selected_genres = $_POST['genre'];
            echo "<h3 class='title'>Search for: " . implode(", ", $selected_genres) . "</h3>";
            $name_flim_search = getFlims_Genre_advan($selected_genres); 
            if($name_flim_search == false) require_once('component/404.php');
            else{ ?>     
               <?php if($name_flim_search ) { ?>
                    <div class="update">
                    <div class="card-content" style="display: none;"> <?php
                    foreach($name_flim_search as $p){
                        if($p['poster_small'] == null) $p['poster_small'] = 'fake.png';
                                if($p['name_flim'] == null) $p['name_flim'] = 'Updating...';   
                                if($p['actor'] == null) $p['actor'] = 'Updating...';                
                        ?>
                        <a href="info.php?movie_name=<?=$p['name_flim']?>" class = "color_info">
                            <div class="card">
                                <div class="card-image">
                                    <img src="assets/img/<?=$p['poster_small']?>" alt=""></div>
                                <div class="tooltip">
                                <div class="item">
                                    <div class="NameFilm"><?=$p['name_flim']?></div>
                                    <div class="Story"><?=preg_replace("/\r\n|\r|\n/","<br>", $p['content']);?> </div> 
                                    <div class="STD" style="color: #fffb00">
                                            <span style="margin-right: 10px;">
                                                <i class="fa-solid fa-star"></i><span class="col-while" style="color: #000000"> <?=$p['rate']?>/5 </span> 
                                            </span>
                                            <span style="margin-right: 10px;">
                                                <i class="fa-regular fa-clock" ></i> <span class="col-while" style="color: #000000"><?=$p['time']?> minutes</span> 
                                            </span>                
                                            <i class="fa-regular fa-calendar"></i> <span  class="col-while" style="color: #000000"><?=$p['year']?></span>
                                    </div>
                                    <div class="AG">
                                        <div class="AU"><span>Director:</span> <?=$p['director']?></div>
                                        <div class="AC"><span>Actor:</span> <?=$p['actor']?></div>
                                        <div class="GE"><span>Genres:</span> <?=$p['genre']?></div>
                                    </div>
                                </div>
                            </div>
                                <div class="card-info">
                                    <h3><?=$p['name_flim']?></h3>
                                    <p>View: <?=number_format($p['view'])?></p>
                                </div>
                            </div>
                        </a>
                <?php }  
                echo '<div class="pagination"></div>';                           
            }}}}else{
                    echo "<style>
                    .advance{
                        margin-bottom: 300px;
                        </style>";
            }
?>