<? 
	session_start(); 
	$table = @$_GET['table'];
	$mode = @$_GET['mode'];
	$num = @$_GET['num'];
	$page = @$_GET['page'];
	if (isset($_SESSION['userid'])) 
	{
			$userid = @$_SESSION['userid'];
			$username = @$_SESSION['username'];
			$usernick = @$_SESSION['usernick'];
			$userlevel = @$_SESSION['userlevel'];
	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head> 
<link href="../css/common.css" rel="stylesheet" type="text/css" media="all">
<link href="../css/board1.css" rel="stylesheet" type="text/css" media="all">
<meta charset="utf-8">
</head>
<?
	if ($mode=="modify" || $mode=="response")
	{
		include "../lib/dbconn.php";

		$sql = "select * from $table where num=$num";
		$result = $connect->query($sql);
		$row = $result->fetch_array(MYSQLI_ASSOC);      
	
		$item_subject     = $row['subject'];
		$item_content     = $row['content'];

		if ($mode=="response")
		{
			$item_subject = "[re]".$item_subject;
			$item_content = ">".$item_content;
			$item_content = str_replace("\n", "\n>", $item_content);
			$item_content = "\n\n".$item_content;
		}
		$connect->close();
	}else{
		$item_subject = "";
		$item_content = "";
	}
?>
<body>
<div id="wrap">
  <div id="header">
    <? include "../lib/top_login2.php"; ?>
  </div>  <!-- end of header -->
  <div id="menu">
	<? include "../lib/top_menu2.php"; ?>
  </div>  <!-- end of menu --> 

  <div id="content">
	<div id="col1">
		<div id="left_menu">
<?
			include "../lib/left_menu.php";
?>
		</div>
	</div>

	<div id="col2">        
		<div id="title">
			<img src="../img/title_qna.gif">
		</div>
		<div class="clear"></div>

		<div id="write_form_title">
			<img src="../img/write_form_title.gif">
		</div>
		<div class="clear"></div>
<?
	if($mode=="modify")
	{
?>
		<form  name="board_form" method="post" action="insert.php?mode=modify&num=<?=$num?>&page=<?=$page?>&table=<?=$table?>"> 
<?
	}
	else if ($mode=="response")
	{
?>
		<form  name="board_form" method="post" action="insert.php?mode=response&num=<?=$num?>&page=<?=$page?>&table=<?=$table?>"> 
<?
	}
	else
	{
?>
		<form  name="board_form" method="post" action="insert.php?table=<?=$table?>"> 
<?
	}
?>
		<div id="write_form">
			<div class="write_line"></div>
			<div id="write_row1">
				<div class="col1"> 닉네임 </div>
				<div class="col2"><?=$usernick?></div>
<?
	if( $userid && ($mode != "modify")  && ($mode != "response") )
	{
?>
				<div class="col3"><input type="checkbox" name="html_ok" value="y"> HTML 쓰기</div>
<?
	}
?>
			</div>
			<div class="write_line"></div>
			<div id="write_row2">
				<div class="col1"> 제목   </div>
			    <div class="col2"><input type="text" name="subject" value="<?=$item_subject?>"></div>
			</div>
			<div class="write_line"></div>
			<div id="write_row3">
				<div class="col1"> 내용   </div>
			    <div class="col2"><textarea rows="15" cols="79" name="content"><?=$item_content?></textarea></div>
			</div>
			<div class="write_line"></div>
		</div>

		<div id="write_button"><input type="image" src="../img/ok.png">&nbsp;
								<a href="list.php?table=<?=$table?>&page=<?=$page?>"><img src="../img/list.png"></a>
		</div>
		</form>

	</div> <!-- end of col2 -->
  </div> <!-- end of content -->
</div> <!-- end of wrap -->

</body>
</html>
