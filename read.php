<?php
include $_SERVER['DOCUMENT_ROOT'] . "/board/db.php";
?>
<!doctype html>

<head>
    <meta charset="UTF-8">
    <title>게시판</title>
    <link rel="stylesheet" type="text/css" href="/board/css/jquery-ui.css" />
    <link rel="stylesheet" type="text/css" href="/board/css/style.css" />
    <script type="text/javascript" src="/board/js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="/board/js/jquery-ui.js"></script>
    <script type="text/javascript" src="/board/js/common.js"></script>

</head>

<body>
    <?php
    $bno = $_GET['b_idx']; /* bno함수에 idx값을 받아와 넣음*/
    $hit = mysqli_fetch_array(mq("select * from board where b_idx ='" . $bno . "'"));
    $hit = $hit['b_hit'] + 1;
    $fet = mq("update board set b_hit = '" . $hit . "' where b_idx = '" . $bno . "'");
    $sql = mq("select * from board where b_idx='" . $bno . "'"); /* 받아온 idx값을 선택 */
    $board = $sql->fetch_array();
    ?>

    <!-- 글 불러오기 -->
    <div id="board_read">
        <h2><?php echo $board['b_title']; ?></h2>
        <div id="user_info">
            <?php echo $board['b_name']; ?>
            <?php echo $board['b_date']; ?>
            조회:
            <?php echo $board['b_hit']; ?>
            <div id="bo_line"></div>
            <div>
                파일 : <a href="../../upload/
                <?php echo $board['b_file']; ?>" download>
                    <?php echo $board['b_file']; ?></a>
            </div>
        </div>
        <div id='bo_content'>
            <?php echo ("$board[b_content]"); ?>
        </div>
        <!-- 목록, 수정, 삭제 -->
        <div id="bo_ser">
            <ul>
                <li><a href="/board">[목록으로]</a></li>
                <li><a href="modify.php?b_idx=<?php echo $board['b_idx']; ?>">[수정]</a></li>
                <li><a href="delete.php?b_idx=<?php echo $board['b_idx']; ?>">[삭제]</a></li>
            </ul>
        </div>
    </div>


    <!--- 댓글 불러오기 -->
    <div class="reply_view">
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
                    <input type="hidden" name="rno" value="<?php echo $reply['r_idx']; ?>" /><input type="hidden"
                        name="b_no" value="<?php echo $bno; ?>">
                    <input type="password" name="r_pw" class="dap_sm" placeholder="비밀번호" />
                    <textarea name="r_content" class="dap_edit_t"><?php echo $reply['r_content']; ?></textarea>
                    <input type="submit" value="수정하기" class="re_mo_bt">
                </form>
            </div>

            <!-- 댓글 삭제 비밀번호 확인 -->
            <div class='dat_delete'>
                <form action="reply_delete.php" method="post">
                    <input type="hidden" name="rno" value="<?php echo $reply['r_idx']; ?>" /><input type="hidden"
                        name="b_no" value="<?php echo $bno; ?>">
                    <p>비밀번호<input type="password" name="r_pw" /> <input type="submit" value="확인"></p>
                </form>
            </div>
        </div>
        <?php } ?>

        <!--- 댓글 입력 폼 -->
        <div class="dap_ins">
            <form action="reply_ok.php?r_idx=<?php echo $bno; ?>" method="post">
                <input type="text" name="dat_user" id="dat_user" class="dat_user" size="15" placeholder="아이디">
                <input type="password" name="dat_pw" id="dat_pw" class="dat_pw" size="15" placeholder="비밀번호">
                <div style="margin-top:10px; ">
                    <textarea name="r_content" class="reply_content" id="re_content"></textarea>
                    <button id="rep_bt" class="re_bt">댓글</button>
                </div>
            </form>
        </div>

    </div>
    <!--- 댓글 불러오기 끝 -->
    <div id="foot_box"></div>
    </div>

</body>

</html>