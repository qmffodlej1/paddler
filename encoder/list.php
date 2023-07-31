<?
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head> 
<meta charset="utf-8">
<link href="../css/common.css" rel="stylesheet" type="text/css" media="all">
<link href="../css/board4.css" rel="stylesheet" type="text/css" media="all">
</head>
<div id="container">
    <body>
        <header class="header">
		<a href="../index.php"> <!-- 로고를 클릭하면 현재 페이지(index.php)로 연결되도록 설정 -->
                <img src="../img/logo2.png" class="logo" alt="로고">
            </a>
            <?php
            if (empty($userid)) {
                echo '<div id="top_login"><a href="../login/login_form.php">로그인</a> | <a href="../member/member_form.php">회원가입</a></div>';
            } else {
                echo '<div id="top_login">' . $usernick . ' (level: ' . $userlevel . ') | <a href="../login/logout.php">로그아웃</a> | <a href="../login/member_form_modify.php">정보수정</a></div>';
            }
            ?>
        </header>
        <div id="body">
        <div id="wrap">
            <div id="menu">
                <?php include "../lib/top_menu2.php"; ?>
            </div> <!-- end of menu -->
        </div> <!-- end of wrap -->
	<div id="col_2">        
    <body>
    <h1>Encoding Tool</h1>
    <form method="post" action="">
        <label for="order">Enter a string:</label>
        <input type="text" name="order" id="order" required>
        <input type="submit" value="sumbmit">
    </form>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $target = $_POST["order"];
        ?>

        <h2>Base64 Encoding:</h2>
        <?php
        $base64_cmd = shell_exec('base64 <<<' . $target);
        echo "<pre>{$base64_cmd}</pre>";
        ?>

        <h2>MD5 Hash:</h2>
        <?php
        $md5_cmd = shell_exec('md5sum <<<' . $target);
        echo "<pre>{$md5_cmd}</pre>";
        ?>

        <h2>SHA-256 Hash:</h2>
        <?php
        $sha256_cmd = shell_exec('sha256sum <<<' . $target);
        echo "<pre>{$sha256_cmd}</pre>";
        ?>

        <h2>SHA-512 Hash:</h2>
        <?php
        $sha512_cmd = shell_exec('sha512sum <<<' . $target);
        echo "<pre>{$sha512_cmd}</pre>";
        ?>

        <h2>URI Encoding:</h2>
        <pre><?php echo urlencode($target);?></pre>

    <?php
    }
    ?>
</body>

</html>


