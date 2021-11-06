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

$tmpfile =  $_FILES['b_file']['tmp_name'];
$o_name = $_FILES['b_file']['name'];
$filename = iconv("UTF-8", "EUC-KR", $_FILES['b_file']['name']);

// 경로 알아내기 이 부분에서 절대경로말고 상대경로로 찾는법
$root_path = $_SERVER["DOCUMENT_ROOT"];
$folder = $root_path . "/board/upload/" . $filename;
move_uploaded_file($tmpfile, $folder);


// echo strlen($userpw) . "<br>  ";
// echo " insert into board(b_name,b_pw,b_title,b_content,b_date,b_hit,b_lock_post) 
// values('" . $username . "','" . $userpw . "','" . $title . "','" . $content . "','" . $date . "','0','" . $lo_post . "')";

$mqq = mq("alter table board auto_increment =1"); //auto_increment 값 초기화

$sql = mq("insert into board(b_name,b_pw,b_title,b_content,b_date,b_lock_post,b_file)
    values('" . $_POST['b_name'] . "','" . $userpw . "','" . $_POST['b_title'] . "','" . $_POST['b_content'] . "','" . $date . "','" . $lo_post . "','" . $o_name . "')");


// echo $root_path . "<br>  ";
// echo strlen($o_name) . "<br>  ";
// echo "insert into board(b_name,b_pw,b_title,b_content,b_date,b_lock_post,b_file)
//     values('" . $_POST['b_name'] . "','" . $userpw . "','" . $_POST['b_title'] . "','" . $_POST['b_content'] . "','" . $date . "','" . $lo_post . "','" . $o_name . "')";


echo "<script>
    alert('글쓰기 완료되었습니다.');
    location.href='/board';</script>";
