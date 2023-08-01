<? 
session_start();
$table = "anonym";
$ripple_table = "anonym_ripple";
$num = $_GET['num'];
$page = $_GET['page'];
if (isset($_SESSION['userid'])) {
	$userid = $_SESSION['userid'];
	$username = $_SESSION['username'];
	$usernick = $_SESSION['usernick'];
	$userlevel = $_SESSION['userlevel'];
}
include "../lib/dbconn.php";

$sql = "select * from $table where num=$num";
$result = $connect->query($sql);
$row = $result->fetch_array(MYSQLI_ASSOC);      
$item_num     = $row['num'];
$item_id      = $row['id'];
$item_name    = $row['name'];
$item_nick    = $row['nick'];
$item_hit     = $row['hit'];

$image_name[0]   = $row['file_name_0'];
$image_name[1]   = $row['file_name_1'];
$image_name[2]   = $row['file_name_2'];
$image_copied[0] = $row['file_copied_0'];
$image_copied[1] = $row['file_copied_1'];
$image_copied[2] = $row['file_copied_2'];

$item_date    = $row['regist_day'];
$item_subject = str_replace(" ", "&nbsp;", $row['subject']);
$item_content = $row['content'];
$is_html      = $row['is_html'];

if ($is_html!="y") {
	$item_content = str_replace(" ", "&nbsp;", $item_content);
	$item_content = str_replace("\n", "<br>", $item_content);
}	

for ($i=0; $i<3; $i++) {
	if ($image_copied[$i]) {
		$imageinfo = GetImageSize("./data/".$image_copied[$i]);
		$image_width[$i] = $imageinfo[0];
		$image_height[$i] = $imageinfo[1];
		$image_type[$i]  = $imageinfo[2];
		if ($image_width[$i] > 785)
			$image_width[$i] = 785;
	}
	else {
		$image_width[$i] = "";
		$image_height[$i] = "";
		$image_type[$i]  = "";
		}
	}

$new_hit = $item_hit + 1;
$sql = "update $table set hit=$new_hit where num=$num";   // 글 조회수 증가시킴
$connect->query($sql);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head> 
<meta charset="utf-8">
<link href="../css/common.css" rel="stylesheet" type="text/css" media="all">
<link href="../css/board4.css" rel="stylesheet" type="text/css" media="all">
<script>
	function check_input() {
		if (!document.ripple_form.ripple_content.value) {
			alert("내용을 입력하세요!");    
			document.ripple_form.ripple_content.focus();
			return;
		}
		document.ripple_form.submit();
    }
    function del(href) {
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
				<h1>익명게시판</h1>
			</div>
			<div id="view_title">
				<div id="view_title1" class="dkshk">제목: <?= $item_subject ?></div>
					<div id="view_title2">익명 | 조회 : <?= $item_hit ?> | <?= $item_date ?></div>
						<div class="clear"></div> <!-- 부유(floating) 문제 방지를 위한 추가적인 엘리먼트 -->
					</div>
					<div id="view_content">
						<?
						for ($i=0; $i<3; $i++) {
							if ($image_copied[$i]) {
								$img_name = $image_copied[$i];
								$img_name = "./data/".$img_name;
								$img_width = $image_width[$i];
								echo "<img src='$img_name' width='$img_width'>"."<br><br>";
							}
						}?>
					<?= $item_content ?>
					</div>

					<div id="ripple">
    					<form name="ripple_form" method="post" action="insert_ripple.php?table=<?=$table?>&num=<?=$item_num?>">
        				<div id="reply_box">
            				<div id="reply_input">
								<input type="text" class="dlstod" placeholder="덧글을 입력하세용!" name="ripple_content">
            					<div id="reply_button">
                					<a href="#"><input type="submit" class="button" value="덧글쓰기"></a>
    							</div>
							</div>
						</div>
					</div>
					</form>
					<form>
						<div id="view_button">

							<a href="list.php?table=<?=$table?>&page=<?=$page?>"><input type="button" value="목록" class="button_3"></a>&nbsp;
							<?php if (isset($userid) && ($userid == $item_id)) { ?>
								<a href="write_form.php?table=<?=$table?>&mode=modify&num=<?=$num?>&page=<?=$page?>"><input type="button" value="수정" class="button_3"></a>&nbsp;
								<a href="javascript:del('delete.php?table=<?=$table?>&num=<?=$num?>')"><input type="button" value="삭제" class="button_3"></a>&nbsp;
							<? } ?>
						</div> 
					</form>

    <?php
    $sql = "select * from anonym_ripple where parent='$item_num'";
    $ripple_result = $connect->query($sql);

    while ($row_ripple = $ripple_result->fetch_array(MYSQLI_ASSOC)) {
        $ripple_num = $row_ripple['num'];
        $ripple_id = $row_ripple['id'];
        $ripple_nick = $row_ripple['nick'];
        $ripple_content = str_replace("\n", "<br>", $row_ripple['content']);
        $ripple_content = str_replace(" ", "&nbsp;", $ripple_content);
        $ripple_date = $row_ripple['regist_day'];?>
		<div id="ripple_writer_title">
    		<ul class="dksl">
        	<li id="writer_title1">익명</li>
        	<li id="writer_title2"><?=@$item_date ?>: </li>
			<li id="ripple_content"><?=@$ripple_content ?></li>
			<li id="writer_tilte3"> 
			<?php
                if (@$userid == "admin" || @$userid == $ripple_id) {?>
                    <form action="delete_ripple.php" method="get">
					<?php echo $ripple_num; ?>
                    <button type="submit" class="button_3">삭제</button>
					<input type="hidden" name="table" value="<?php echo $table; ?>">
                    <input type="hidden" name="ripple_num" value="<?php echo $ripple_num; ?>">
					<input type="hidden" name="num" value="<?php echo $num; ?>">
                    </form>
				<?php } ?>
</div>
    <?php
    }
    ?>
</div> <!-- end of ripple -->
		<div class="clear"></div>
	</div> <!-- end of col2 -->
  </div> <!-- end of content -->
</div> <!-- end of wrap -->

</body>
</html>
