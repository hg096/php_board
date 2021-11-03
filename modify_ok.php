<?php
include $_SERVER['DOCUMENT_ROOT'] . "/board/db.php";

// name 값으로 가져옴

$bno = $_GET['idx'];
$username = $_POST['name'];
$userpw = password_hash($_POST['pw'], PASSWORD_DEFAULT);
$title = $_POST['title'];
$content = $_POST['content'];

$sql = mq("update board set name='" . $username . "',pw='" .
    $userpw . "',title='" . $title . "',content='" . $content . "' where idx='" . $bno . "'"); ?>

<script type="text/javascript">
alert("수정되었습니다.");
location.href = '/board';
</script>
<!-- content에서 0의 역할? 빼면 링크가 안가짐 -->
<!-- <meta http-equiv="refresh" content="0 url=/board/read.php?idx=<?php echo $bno; ?>"> -->