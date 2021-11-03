<?php

header('Content-Type: text/html; charset=utf-8');



// localhost = DB주소, web=DB계정아이디, 1234=DB계정비밀번호, post_board="DB이름"   
$db = new mysqli("localhost", "user0", "123412", "board");
$db->set_charset("utf8");


function mq($sql)
{
    global $db;
    return $db->query($sql);
}


if ($db) {
    echo "MySQL 접속 성공";
} else {
    echo "MySQL 접속 실패";
}