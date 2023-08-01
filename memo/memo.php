<?php
session_start();
if (isset($_SESSION['userid'])) 
{
        $userid = $_SESSION['userid'];
        $username = $_SESSION['username'];
        $usernick = $_SESSION['usernick'];
        $userlevel = $_SESSION['userlevel'];
}
$table = "memo";
if (isset($_GET['mode'])) {
$mode = $_GET['mode'];
$find = $_POST['find'];
$search = $_POST['search'];
}
$scale = 5; // 한 화면에 표시되는 글 수
include "../lib/dbconn.php";
$sql = "select * from $table order by num desc";
$result = $connect->query($sql);
$total_record = $result->num_rows;

// 전체 페이지 수($total_page) 계산 
if ($total_record % $scale == 0)
    $total_page = floor($total_record / $scale);
else
    $total_page = floor($total_record / $scale) + 1;

    $page = 1; // 페이지 번호를 1로 초기화

// 표시할 페이지($page)에 따라 $start 계산  
$start = ($page - 1) * $scale;

$number = $total_record - $start;

// 중복 코드를 함수로 정의
function displayMemo($number, $memo_nick, $memo_date, $memo_content, $memo_id, $memo_num, $userid) {
?>
    <div id="memo_writer_title">
        <ul>
            <li id="writer_title1"><?= $memo_num ?></li>
            <li id="writer_title2"><?= $memo_nick ?></li>
            <li id="writer_title3"><?= $memo_date ?></li>
            <li id="writer_title4">
                <?php
                if ($userid == "admin" || $userid == $memo_id) {?>
                <form action="delete.php" method="get">
                <input type="hidden" name="num" value="<?= $memo_num ?>">
                <button class="buttona" type="submit">삭제</button>
                </form>

                </form>

                <?php
                }
                ?>
            </li>
        </ul>
    </div>
    <div id="memo_content"><?= $memo_content ?></div>
    <div id="ripple">
        <div id="ripple2">
            <?php
			include "../lib/dbconn.php";
            $sql = "select * from memo_ripple where parent='$memo_num'";
            $ripple_result = $connect->query($sql);
            while ($row_ripple = $ripple_result->fetch_array(MYSQLI_ASSOC)) {
                $ripple_num = $row_ripple['num'];
                $ripple_id = $row_ripple['id'];
                $ripple_nick = $row_ripple['nick'];
                $ripple_content = str_replace("\n", "<br>", $row_ripple['content']);
                $ripple_content = str_replace(" ", "&nbsp;", $ripple_content);
                $ripple_date = $row_ripple['regist_day'];
            ?>
                <div id="ripple_writer_title">
                    <ul class="dksl">
                        <li id="writer_title1">↳ <?= $ripple_nick ?></li>
                        <li id="writer_title2"><?= $ripple_date ?>: </li>
                         <li id="ripple_content"><?= $ripple_content ?></li>
                         <li id="writer_title3">
                            <?php
                            if ($userid == "admin" || $userid == $ripple_id) {?>
                                <!-- 이 부분은 원하는 위치에 넣어주세요. -->
                                <form action="delete_ripple.php" method="get">
                                <input type="hidden" name="num" value="<?php echo $ripple_num; ?>">
                                <button class="buttonb">삭제</button>
                                </form>
                                <?php
                            }
                            ?>
                        </li>
                        </ul>
                        <div class="hor_line_ripple"></div></div>
            <?php
            }
            ?>
            <form name="ripple_form" method="post" action="insert_ripple.php">
                <input type="hidden" name="num" value="<?= $memo_num ?>">
                <div id="ripple_insert">
                        <input type="text" class="input_1" placeholder="덧글을 입력하세용!" name="ripple_content">
                    <div id="ripple_button"><button class="button_1">덧글입력</button></div>
                </div>
            </form>
            <div class="clear"></div>
            <div class="linespace_10"></div>
        </div> <!-- end of ripple2 -->
    </div> <!-- end of ripple -->
<?php
}

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>메모 게시판</title>
    <link href="../css/common.css" rel="stylesheet" type="text/css" media="all">
    <link href="../css/memo.css" rel="stylesheet" type="text/css" media="all">
</head>
<div id="container">
    <body>
        <header class="header">
		<a href="../index.php"> <!-- 로고를 클릭하면 현재 페이지(index.php)로 연결되도록 설정 -->
                <img src="../img/logo2.png" class="logo" alt="로고">
            </a>
            <?php
            if (empty($userid)) {
                echo '<div id="top_login"><a href="../login/login_form.php">로그인</a> | <a href="../member/member_form.php">회원가입</a></div>';
            } else {
                echo '<div id="top_login">' . $usernick . ' (level: ' . $userlevel . ') | <a href="../login/logout.php">로그아웃</a> | <a href="../login/member_form_modify.php">정보수정</a></div>';
            }
            ?>
        </header>
		<div id="body">
        <div id="wrap">
            <div id="menu">
                <?php include "../lib/top_menu2.php"; ?>
            </div> <!-- end of menu -->
        </div> <!-- end of wrap -->
        <div id="content">
        <div id="memo_row1">
        <form name="memo_form" method="post" action="./insert.php">
  <div id="memo_writer">
    <span>▷ <?= @$usernick ?></span>
  </div>
  <div id="memo1">
    <textarea class="dog2" rows="6" cols="95" name="content"></textarea>
  </div>
  <div id="memo2">
    <button class="button_1" type="submit">입력</button> <!-- 입력 버튼 -->
  </div>
</form>
        </div>
            <div id="col_2">
                <?php
                for ($i = $start; $i < $start + $scale && $i < $total_record; $i++) {
                    $result->data_seek($i);
                    $row = $result->fetch_array(MYSQLI_ASSOC);
                    $memo_id = $row['id'];
                    $memo_num = $row['num'];
                    $memo_date = $row['regist_day'];
                    $memo_nick = $row['nick'];
                    $memo_content = str_replace("\n", "<br>", $row['content']);
                    $memo_content = str_replace(" ", "&nbsp;", $memo_content);
                    displayMemo($number, $memo_nick, $memo_date, $memo_content, $memo_id, $memo_num, @$userid);
                }
                ?>
                    </form>
            </div> <!-- end of col2 -->
        </div> <!-- end of content -->
    </div> <!-- end of container -->
			</div>
</body>

</html>
