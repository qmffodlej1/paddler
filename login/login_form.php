<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head> 
<meta charset="utf-8">
<link href="../css/common.css" rel="stylesheet" type="text/css" media="all">
<link href="../css/member.css" rel="stylesheet" type="text/css" media="all">
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
        <form name="member_form" method="post" action="login.php"> 
		<div id="title">
			<h1>로 그 인</h1>
		</div>
       
		<div id="login_form">
			 <div class="clear"></div>

			 <div id="login1">
				<img src="../img/mul.png" width="180px" height="180px">
			 </div>
			 <div id="login2" class="login2">
				<div id="id_input_button">
					</div>
					<div id="id_pw_input">
						<ul class="aa">
						<h3 class="aaa">아이디</h3>
						<li><input type="text" name="id" class="input_12"></li>
						<h3 class="aaa">비밀번호</h3>
						<li><input type="password" name="pass" class="input_12"></li>
						</ul>						
					</div>
					<div id="login_button">
						<input type="submit" class="button_1" value="로그인"><br>
						<input onclick="location.href='../member/member_form.php'" type="button" class="button_1" value="회원가입하기"></a>
					</div>
				</div>
				<div class="clear"></div>
				<div id="join_button">아직 회원이 아니십니까?❣°ʚ(❛ั ᴗ ❛ั)ɞ°❣&nbsp;&nbsp;&nbsp;&nbsp;</div>
			 </div>			 
		</div> <!-- end of form_login -->

	    </form>
	</div> <!-- end of col2 -->
  </div> <!-- end of content -->
</div> <!-- end of wrap -->

</body>
</html>