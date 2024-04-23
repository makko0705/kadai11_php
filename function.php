<?php
//pathの設定
$path = "/php/kadai11_php/";

//DBの設定
function db_conn() {
    try {
        include("tpl/db.php");
        // $db_name = "diet_db";    //データベース名
        // $db_id   = "root";      //アカウント名
        // $db_pw   = "";          //パスワード：XAMPPはパスワード無し or MAMPはパスワード”root”に修正してください。
        // $db_host = "localhost"; //DBホスト

        return new PDO('mysql:dbname='.$db_name.';charset=utf8;host='.$db_host, $db_id, $db_pw);
    } catch (PDOException $e) {
        exit('DB Connection Error:'.$e->getMessage());
    }
}


//SQLエラー関数：sql_error($stmt)
function sql_error($stmt) {
    $error = $stmt->errorInfo();
    exit("SQLError:".$error[2]);
}


//XSS対応（ echoする場所で使用！それ以外はNG ）
function h($str){
    return htmlspecialchars($str, ENT_QUOTES);
}