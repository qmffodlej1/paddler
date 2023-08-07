<? 
	session_start(); 
	if (isset($_SESSION['userid'])) 
	{
			$userid = $_SESSION['userid'];
			$username = $_SESSION['username'];
			$usernick = $_SESSION['usernick'];
			$userlevel = $_SESSION['userlevel'];
	}
	
	$table = "greet";
	$num = $_GET['num'];
	$page = $_GET['page'];
	if (isset($_GET['mode'])) {
	$mode = $_GET['mode'];
	$find = $_POST['find'];
	$search = $_POST['search'];

	}
	$mode = "";
	include "../lib/dbconn.php";

	$sql = "select * from greet where num=$num";
	$result = $connect->query($sql);
	$row = $result->fetch_array(MYSQLI_ASSOC);

      // 하나의 레코드 가져오기
	
	$item_num     = $row['num'];
	$item_id      = $row['id'];
	$item_name    = $row['name'];
  	$item_nick    = $row['nick'];
	$item_hit     = $row['hit'];

    $item_date    = $row['regist_day'];

	$item_subject = str_replace(" ", "&nbsp;", $row['subject']);

	$item_content = $row['content'];
	$is_html      = $row['is_html'];

	if ($is_html!="y")
	{
		$item_content = str_replace(" ", "&nbsp;", $item_content);
		$item_content = str_replace("\n", "<br>", $item_content);
	}	

	$new_hit = $item_hit + 1;

	$sql = "update greet set hit=$new_hit where num=$num";   // 글 조회수 증가시킴
	$result = $connect->query($sql); // 옛날 코드라서 바꿔줘야한다
	//mysql_query($sql, $connect);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head> 
<meta charset="utf-8">
<link href="../css/common.css" rel="stylesheet" type="text/css" media="all">
<link href="../css/greet.css" rel="stylesheet" type="text/css" media="all">
<script>
    function del(href) 
    {
        if(confirm("한번 삭제한 자료는 복구할 방법이 없습니다.\n\n정말 삭제하시겠습니까?")) {
                document.location.href = href;
        }
    }
</script>
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
	<div id="col_2">
        
	<div id="title">
			<h1>가입인사</h1>
		</div>
		<div id="view_title">
			<div id="view_title1"><?= $item_subject ?></div><div id="view_title2"><?= $item_nick ?> | 조회 : <?= $item_hit ?>  
			                      | <?= $item_date ?> </div>	
		</div>

		<div id="view_content">
			<?= $item_content ?>
		</div>
				<div id="view_button">
					<a href="list.php?table=<?=$table?>&page=<?=$page?>"><input type="button" value="목록" class="button_3"></a>&nbsp;
					<?php if ($userid == "admin" || isset($userid) && ($userid == $item_id)) { ?>
				<a href="modify_form.php?table=<?=$table?>&mode=modify&num=<?=$num?>&page=<?=$page?>"><input type="button" value="수정" class="button_3"></a>&nbsp;
		<a href="javascript:del('delete.php?table=<?=$table?>&num=<?=$num?>')"><input type="button" value="삭제" class="button_3"></a>&nbsp;
	<? } ?>
				</div>
</div> 

		</div>
		</div>
		<div class="clear"></div>
	</div> <!-- end of col2 -->
  </div> <!-- end of content -->
</div> <!-- end of wrap -->

</body>
</html>
