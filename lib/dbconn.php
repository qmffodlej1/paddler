<?php
$host = "localhost"; // 호스트 주소
$user = "roror"; // 데이터베이스 사용자명
$pass = "qhdks12"; // 데이터베이스 비밀번호
$db = "db_home"; // 데이터베이스 이름
$page = 1;

$connect = new mysqli($host, $user, $pass, $db);

// 데이터베이스 연결 오류 체크
if ($connect->connect_error) {
    die("데이터베이스 연결에 실패했습니다: " . $connect->connect_error);
}
?>