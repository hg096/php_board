<?php

include $_SERVER['DOCUMENT_ROOT'] . "/board/db.php";

//각 변수에 write.php에서 input name값들을 저장한다
$username = $_POST['name'];
$userpw = password_hash($_POST['pw'], PASSWORD_DEFAULT);
$title = $_POST['title'];
$content = $_POST['content'];
// 시간으로 기록하고 싶을땐 Y-m-d H:i:s
$date = date('Y-m-d');
if ($username && $userpw && $title && $content) {

    // echo " insert into board(name,pw,title,content,date) 
    // values(' " . $username . " ',' " . $userpw . " ',' " . $title . " ',' " . $content . " ',' " . $date . " ',' 0 ')";

    $sql = mq(" insert into board(name,pw,title,content,date,hit) 
    values(' " . $username . " ',' " . $userpw . " ',' " . $title . " ',' " . $content . " ',' " . $date . " ',' 0 ')");


    echo "<script>
    alert('글쓰기 완료되었습니다.');
    location.href='/board';</script>";
} else {

    echo "<script>
    alert('글쓰기에 실패했습니다.');
    history.back();</script>";
}