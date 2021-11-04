<?php
include $_SERVER['DOCUMENT_ROOT'] . "/board/db.php";
$rno = $_POST['rno'];
$sql = mq("select * from reply where r_idx='" . $rno . "'");
$reply = $sql->fetch_array();

$bno = $_POST['b_no'];
$sql2 = mq("select * from board where b_idx='" . $bno . "'");
$board = $sql2->fetch_array();

$sql3 = mq("update reply set r_content='" . $_POST['r_content'] . "' where r_idx = '" . $rno . "'"); ?>
<script type="text/javascript">
alert('수정되었습니다.');
location.replace("read.php?b_idx=<?php echo $bno; ?>");
</script>
?>