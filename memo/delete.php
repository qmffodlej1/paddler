<?php
session_start();
if (!isset($_SESSION['userid'])) {
    echo "<script>alert('로그인 후 이용해주세요.');history.go(-1);</script>";
    exit;
}

if (isset($_GET['num'])) {
    $num = $_GET['num'];
} else {
    echo "<script>alert('잘못된 접근입니다.');history.go(-1);</script>";
    exit;
}

include "../lib/dbconn.php";

// 사용자가 삭제 권한이 있는지 확인합니다.
$sql = "SELECT id FROM memo WHERE num='$num'";
$result = $connect->query($sql);
$row = $result->fetch_array(MYSQLI_ASSOC);
$memo_id = $row['id'];

$userid = $_SESSION['userid'];
if ($userid != "admin" && $userid != $memo_id) {
    echo "<script>alert('권한이 없습니다.');history.go(-1);</script>";
    exit;
}

// 삭제 확인 창을 띄웁니다.
echo "<script>
    const confirmed = confirm('이 항목을 삭제하시겠습니까?');
    if (confirmed) {
        window.location.href = 'delete_comment_process.php?num=$num';
    } else {
        history.go(-1);
    }
</script>";
?>
