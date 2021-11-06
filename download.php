<?php
include $_SERVER['DOCUMENT_ROOT'] . "/board/db.php";
$bno = $_GET['b_idx']; /* bno함수에 idx값을 받아와 넣음*/
$sql = mq("select * from board where b_idx='" . $bno . "'"); /* 받아온 idx값을 선택 */
$board = $sql->fetch_array();

$root_path = $_SERVER["DOCUMENT_ROOT"];
$target_Dir = $root_path . "/board/upload/";


$file = $board['b_file'];
$down = $target_Dir . $file;
$filesize = filesize($down);

if (file_exists($down)) {
    header("Content-Type:application/octet-stream");
    header("Content-Disposition:attachment;filename=$file");
    header("Content-Transfer-Encoding:binary");
    header("Content-Length:" . filesize($target_Dir . $file));
    header("Cache-Control:cache,must-revalidate");
    header("Pragma:no-cache");
    header("Expires:0");

    if (is_file($down)) {
        $fp = fopen($down, "r");
        while (!feof($fp)) {
            $buf = fread($fp, 8096);
            $read = strlen($buf);
            print($buf);
            flush();
        }
        fclose($fp);
    }
} else {
?>
    <script>
        alert("존재하지 않는 파일입니다.")
    </script>
<?php } ?>