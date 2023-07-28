<? session_start(); 
if (isset($_SESSION['userid'])) 
{
        $userid = $_SESSION['userid'];
        $username = $_SESSION['username'];
        $usernick = $_SESSION['usernick'];
        $userlevel = $_SESSION['userlevel'];
}
$table = "memo";
$content = $_POST['content'];
if (isset($_GET['mode'])) {
$mode = $_GET['mode'];
$find = $_POST['find'];
$search = $_POST['search'];
}?>
<meta charset="utf-8">
<?
	if(!$userid) {
		echo("
		<script>
	     window.alert('로그인 후 이용해 주세요.')
	     history.go(-1)
	   </script>
		");
		exit;
	}

	if(!$content) {
		echo("
	   <script>
	     window.alert('내용을 입력하세요.')
	     history.go(-1)
	   </script>
		");
	 exit;
	}

	$regist_day = date("Y-m-d (H:i)");  // 현재의 '년-월-일-시-분'을 저장

	include "../lib/dbconn.php";       // dconn.php 파일을 불러옴

	$sql = "select * from member where id='$userid'";
	$result = $connect->query($sql);

	$row = $result->fetch_array(MYSQLI_ASSOC);
	$name = $row['name'];
	$nick = $row['nick'];

	$sql = "insert into memo (id, name, nick, content, regist_day) ";
	$sql .= "values('$userid', '$name', '$nick', '$content', '$regist_day')";

	$result = $connect->query($sql);
	$connect->close();                // DB 연결 끊기

	echo "
	   <script>
	    location.href = 'memo.php';
	   </script>
	";
?>

  
