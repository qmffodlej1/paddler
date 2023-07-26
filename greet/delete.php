<?
   session_start();

   include "../lib/dbconn.php";
	$num = $_GET['num'];

   $sql = "delete from greet where num = $num";
	$result = $connect->query($sql);
	$result = $connect->query($sql); // 옛날 코드라서 바꿔줘야한다

   echo "
	   <script>
	    location.href = 'list.php';
	   </script>
	";
?>

