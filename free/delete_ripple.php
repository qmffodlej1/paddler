<?
	$table = $_GET['table'];
	$num = $_GET['num'];
	$ripple_num = $_GET['ripple_num'];

      include "../lib/dbconn.php";

      $sql = "delete from free_ripple where num=$ripple_num";
      $connect->query($sql);
	  $connect->close();

      echo "
	   <script>
	    location.href = 'view.php?table=$table&num=$num';
	   </script>
	  ";
?>
