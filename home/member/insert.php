<?
	$id = $_POST['id'];
	$pass = $_POST['pass'];
	$name = $_POST['name'];
	$nick = $_POST['nick'];
	$hp1 = $_POST['hp1'];
	$hp2 = $_POST['hp2'];
	$hp3 = $_POST['hp3'];
	$email1 = $_POST['email1'];
	$email2 = $_POST['email2'];
?>
<meta charset="utf-8">
<?
   $hp = $hp1."-".$hp2."-".$hp3;
   $email = $email1."@".$email2;

   $regist_day = date("Y-m-d (H:i)");  // 현재의 '년-월-일-시-분'을 저장
   $ip = $_SERVER['REMOTE_ADDR'];         // 방문자의 IP 주소를 저장

   include "../lib/dbconn.php";       // dconn.php 파일을 불러옴

   $sql = "select * from member where id='$id'";
   $result = $connect->query($sql);
   $exist_id = $result->num_rows;

   if($exist_id) {
     echo("
           <script>
             window.alert('해당 아이디가 존재합니다.')
             history.go(-1)
           </script>
         ");
         exit;
   }
   else
   {            // 레코드 삽입 명령을 $sql에 입력
	    $sql = "insert into member(id, pass, name, nick, hp, email, regist_day, level) ";
		  $sql .= "values('$id', '$pass', '$name', '$nick', '$hp', '$email', '$regist_day', 9)";
		  $connect->query($sql);
      
   }
   $connect->close();
   echo "
   <script>
   location.href = '../login/login_form.php';
   </script>
	";
?>

   
