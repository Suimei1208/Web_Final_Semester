<main>
    <div class="advance">
        <form method="post" class="test">
            <p>TOP FILMS</p>
            <div>
                <h2 style="position: absolute; margin-left: -5%;">Sort by:</h2>
            </div>
            <table>
                <tr>
                    <td style="padding: 10px 100px 0px 100px;">
                        <label class="containerad">Top View
                            <input type="checkbox" name="sort_asc_view">
                            <span class="checkmark"></span>
                        </label>
                    </td>
                    <td style="padding: 10px 100px 0px 100px;">
                        <label class="containerad">Lowest View
                            <input type="checkbox" name="sort_desc_view">
                            <span class="checkmark"></span>
                        </label>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 10px 100px 0px 100px;">
                        <label class="containerad">Top Rate
                            <input type="checkbox" name="sort_desc_rate">
                            <span class="checkmark"></span>
                        </label>
                    </td>
                    <td style="padding: 10px 100px 0px 100px;">
                        <label class="containerad">Lowest Rate
                            <input type="checkbox" name="sort_asc_rate">
                            <span class="checkmark"></span>
                        </label>
                    </td>
                </tr>
            </table>
            <div class="btn-ADS" style="margin-top: 9%;">
                <button type="submit" name="submit">Search</button>
            </div>
        </form>

    </div>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['sort_asc_view'])) {
            $desc_view = desc_view();
    ?>
            <div>
                <h2 style="display: flex; justify-content: center; align-items: center; color: #ffffff;">Sort by: Top View</h2>
            </div>
            <div class="update">
                <div class="card-content" style="display: none;">
                    <?php foreach ($desc_view as $p) {
                        if ($p['poster_small'] == null) $p['poster_small'] = 'fake.png';
                        if ($p['name_flim'] == null) $p['name_flim'] = 'Updating...';
                        if ($p['actor'] == null) $p['actor'] = 'Updating...';
                    ?>
                        <a href="info.php?movie_name=<?= $p['name_flim'] ?>" class="color_info">
                            <div class="card">
                                <div class="card-image">
                                    <img src="assets/img/<?= $p['poster_small'] ?>" alt="">
                                </div>
                                <div class="tooltip">
                                    <div class="item">
                                        <div class="NameFilm"><?= $p['name_flim'] ?></div>
                                        <div class="Story"><?= preg_replace("/\r\n|\r|\n/", "<br>", $p['content']); ?> </div>
                                        <div class="STD" style="color: #fffb00">
                                            <span style="margin-right: 10px;">
                                                <i class="fa-solid fa-star"></i><span class="col-while" style="color: #000000"> <?= $p['rate'] ?>/5 </span>
                                            </span>
                                            <span style="margin-right: 10px;">
                                                <i class="fa-regular fa-clock"></i> <span class="col-while" style="color: #000000"><?= $p['time'] ?> minutes</span>
                                            </span>
                                            <i class="fa-regular fa-calendar"></i> <span class="col-while" style="color: #000000"><?= $p['year'] ?></span>
                                        </div>
                                        <div class="AG">
                                            <div class="AU"><span>Director:</span> <?= $p['director'] ?></div>
                                            <div class="AC"><span>Actor:</span> <?= $p['actor'] ?></div>
                                            <div class="GE"><span>Genres:</span> <?= $p['genre'] ?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-info">
                                    <h3><?= $p['name_flim'] ?></h3>
                                    <p>View: <?= number_format($p['view']) ?></p>
                                </div>
                            </div>
                        </a>
                <?php }
                } ?>


                <?php if (isset($_POST['sort_desc_view'])) {
                    $asc_view = asc_view();
                ?>
                    <div>
                        <h2 style="display: flex; justify-content: center; align-items: center; color: #ffffff;">Sort by: Lowest View</h2>
                    </div>
                    <div class="update">
                        <div class="card-content" style="display: none;">
                            <?php foreach ($asc_view as $p) {
                                if ($p['poster_small'] == null) $p['poster_small'] = 'fake.png';
                                if ($p['name_flim'] == null) $p['name_flim'] = 'Updating...';
                                if ($p['actor'] == null) $p['actor'] = 'Updating...';
                            ?>
                                <a href="info.php?movie_name=<?= $p['name_flim'] ?>" class="color_info">
                                    <div class="card">
                                        <div class="card-image">
                                            <img src="assets/img/<?= $p['poster_small'] ?>" alt="">
                                        </div>
                                        <div class="tooltip">
                                            <div class="item">
                                                <div class="NameFilm"><?= $p['name_flim'] ?></div>
                                                <div class="Story"><?= preg_replace("/\r\n|\r|\n/", "<br>", $p['content']); ?> </div>
                                                <div class="STD" style="color: #fffb00">
                                                    <span style="margin-right: 10px;">
                                                        <i class="fa-solid fa-star"></i><span class="col-while" style="color: #000000"> <?= $p['rate'] ?>/5 </span>
                                                    </span>
                                                    <span style="margin-right: 10px;">
                                                        <i class="fa-regular fa-clock"></i> <span class="col-while" style="color: #000000"><?= $p['time'] ?> minutes</span>
                                                    </span>
                                                    <i class="fa-regular fa-calendar"></i> <span class="col-while" style="color: #000000"><?= $p['year'] ?></span>
                                                </div>
                                                <div class="AG">
                                                    <div class="AU"><span>Director:</span> <?= $p['director'] ?></div>
                                                    <div class="AC"><span>Actor:</span> <?= $p['actor'] ?></div>
                                                    <div class="GE"><span>Genres:</span> <?= $p['genre'] ?></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-info">
                                            <h3><?= $p['name_flim'] ?></h3>
                                            <p>View: <?= number_format($p['view']) ?></p>
                                        </div>
                                    </div>
                                </a>
                        <?php }
                        } ?>


                        <?php if (isset($_POST['sort_asc_rate'])) {
                            $asc_rate = asc_rate();
                        ?>

                            <div>
                                <h2 style="display: flex; justify-content: center; align-items: center; color: #ffffff;">Sort by: Lowest Rate</h2>
                            </div>
                            <div class="update">
                                <div class="card-content" style="display: none;">
                                    <?php foreach ($asc_rate as $p) {
                                        if ($p['poster_small'] == null) $p['poster_small'] = 'fake.png';
                                        if ($p['name_flim'] == null) $p['name_flim'] = 'Updating...';
                                        if ($p['actor'] == null) $p['actor'] = 'Updating...';
                                    ?>
                                        <a href="info.php?movie_name=<?= $p['name_flim'] ?>" class="color_info">
                                            <div class="card">
                                                <div class="card-image">
                                                    <img src="assets/img/<?= $p['poster_small'] ?>" alt="">
                                                </div>
                                                <div class="tooltip">
                                                    <div class="item">
                                                        <div class="NameFilm"><?= $p['name_flim'] ?></div>
                                                        <div class="Story"><?= preg_replace("/\r\n|\r|\n/", "<br>", $p['content']); ?> </div>
                                                        <div class="STD" style="color: #fffb00">
                                                            <span style="margin-right: 10px;">
                                                                <i class="fa-solid fa-star"></i><span class="col-while" style="color: #000000"> <?= $p['rate'] ?>/5 </span>
                                                            </span>
                                                            <span style="margin-right: 10px;">
                                                                <i class="fa-regular fa-clock"></i> <span class="col-while" style="color: #000000"><?= $p['time'] ?> minutes</span>
                                                            </span>
                                                            <i class="fa-regular fa-calendar"></i> <span class="col-while" style="color: #000000"><?= $p['year'] ?></span>
                                                        </div>
                                                        <div class="AG">
                                                            <div class="AU"><span>Director:</span> <?= $p['director'] ?></div>
                                                            <div class="AC"><span>Actor:</span> <?= $p['actor'] ?></div>
                                                            <div class="GE"><span>Genres:</span> <?= $p['genre'] ?></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-info">
                                                    <h3><?= $p['name_flim'] ?></h3>
                                                    <p>View: <?= number_format($p['view']) ?></p>
                                                </div>
                                            </div>
                                        </a>
                                <?php }
                                } ?>

                                <?php if (isset($_POST['sort_desc_rate'])) {
                                    $desc_rate = desc_rate(); ?>
                                    <div>
                                        <h2 style="display: flex; justify-content: center; align-items: center; color: #ffffff;">Sort by: Top Rate</h2>
                                    </div>
                                    <div class="update">
                                        <div class="card-content" style="display: none;">
                                            <?php foreach ($desc_rate as $p) {
                                                if ($p['poster_small'] == null) $p['poster_small'] = 'fake.png';
                                                if ($p['name_flim'] == null) $p['name_flim'] = 'Updating...';
                                                if ($p['actor'] == null) $p['actor'] = 'Updating...';
                                            ?>
                                                <a href="info.php?movie_name=<?= $p['name_flim'] ?>" class="color_info">
                                                    <div class="card">
                                                        <div class="card-image">
                                                            <img src="assets/img/<?= $p['poster_small'] ?>" alt="">
                                                        </div>
                                                        <div class="tooltip">
                                                            <div class="item">
                                                                <div class="NameFilm"><?= $p['name_flim'] ?></div>
                                                                <div class="Story"><?= preg_replace("/\r\n|\r|\n/", "<br>", $p['content']); ?> </div>
                                                                <div class="STD" style="color: #fffb00">
                                                                    <span style="margin-right: 10px;">
                                                                        <i class="fa-solid fa-star"></i><span class="col-while" style="color: #000000"> <?= $p['rate'] ?>/5 </span>
                                                                    </span>
                                                                    <span style="margin-right: 10px;">
                                                                        <i class="fa-regular fa-clock"></i> <span class="col-while" style="color: #000000"><?= $p['time'] ?> minutes</span>
                                                                    </span>
                                                                    <i class="fa-regular fa-calendar"></i> <span class="col-while" style="color: #000000"><?= $p['year'] ?></span>
                                                                </div>
                                                                <div class="AG">
                                                                    <div class="AU"><span>Director:</span> <?= $p['director'] ?></div>
                                                                    <div class="AC"><span>Actor:</span> <?= $p['actor'] ?></div>
                                                                    <div class="GE"><span>Genres:</span> <?= $p['genre'] ?></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card-info">
                                                            <h3><?= $p['name_flim'] ?></h3>
                                                            <p>View: <?= number_format($p['view']) ?></p>
                                                        </div>
                                                    </div>
                                                </a>
                                    <?php }
                                        }
                                    } ?>
                                        </div>
                                        <div class="pagination"></div>