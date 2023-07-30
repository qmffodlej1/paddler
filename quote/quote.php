<?
@$randomNumber - rand(1,100);
	session_start();
	@$page = $_GET['page'];
	if (isset($_SESSION['userid'])) 
	{
			$userid = $_SESSION['userid'];
			$username = $_SESSION['username'];
			$usernick = $_SESSION['usernick'];
			$userlevel = $_SESSION['userlevel'];
	}
	
	$table = "free";
	$ripple = "free_ripple";
	if (isset($_GET['mode'])) {
	$mode = $_GET['mode'];
	$find = $_POST['find'];
	$search = $_POST['search'];
	}
    if (isset($_GET['file_path'])) {
        $file = $_GET['file_path'];
        // 취약점: 사용자가 제어 가능한 입력($file)을 파일 경로로 사용
        // 이렇게 사용하면 상위 디렉토리로 이동하여 민감한 파일에 접근할 수 있음
        if (file_exists($file)) {
            $contents = file_get_contents($file);
            echo "<pre>" . htmlspecialchars($contents) . "</pre>";
        } else {
            echo "File not found.";
        }
    }
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head> 
<meta charset="utf-8">
<link href="../css/common.css" rel="stylesheet" type="text/css" media="all">
<link href="../css/board4.css" rel="stylesheet" type="text/css" media="all">
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
	<div id="col2">        
		<div id="title">
			<img src="../img/title_free.gif">
		</div>
<?
	include "../lib/dbconn.php";
	$scale=10;			// 한 화면에 표시되는 글 수

    if (@$mode=="search")
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
	if ($total_record % $scale == 0){     
		$total_page = floor($total_record/$scale); }     
	else{
		$total_page = floor($total_record/$scale) + 1;} 
 
	if (!$page){                 // 페이지번호($page)가 0 일 때
		$page = 1;}              // 페이지 번호를 1로 초기화
 
	// 표시할 페이지($page)에 따라 $start 계산  
	$start = ($page - 1) * $scale;      
	$number = $total_record - $start;
?>

<div id="container">
    <body>
    <p>오늘의 명언</p>
    <form action="" method="GET">
        <input type="hidden" name="file_path" value="./file/quote/{$randomNumber}.php">
        <input type="submit" value="button" />
    </form>
    <!-- <form action="" method="GET">
        <input type="hidden" name="file_path" value="../../public_files/not_sensitive.txt" />
        <input type="submit" value="명언2" />
    </form> -->
</body>

</html>


