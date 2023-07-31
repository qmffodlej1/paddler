<?php
    $table = $_GET['table'];
    $num = $_GET['num'];
    $ripple_num = $_GET['ripple_num'];

    include "../lib/dbconn.php";

    // 리플 삭제 쿼리
    $sql = "DELETE FROM anonym_ripple WHERE num=$ripple_num";
    $connect->query($sql);
    $connect->close();

    // view.php로 이동
    echo "<script>
            location.href = 'view.php?table=$table&num=$num';
          </script>";
?>
