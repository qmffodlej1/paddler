<?
   session_start();
   if (isset($_SESSION['userid'])) 
{
        $userid = $_SESSION['userid'];
        $username = $_SESSION['username'];
        $usernick = $_SESSION['usernick'];
        $userlevel = $_SESSION['userlevel'];
}
$table = "memo";
$num = $_POST['num'];
$ripple_content = $_POST['ripple_content'];
if (isset($_GET['mode'])) {
$mode = $_GET['mode'];
$find = $_POST['find'];
$search = $_POST['search'];
}?>
<meta charset="utf-8">
<?
   if(!@$userid) {
     echo("
	   <script>
	     window.alert('로그인 후 이용하세요.')
	     history.go(-1)
	   </script>
	 ");
	 exit;
   }
   
   if(!$ripple_content) {
     echo("
	   <script>
	     window.alert('내용을 입력하세요.')
	     history.go(-1)
	   </script>
	 ");
	 exit;
   }
   
   include "../lib/dbconn.php";       // dconn.php 파일을 불러옴

   $sql = "select * from member where id='$userid'";
   $result = $connect->query($sql);
   $row = $result->fetch_array(MYSQLI_ASSOC);
   $name = $row['name'];
   $nick = $row['nick'];

   $regist_day = date("Y-m-d (H:i)");  // 현재의 '년-월-일-시-분'을 저장

   // 레코드 삽입 명령
   $sql = "insert into memo_ripple (parent, id, name, nick, content, regist_day) ";
   $sql .= "values($num, '$userid', '$name', '$nick', '$ripple_content', '$regist_day')";    
   
   $result = $connect->query($sql);
   $connect->close();              // DB 연결 끊기
   
   echo "
	   <script>
	    location.href = 'memo.php';
	   </script>
	";
?>

   
