<?php
include("../function.php");
$pdo = db_conn();
$title = "個人データ登録";
?>
<!DOCTYPE html>
<html lang="en">
<?php include("../tpl/head.php"); ?>
<body class="input">
    <?php
    include("../tpl/header.php");
    ?>

    <div class="phone">
        <div class="screen">
          <div class="inner">

            <h1>個人データ入力</h1>
            <form action="insert.php" method="post" enctype="multipart/form-data">
                <h2>今日の体重：</h2>
                <label for=""><input type="text" name="todays_weight"> kg</label>
                <h2>体脂肪率：</h2>
                <label for=""><input type="text" name="todays_fat"> kg</label>
                <label for=""><input type="submit" value="登録する" class="submit btn"></label>
            </form>


            <?php include("../tpl/sidebar.php"); ?>
            </div>
        </div><!--screen-->
    </div><!--phone-->
    <?php include("../tpl/footer.php"); ?>


</body>

</html>