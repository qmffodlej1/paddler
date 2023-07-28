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
	if (isset($_GET['mode'])) {
	$mode = $_GET['mode'];
	$find = $_POST['find'];
	$search = $_POST['search'];
	}
	//$mode = "";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head> 
<meta charset="utf-8">
<link href="../css/common.css" rel="stylesheet" type="text/css" media="all">
<link href="../css/greet.css" rel="stylesheet" type="text/css" media="all">
<style type = "text/css">
div#list{
display: inline-block;
}
div#list_content{
display: inline-block;
}
div#list_item{
display: inline-block;

}
</style>
</head>
<?
	include "../lib/dbconn.php";

	$scale=10;			// 한 화면에 표시되는 글 수

    if ($mode=="search")
	{
		if(!$search)
		{
			echo("
				<script>
				 window.alert('검색할 단어를 입력해 주세요!');
			     history.go(-1);
				</script>
			");
			exit;
		}

		$sql = "select * from $table where $find like '%$search%' order by num desc";
	}
	else
	{
		$sql = "select * from $table order by num desc";
	}

	$result = $connect->query($sql);
	$total_record = $result->num_rows; // 전체 글 수

	// 전체 페이지 수($total_page) 계산 
	if ($total_record % $scale == 0)     
		$total_page = floor($total_record/$scale);      
	else
		$total_page = floor($total_record/$scale) + 1; 
 
	if (!$page)                 // 페이지번호($page)가 0 일 때
		$page = 1;              // 페이지 번호를 1로 초기화
 
	// 표시할 페이지($page)에 따라 $start 계산  
	$start = ($page - 1) * $scale;      

	$number = $total_record - $start;
?>
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
	<div id="col2">
        
		<div id="title">
			<h1>가입인사</h1>
		</div>

		<form  name="board_form" method="post" action="list.php?mode=search"> 
		<div id="list_search">
			<div id="list_search1">▷ 총 <?= $total_record ?> 개의 게시물이 있습니다.  </div>
			<div id="list_search2"><b><a>SELECT</a></b></div>
			<div id="list_search3">
				<select class="inpung" name="find">
                    <option value='subject'>제목</option>
                    <option value='content'>내용</option>
                    <option value='nick'>별명</option>
                    <option value='name'>이름</option>
				</select></div>
			<div id="list_search4"><input class="button_3" type="text" name="search"></div>
			<div id="list_search5"><input href="#" type=button class="button_3" value="목록"></div>
		</div>
		</form>

		<div class="clear"></div>
<div id="list">
		<div id="list_top_title">
			<ul>
				<li id="list_title1"><h3>번호</h3></li>
				<li id="list_title2"><h3>제목</h3></li>
				<li id="list_title3"><h3>글쓴이</h3></li>
				<li id="list_title4"><h3>등록일</h3></li>
				<li id="list_title5"><h3>조회</h3></li>
			</ul>		
		</div>
<?		
   for ($i=$start; $i<$start+$scale && $i < $total_record; $i++)                    
   {
      $result->data_seek($i);   
      // 가져올 레코드로 위치(포인터) 이동  
      $row = $result->fetch_array(MYSQLI_ASSOC);       
      // 하나의 레코드 가져오기
	
	  $item_num     = $row['num'];
	  $item_id      = $row['id'];
	  $item_name    = $row['name'];
  	  $item_nick    = $row['nick'];
	  $item_hit     = $row['hit'];

      $item_date    = $row['regist_day'];
	  $item_date = substr($item_date, 0, 10);  

	  $item_subject = str_replace(" ", "&nbsp;", $row['subject']);

?>		<div id="list_content">
			<div id="list_item">
				<ul>
				<li id="list_item1"><?= $number ?></li>
				<li style="cursor:pointer" onclick="location.href='view.php?num=<?=$item_num?>&page=<?=$page?>'" id="list_item2"><?= $item_subject ?></li>
				<li div id="list_item3"><?= $item_nick ?></li>
				<li div id="list_item4"><?= $item_date ?></li>
				<li div id="list_item5"><?= $item_hit ?></li>
				</ul>
			</div>
  		 </div>
<?
   	   $number--;
   }
?>
			<div id="page_button">
				<div id="page_num"> ◀ 이전 &nbsp;&nbsp;&nbsp;&nbsp; 
<?
   // 게시판 목록 하단에 페이지 링크 번호 출력
   for ($i=1; $i<=$total_page; $i++)
   {
		if ($page == $i)     // 현재 페이지 번호 링크 안함
		{
			echo "<a style='ab' href='#'><b> $i </b></a>";
		}
		else
		{ 
			echo "<a style='ab' href='list.php?page=$i'><b> $i </b></a>";
		}      
   }
?>			
			&nbsp;&nbsp;&nbsp;&nbsp;다음 ▶
				</div>
				<div id="button">
					<a href="list.php?page=<?=$page?>"><input href="#" type=button class="button_3" value="목록"></a>&nbsp;
<?php 		
	if($userid)
	{
?>
		<input onclick="location.href='write_form.php'" type=button class="button_3" value="글쓰기">
<?php
	}
?>
				</div>
			</div> <!-- end of page_button -->
		
        </div> <!-- end of list content -->

		<div class="clear"></div>

	</div> <!-- end of col2 -->
  </div> <!-- end of content -->
</div> <!-- end of wrap -->

</body>
</html>
