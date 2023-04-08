<form action="#" method="post" class="test">
    <table class="">
        <div class="">
            <table>
            <?php 
                $rows = count($genre);
                $cols = 10;
                $count = 0;
                foreach($genre as $p){
                    if ($count % $cols == 0) {
                    echo '<tr>';
                    }
                ?>              
                        <td><input type="checkbox" name="genre[]" value="<?=$p['genre']?>"><?=$p['genre']?></td>
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
        </table>
    <button type="submit" name="submit">Submit</button>   
</form>

<style>
    .test{
        position: fixed;
        top: 500px;
    }
</style>

<?php
if(isset($_POST['submit'])) {
  if(!empty($_POST['genre'])) {
    foreach($_POST['genre'] as $selected) {?>
      <script>alert('<?php echo $selected; ?>');</script>;
    <?php }
  } else {
    echo '<h1>error</h1>';
  }
}
?>
