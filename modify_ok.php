<?php
include $_SERVER['DOCUMENT_ROOT'] . "/board/db.php";

// 데이터 받아오기
$bno = $_GET['b_idx'];
$username = $_POST['b_name'];
// $userpw = password_hash($_POST['b_pw'], PASSWORD_DEFAULT);
$title = $_POST['b_title'];
$content = $_POST['b_content'];
$pwd = $_POST['b_pw']; // $pwk변수에 POST값으로 받은 pw를 넣습니다.



// 비밀번호 체크
// 디비에서 비밀번호 가져오기 
$sql = mysqli_query($db, "select * from board where b_idx='" . $bno . "'") or die("알수없는 오류"); /* 받아온 idx값을 선택 */
$board = $sql->fetch_array();
$hash_pwd = $board['b_pw'];
$board['b_pw'];


// echo $pwd . " / " . gettype([$pwd]) . "/" . $hash_pwd . "/" . gettype([$hash_pwd]) .  "<br>  ";
// echo strlen($hash_pwd) . "<br>  ";


if (password_verify($pwd, $hash_pwd)) //다시 if문으로 DB의 pw와 입력하여 받아온 bpw와 값이 같은지 비교를 하고
{
    echo "성공" . "update board set b_name='" . $username . "',b_pw='" .
        $pwd . "',b_title='" . $title . "',b_content='" . $content . "' where b_idx='" . $bno . "'";

    $pwd = password_hash($_POST['b_pw'], PASSWORD_DEFAULT);
    // echo "update board set b_name='" . $username . "',b_pw='" .
    //     $userpw . "',b_title='" . $title . "',b_content='" . $content . "' where b_idx='" . $bno . "'";
    $sql = mq("update board set b_name='" . $username . "',b_pw='" .
        $pwd . "',b_title='" . $title . "',b_content='" . $content . "' where b_idx='" . $bno . "'");
?>

    <script type="text/javascript">
        alert("수정되었습니다");
        // location.replace("read.php?b_idx=<?php echo $board["b_idx"]; ?>");
        location.replace("/board");
    </script>

<?php
} else {

    echo "실패" . $pwd . $hash_pwd;
?>

    <script type="text/javascript">
        alert('비밀번호가 틀립니다');
        location.replace("modify.php?b_idx=<?php echo $board["b_idx"]; ?>");
    </script>
    <!--- 아니면 비밀번호가 틀리다는 메시지를 보여줍니다 -->
<?php }
?>