<?php

include("../function.php");
$pdo = db_conn();
$title = "グラフデータ";

$sql = "SELECT * FROM mydata_table ORDER BY id DESC";
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

$sql2 = "SELECT * FROM todays_value_table ORDER BY id DESC";
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
                            <h1>ダイエットの推移</h1>

                <?php foreach ($values as $v) { ?> <?php foreach ($values2 as $tv) { ?>
                        <?php if ($v === end($values)) { ?>
                            <!-- <div class="goal_area grade_area">
                                <table>
                                    <tr>
                                        <th>身長</th>
                                        <td><?= h($v["cm"]) ?>
                                    </tr>
                                    <tr>
                                        <th>スタート時の体重</th>
                                        <td><?= h($v["start_kg"]) ?></td>
                                    </tr>
                                    <tr>
                                        <th>最新の体重</th>
                                        <td><?= h($tv["todays_weight"]) ?></td>
                                    </tr>
                                </table>
                            </div> -->
                        <?php } ?>
                        <?php } ?><?php } ?>
                        <p class="btn"><a href="todayrecord.php">今日の記録</a></p>
                        <canvas id="myChart"></canvas>
                        <?php
                        include("../tpl/sidebar.php");
                        ?>
            </div>

        </div><!--screen-->
    </div><!--phone-->

    <?php include("../tpl/footer.php"); ?>




    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.2/dist/chart.umd.min.js"></script>
    <script>
        const a = '<?php echo $json; ?>';
        console.log(JSON.parse(a), "aです"); //出る
        const obj = JSON.parse(a);

        console.log(obj[0]);
        console.log(obj[0].start_kg);

        var len = obj.length;
        console.log(len);
        // console.log(obj.len.start_kg);

        let kg_data = [];
        let while_indate = [];
        for (let a in obj) { //for (変数名 in オブジェクト)
            // console.log(obj[id]);
            console.log(obj.id);
            console.log(obj[a].start_kg);
            console.log(obj[a].indate);

            kg_data.push(obj[a].start_kg);
            while_indate.push(obj[a].indate);
        }
        console.log(kg_data, "kg_dataの中身です");
        console.log(while_indate, "while_indateの中身です");


        const b = '<?php echo $json2; ?>';
        const obj_b = JSON.parse(b);
        console.log(b, "bの中身です");




        var ctx = document.getElementById("myChart");
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: while_indate,
                datasets: [{
                    label: 'Carp',
                    data: kg_data,
                    borderColor: '#829ac8',
                }],
            },
            options: {
                scales: {
                    y: {
                        reverse: true,
                    },
                },
            },
        });
    </script>



    <?php
    $goal_kg = $v["goal_kg"];
    $cm = isset($v["cm"]) ? intval($v["cm"]) : 0;
    $kg = isset($tv["todays_weight"]) ? intval($tv["todays_weight"]) : 0;
    $br = "<br>";
    function fat()
    {
        print "太り気味です";
        echo "<br>";
    }
    function thin()
    {
        print 'やせ気味です';
        echo "<br>";
    }
    function normal()
    {
        print '標準体型です';
        echo "<br>";
    }
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
    $to_goal = $tv["todays_weight"] - $v["goal_kg"];
    print "目標まで" . $to_goal . "kgです" . $br;

    ?>

</body>

</html>