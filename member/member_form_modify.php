<?
    session_start();
    if (isset($_SESSION['userid'])) 
	{
			$userid = $_SESSION['userid'];
			$username = $_SESSION['username'];
			$usernick = $_SESSION['usernick'];
			$userlevel = $_SESSION['userlevel'];
	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head> 
<meta charset="utf-8">
<link href="../css/common.css" rel="stylesheet" type="text/css" media="all">
<link href="../css/member.css" rel="stylesheet" type="text/css" media="all">
<script>
   function check_id()
   {
     window.open("../member/check_id.php?id=" + document.member_form.id.value,
         "IDcheck",
          "left=200,top=200,width=250,height=100,scrollbars=no,resizable=yes");
   }

   function check_nick()
   {
     window.open("../member/check_nick.php?nick=" + document.member_form.nick.value,
         "NICKcheck",
          "left=200,top=200,width=250,height=100,scrollbars=no,resizable=yes");
   }

   function check_input()
   {
      if (!document.member_form.pass.value)
      {
          alert("비밀번호를 입력하세요");    
          document.member_form.pass.focus();
          return;
      }

      if (!document.member_form.pass_confirm.value)
      {
          alert("비밀번호확인을 입력하세요");    
          document.member_form.pass_confirm.focus();
          return;
      }

      if (!document.member_form.name.value)
      {
          alert("이름을 입력하세요");    
          document.member_form.name.focus();
          return;
      }

      if (!document.member_form.nick.value)
      {
          alert("닉네임을 입력하세요");    
          document.member_form.nick.focus();
          return;
      }

      if (!document.member_form.hp2.value || !document.member_form.hp3.value )
      {
          alert("휴대폰 번호를 입력하세요");    
          document.member_form.nick.focus();
          return;
      }

      if (document.member_form.pass.value != 
            document.member_form.pass_confirm.value)
      {
          alert("비밀번호가 일치하지 않습니다.\n다시 입력해주세요.");    
          document.member_form.pass.focus();
          document.member_form.pass.select();
          return;
      }

      document.member_form.submit();
   }

   function reset_form()
   {
      document.member_form.id.value = "";
      document.member_form.pass.value = "";
      document.member_form.pass_confirm.value = "";
      document.member_form.name.value = "";
      document.member_form.nick.value = "";
      document.member_form.hp1.value = "010";
      document.member_form.hp2.value = "";
      document.member_form.hp3.value = "";
      document.member_form.email1.value = "";
      document.member_form.email2.value = "";
	  
      document.member_form.id.focus();

      return;
   }
</script>
</head>
<?
    include "../lib/dbconn.php";

    $sql = "select * from member where id='$userid'";
    $result = $connect->query($sql);

    $row = $result->fetch_array(MYSQLI_ASSOC);

    $hp = explode("-", $row['hp']);
    $hp1 = $hp[0];
    $hp2 = $hp[1];
    $hp3 = $hp[2];

    $email = explode("@", $row['email']);
    $email1 = $email[0];
    $email2 = $email[1];

    $connect->close();
?>
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
        <form  name="member_form" method="post" action="modify.php"> 
		<div id="title">
			<h1>회원정보수정</h1>
		</div>
		<div id="form_join">
			<div id="join1">
            <div id="must"> * 는 필수 입력항목입니다.</div>

                <div class="center-table">
    <table>
        <tr>
            <td>*아이디</td>
            <td>
            <input name="id" class="input_12" value="<?php echo $userid; ?>" readonly="readonly">
            </td>
        </tr>
        <tr>
            <td>*비밀번호</td>
            <td>
            <input type="password" name="pass" class="input_12">
            </td>
        </tr>
        <tr>
            <td>
            </td>
        </tr>
        <tr>
            <td id="id3">
            *비밀번호 확인
        </td>
            <td>
                <input type="password" class="input_12" name="pass_confirm">
            </td>
        </tr>
        <tr>
            <td>
            이름
            </td>
            <td>
                <input type="text" name="name" class="input_12" value="<?php echo $username; ?>">
            </td>
        </tr>
        <tr>
            <td>
            닉네임
            </td>
            <td>
                <input type="text" name="nick" class="input_12" value="<?php echo $usernick; ?>">
            </td>
        </tr>
        <tr>
    <td>휴대폰</td>
    <td class="phone-input">
        <input type="text" class="hp inputta" name="hp1" value="<?php echo $hp1; ?>"><b>-</b>
        <input type="text" class="hp inputta" name="hp2" value="<?php echo $hp2; ?>"><b>-</b>
        <input type="text" class="hp inputta" name="hp3" value="<?php echo $hp3; ?>">
    </td>
</tr>
    </table>
            </div>
		</div>
			<div class="clear"></div>
<div id="button" class="right-bottom">
    <a href="#"><input type="button" class="button_1" onclick="check_input()" value="저장하기"></a>&nbsp;&nbsp;
    <a href="#"><input type="button" class="button_1" onclick="reset_form()" value="취소하기"></a>
        </div>
	    </form>
	</div>
  </div>
</div>

</body>
</html>