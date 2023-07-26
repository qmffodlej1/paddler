<?
   session_start();

   include "../lib/dbconn.php";

   $sql = "delete from greet where num = $num";
	$result = $connect->query($sql);
   mysql_close();

   echo "
	   <script>
	    location.href = 'list.php';
	   </script>
	";
?>

