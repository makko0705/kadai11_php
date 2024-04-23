<?php
ini_set('display_errors', 1);
$title = "個人データ登録";
error_reporting(E_ALL);
include("function.php");
$pdo = db_conn();

$cm   = $_POST["cm"];
$start_kg = $_POST["start_kg"];
$goal_kg = $_POST["goal_kg"];
$goal_day = $_POST["goal_day"];
$indate = date("Y-m-d");

$stmt = $pdo->prepare("INSERT INTO mydata_table(cm,start_kg,goal_kg,goal_day,indate)VALUES(:cm,:start_kg,:goal_kg,:goal_day,CURDATE())");
$stmt->bindValue(':cm',          $cm,          PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':start_kg',    $start_kg,    PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':goal_kg',     $goal_kg,     PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':goal_day',    $goal_day,    PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //実行

if ($_POST) {
  function bmi()
  {
    $cm = isset($_POST['cm']) ? intval($_POST['cm']) : 0;
    $kg = isset($_POST['start_kg']) ? intval($_POST['start_kg']) : 0;
    $start_kg = $_POST["start_kg"];
    $bmi = round(($kg * 10000)  / ($cm * $cm), 2);
    print "<p>" . $cm . "センチ" . $kg . "キログラムのあなたのBMIは" . $bmi . "です。";
    if ($start_kg === 0 or $cm === 0) {
      print '<p>入力が不正です</p>';
    } else {
      if ($bmi >= 25.0) {
        print '<p>太り気味です</p>';
        print '<p>今日から頑張りましょう！</p>';
      } else if ($bmi < 18.5) {
        print '<p>やせ気味です</p>';
        print '<p>少し太ってもいいですね！</p>';
      } else {
        print '<p>標準体型です</p>';
        print '<p>キープしましょう！</p>';
      }
    }
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<?php include("tpl/head.php"); ?>

<body>
  <?php include("tpl/header.php"); ?>

  <div class="phone">
    <div class="screen">
      <div class="inner">
        <h1>目標を設定しました</h1>
        <?php include("tpl/sidebar.php"); ?>
        <?php bmi(); ?>
      </div>
    </div>
  </div>

  <?php include("tpl/footer.php"); ?>

</body>

</html>