<?php
ini_set('display_errors', 1);
$title = "個人データ登録";
error_reporting(E_ALL);
include("../function.php");
$pdo = db_conn();

$todays_weight = $_POST["todays_weight"];
$todays_fat = $_POST["todays_fat"];

$stmt = $pdo->prepare("INSERT INTO todays_value_table(todays_weight,todays_fat,indate)VALUES(:todays_weight,:todays_fat,CURDATE())");
$stmt->bindValue(':todays_weight', $todays_weight, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':todays_fat',    $todays_fat,    PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //実行

?>

<!DOCTYPE html>
<html lang="en">
<?php include("../tpl/head.php"); ?>
<body>
    <?php include("../tpl/header.php"); ?>

    <div class="phone">
        <div class="screen">
            <div class="inner">

            <h1>今日の体重を登録しました</h1>
            <?php include("../tpl/sidebar.php");?>
            <div class="grade_area">
            <table>
            <tr>
                <th>体重</th>
                <td><span class="emphasis"><?=$todays_weight?></span><span>kg</span></td>
              </tr>
              <tr>
                <th>体脂肪率</th>
                <td><span class="emphasis"><?=$todays_fat?></span><span>%</span></td>
              </tr>
            </table>
            
            
            </div>
            </div>
        </div>
    </div>

    <?php include("../tpl/footer.php"); ?>

</body>

</html>