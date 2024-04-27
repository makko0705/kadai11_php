<?php

include("../function.php");
$pdo = db_conn();
$title = "マイページ";

//$sql = "SELECT * FROM mydata_table ORDER BY id DESC";
$sql = "SELECT * FROM mydata_table ORDER BY id DESC LIMIT 1";

$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

//$sql2 = "SELECT * FROM todays_value_table ORDER BY id DESC";
$sql2 = "SELECT * FROM todays_value_table ORDER BY id DESC LIMIT 1";
$stmt2 = $pdo->prepare($sql2);
$status2 = $stmt2->execute();

$values = "";
if ($status == false) {
    sql_error($stmt);
}
$values2 = "";
if ($status2 == false) {
    sql_error($stmt2);
}
//全データ取得
$values =  $stmt->fetchAll(PDO::FETCH_ASSOC); //PDO::FETCH_ASSOC[カラム名のみで取得できるモード]
$json = json_encode($values, JSON_UNESCAPED_UNICODE);
$v =  $stmt->fetch(); //PDO::FETCH_ASSOC[カラム名のみで取得できるモード]


$values2 =  $stmt2->fetchAll(PDO::FETCH_ASSOC); //PDO::FETCH_ASSOC[カラム名のみで取得できるモード]
$json2 = json_encode($values2, JSON_UNESCAPED_UNICODE);
$tv =  $stmt2->fetch(); //PDO::FETCH_ASSOC[カラム名のみで取得できるモード]
$goal_kg = $v["goal_kg"];

function bmi()
{
    $cm = isset($v["cm"]) ? intval($v["cm"]) : 0;
    $kg = isset($tv["todays_weight"]) ? intval($tv["todays_weight"]) : 0;
    $br = "<br>";
    if ($kg === 0 or $cm === 0) {
        print '入力が不正です';
    } else {
        $bmi = round(($kg * 10000)  / ($cm * $cm), 2);
        print $cm . "センチ" . $kg . "キログラムのあなたのBMIは" . $bmi . "です。" . $br;
        if ($bmi >= 25.0) {
            fat();
        } else if ($bmi < 18.5) {
            thin();
        } else {
            normal();
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<?php include("../tpl/head.php"); ?>

<body>
    <?php
    include("../tpl/header.php");
    ?>
    <div class="phone">
        <div class="screen">
            <div class="inner">

                <?php foreach ($values as $v) { ?> <?php foreach ($values2 as $tv) { ?>
                        <?php if ($v === end($values)) { ?>

                            <h1>マイページ</h1>
                            <div class="goal_area grade_area">
                                <table>
                                <tr>
                                    <th>体重</th>
                                    <td><span class="emphasis"><?=$tv["todays_weight"]?></span><span>kg</span></td>
                                  </tr>
                                  <!-- <tr>
                                    <th>BMI</th>
                                    <td><span class="emphasis"><?php bmi(); ?></span></td>
                                  </tr> -->
                                    <tr>
                                        <th>目標まで</th>
                                        <td><span>あと</span><span class="emphasis"><?= round($tv["todays_weight"] - $v["goal_kg"], 2) ?></span><span>kg</span>
                                    </tr>
                                    <tr>
                                        <th>スタートから</th>
                                        <td><span></span><span><span class="emphasis"><?= round($v["start_kg"] - $tv["todays_weight"], 2) ?></span>kg減</span></td>
                                    </tr>
                                    <tr>
                                        <th>達成率</th>
                                        <td><span class="emphasis"><?= round((1 - $v["goal_kg"] / $tv["todays_weight"]) * 100, 1) ?></span><span>%</span></td>
                                    </tr>
                                </table>
                            </div>
                        <?php } ?>
                        <?php } ?><?php } ?>
                        <p class="btn"><a href="<?= $path ?>mypage/todayrecord.php">今日の記録</a></p>
                        <p class="btn"><a href="<?= $path ?>mypage/graph.php">グラフ</a></p>

                        <?php include("../tpl/sidebar.php"); ?>
            </div>
        </div><!--screen-->
    </div><!--phone-->

    <!-- <canvas id="myChart"></canvas> -->
    <?php include("../tpl/footer.php"); ?>


</body>

</html>