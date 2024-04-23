<?php
$title = "個人データ登録";
?>
<!DOCTYPE html>
<html lang="en">
<?php include("tpl/head.php"); ?>
<body>
    <?php
    include("tpl/header.php");
    ?>

    <div class="phone">
        <div class="screen">
          <div class="inner">

            <h1>個人データ入力</h1>
            <form action="insert.php" method="post" enctype="multipart/form-data">
                今日の体重：<input type="text" name="todays_weight"> kg<br>
                体脂肪率：<input type="text" name="todays_fat"> kg<br>
                <input type="submit" value="計算ボタン">
            </form>


            <?php include("tpl/sidebar.php"); ?>
            </div>
        </div><!--screen-->
    </div><!--phone-->
    <?php include("tpl/footer.php"); ?>


</body>

</html>