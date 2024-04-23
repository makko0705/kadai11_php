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
                    身長：<input type="text" name="cm"> cm<br>
                    体重：<input type="text" name="start_kg"> kg<br>

                    目標体重：<input type="text" name="goal_kg"> kg<br>
                    いつまでに痩せたい?：<input type="date" name="goal_day"><br>
                    <input type="submit" value="計算ボタン">
                </form>


                <?php include("tpl/sidebar.php"); ?>
            </div>

        </div><!--screen-->
    </div><!--phone-->
    <?php include("tpl/footer.php"); ?>


</body>

</html>