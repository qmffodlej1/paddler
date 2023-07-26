<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/common.css">
</head>

<body>
    <div id="container">
        <header class="header">
            <a href="index.php"> <!-- 로고를 클릭하면 현재 페이지(index.php)로 연결되도록 설정 -->
                <img src="img/logo2.png" class="logo" alt="로고">
            </a>
            <?php
            if (empty($userid)) {
                echo '<div id="top_login"><a href="./login/login_form.php">로그인</a> | <a href="./member/member_form.php">회원가입</a></div>';
            } else {
                echo '<div id="top_login">' . $usernick . ' (level: ' . $userlevel . ') | <a href="./login/logout.php">로그아웃</a> | <a href="./login/member_form_modify.php">정보수정</a></div>';
            }
            ?>
        </header>
        <div id="wrap">
            <div id="menu">
                <?php include "./lib/top_menu1.php"; ?>
            </div> <!-- end of wrap -->
        </div> <!-- end of container -->
    </body>
</html>
