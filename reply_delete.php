<?php
include $_SERVER['DOCUMENT_ROOT'] . "/board/db.php";
$rno = $_POST['rno'];
$sql = mq("select * from reply where r_idx='" . $rno . "'");
$reply = $sql->fetch_array();

$bno = $_POST['b_no'];
$sql2 = mq("select * from board where b_idx='" . $bno . "'");
$board = $sql2->fetch_array();

$pwk = $_POST['r_pw'];
$bpw = $reply['r_pw'];

if (password_verify($pwk, $bpw)) {
	$sql = mq("delete from reply where r_idx='" . $rno . "'"); ?>
<script type="text/javascript">
alert('댓글이 삭제되었습니다.');
location.replace("read.php?b_idx=<?php echo $board["b_idx"]; ?>");
</script>
<?php
} else { ?>
<script type="text/javascript">
alert('비밀번호가 틀립니다');
history.back();
</script>
<?php } ?>