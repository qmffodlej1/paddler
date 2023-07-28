<?
      include "../lib/dbconn.php";
    $num = $_GET['num'];
	$sql = "delete from memo_ripple where num=$num";
	$result = $connect->query($sql);

	$connect->close();  

      echo "
	   <script>
	    location.href = 'memo.php';
	   </script>
	  ";
?>


