<?
   include "../lib/dbconn.php";

   $sql = "delete from memo where num = $num";
   $result = $connect->query($sql);

   mysql_close();

   echo "
	   <script>
	    location.href = 'memo.php';
	   </script>
	";
?>

