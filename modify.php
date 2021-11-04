<!--- 게시글 수정 -->
<?php
include $_SERVER['DOCUMENT_ROOT'] . "/board/db.php";

$bno = $_GET['b_idx'];
$sql = mq("select * from board where b_idx='$bno';");
$board = $sql->fetch_array();
?>
<!doctype html>

<head>
    <meta charset="UTF-8">
    <title>게시판</title>

    <link rel="stylesheet" type="text/css" href="/board/css/style.css" />
</head>

<body>
    <div id="board_write">
        <h1><a href="/board">자유게시판</a></h1>
        <h4>글을 수정합니다.</h4>
        <div id="write_area">
            <form action="modify_ok.php?b_idx=<?php echo $bno; ?>" method="post">
                <div id="in_title">
                    <textarea name="b_title" id="utitle" rows="1" cols="55" placeholder="제목" maxlength="100"
                        required><?php echo $board['b_title']; ?></textarea>
                </div>
                <div class="wi_line"></div>
                <div id="in_name">
                    <textarea name="b_name" id="uname" rows="1" cols="55" placeholder="글쓴이" maxlength="100"
                        required><?php echo $board['b_name']; ?></textarea>
                </div>
                <div class="wi_line"></div>
                <div id="in_content">
                    <textarea name="b_content" id="ucontent" placeholder="내용"
                        required><?php echo $board['b_content']; ?></textarea>
                </div>
                <div id="in_pw">
                    <input type="password" name="b_pw" id="upw" placeholder="비밀번호" required />
                </div>
                <div class="bt_se">
                    <button type="submit">글 작성</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>