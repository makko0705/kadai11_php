<?php
$title = "個人データ登録";
?>
<!DOCTYPE html>
<html lang="en">
<?php include("tpl/head.php"); ?>

<body class="input">
    <?php
    include("tpl/header.php");
    ?>

    <div class="phone">
        <div class="screen">
            <div class="inner">

                <h1>個人データ入力</h1>
                <form action="insert.php" method="post" enctype="multipart/form-data">
                    <h2>身長：</h2>
                    <label for=""><input type="text" name="cm"> cm</label>
                    <h2>体重：</h2>
                    <label for=""><input type="text" name="start_kg"> kg</label>
                    <h2>目標体重：</h2>
                    <label for=""><input type="text" name="goal_kg"> kg</label>
                    <h2>いつまでに痩せたい?：</h2>
                    <label for=""><input type="date" name="goal_day"></label>
                    <label for=""><input type="submit" value="計算ボタン" class="submit btn"></label>
                </form>


                <?php include("tpl/sidebar.php"); ?>
            </div>

        </div><!--screen-->
    </div><!--phone-->
    <?php include("tpl/footer.php"); ?>


</body>

</html>