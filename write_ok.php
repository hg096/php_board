<?php

include $_SERVER['DOCUMENT_ROOT'] . "/board/db.php";

//각 변수에 write.php에서 input name값들을 저장한다
// 시간으로 기록하고 싶을땐 Y-m-d H:i:s
$date = date('Y-m-d');
$userpw = password_hash($_POST['b_pw'], PASSWORD_BCRYPT);

if (isset($_POST['b_lockpost'])) {
    $lo_post = '1';
} else {
    $lo_post = '0';
}

$tmpfile =  $_FILES['b_file']['b_tmp_name'];
$o_name = $_FILES['b_file']['b_name'];
$filename = iconv("UTF-8", "EUC-KR", $_FILES['b_file']['b_name']);
$folder = "../../upload/" . $filename;
move_uploaded_file($tmpfile, $folder);

if (move_uploaded_file($tmpfile, $folder) != (null or "")) {


    // echo strlen($userpw) . "<br>  ";
    // $sql = mysqli_query($db, " insert into board(b_name,b_pw,b_title,b_content,b_date,b_hit,b_lock_post) 
    // values('" . $username . "','" . $userpw . "','" . $title . "','" . $content . "','" . $date . "','0','" . $lo_post . "')");

    $sql = mq("insert into board(b_name,b_pw,b_title,b_content,b_date,b_lock_post,b_file)
    values('" . $_POST['b_name'] . "','" . $userpw . "','" . $_POST['b_title'] . "','" . $_POST['b_content'] . "','" . $date . "','" . $lo_post . "','" . $o_name . "')");

    // echo " insert into board(b_name,b_pw,b_title,b_content,b_date,b_hit,b_lock_post) 
    // values('" . $username . "','" . $userpw . "','" . $title . "','" . $content . "','" . $date . "','0','" . $lo_post . "')";

    echo "<script>
    alert('글쓰기 완료되었습니다.');
    location.href='/board';</script>";
} elseif (move_uploaded_file($tmpfile, $folder) == (null or "")) {

    $sql = mq("insert into board(b_name,b_pw,b_title,b_content,b_date,b_lock_post,)
    values('" . $_POST['b_name'] . "','" . $userpw . "','" . $_POST['b_title'] . "','" . $_POST['b_content'] . "','" . $date . "','" . $lo_post . "')");
} else {

    echo "<script>
    alert('글쓰기에 실패했습니다.');
    history.back();</script>";
}