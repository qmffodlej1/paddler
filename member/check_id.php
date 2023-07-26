<?
	$id = $_GET['id']
?>
<meta charset="utf-8">
<?
   if(!$id) 
   {
	   echo("아이디를 입력하세요.111");
   }
   else
   {
      include "../lib/dbconn.php";
 
      $sql = "select * from member where id='$id' ";

      $result = $connect->query($sql);
      $num_record = $result->num_rows;

      if ($num_record)
      {
         echo "아이디가 중복됩니다!<br>";
         echo "다른 아이디를 사용하세요.<br>";
      }
      else
      {
         echo "사용가능한 아이디입니다.";
      }
    
      mysql_close();
   }
?>

