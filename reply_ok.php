<?php
include $_SERVER['DOCUMENT_ROOT'] . "/board/db.php";

$bno = $_GET['r_idx'];
$userpw = password_hash($_POST['dat_pw'], PASSWORD_DEFAULT);

$sql = mq("insert into reply(r_con_num,r_name,r_pw,r_content) 
values('" . $bno . "','" . $_POST['dat_user'] . "','" . $userpw . "','" . $_POST['r_content'] . "')");

?>
<link rel="stylesheet" type="text/css" href="/board/css/jquery-ui.css" />
<link rel="stylesheet" type="text/css" href="/board/css/style.css" />
<script type="text/javascript" src="/board/js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="/board/js/jquery-ui.js"></script>
<script type="text/javascript" src="/board/js/common.js"></script>

<h3>댓글목록</h3>
<?php
$sql3 = mq("select * from reply where r_con_num='" . $bno . "' order by r_idx desc");
while ($reply = $sql3->fetch_array()) {
?>
<div class="dap_lo">
    <div><b><?php echo $reply['r_name']; ?></b></div>
    <div class="dap_to comt_edit"><?php echo nl2br("$reply[r_content]"); ?></div>
    <div class="rep_me dap_to"><?php echo $reply['r_date']; ?></div>
    <div class="rep_me rep_menu">
        <a class="dat_edit_bt" href="#">수정</a>
        <a class="dat_delete_bt" href="#">삭제</a>
    </div>

    <!-- 댓글 수정 폼 dialog -->
    <div class="dat_edit">
        <form method="post" action="rep_modify_ok.php">
            <input type="hidden" name="rno" value="<?php echo $reply['r_idx']; ?>" /><input type="hidden" name="b_no"
                value="<?php echo $bno; ?>">
            <input type="password" name="r_pw" class="dap_sm" placeholder="비밀번호" />
            <textarea name="r_content" class="dap_edit_t"><?php echo $reply['r_content']; ?></textarea>
            <input type="submit" value="수정하기" class="re_mo_bt">
        </form>
    </div>

    <!-- 댓글 삭제 비밀번호 확인 -->
    <div class='dat_delete'>
        <form action="reply_delete.php" method="post">
            <input type="hidden" name="rno" value="<?php echo $reply['r_idx']; ?>" /><input type="hidden" name="b_no"
                value="<?php echo $bno; ?>">
            <p>비밀번호<input type="password" name="r_pw" /> <input type="submit" value="확인"></p>
        </form>
    </div>

</div>
<?php } ?>

<!--- 댓글 입력 폼 -->
<div class="dap_ins">
    <input type="hidden" name="bno" class="bno" value="<?php echo $bno; ?>">
    <input type="text" name="dat_user" id="dat_user" class="dat_user" size="15" placeholder="아이디">
    <input type="password" name="dat_pw" id="dat_pw" class="dat_pw" size="15" placeholder="비밀번호">
    <div style="margin-top:10px; ">
        <textarea name="r_content" class="reply_content" id="re_content"></textarea>
        <button id="rep_bt" class="re_bt">댓글</button>
    </div>
</div>