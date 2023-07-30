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
	<div id="col2">
        <form  name="member_form" method="post" action="modify.php"> 
		<div id="title">
			<img src="../img/title_member_modify.gif">
		</div>
		<div id="form_join">
			<div id="join1">
                <table class="center-table">
                    <tr>
                        <td> 아이디 </td>
                        <td> <?php echo $row['id']?>
                    </tr>
                    <tr>
                        <td> 비밀번호 </td>
                        <td> <input type="password" name="pass" value=""></td>
                    </tr>
                        <td> 비밀번호 확인 </td>
                        <td> <input type="password" name="pass_confirm" value=""></td>
                    </tr>
                    <tr>
                        <td> 이름 </td>
                        <td><input type="text" name="name" value="<?= $row['name'] ?>"></td>
                    </tr>   
                    <tr>
                        <td>닉네임</td>
                        <td><div id="nick1"><input type="text" name="nick" value="<?=$row['nick'] ?>"></div></td>
                        <td><div id="nick2" ><a href="#"><img src="../img/check_id.gif" onclick="check_nick()"></td>
                    </tr>
                    <tr>
                        <td>휴대폰</td>
                        <td><input type="text" class="hp" name="hp1" value="<?=$hp1?>">-
                            <input type="text" class="hp" name="hp2" value="<?=$hp2?>"> -
                            <input type="text" class="hp" name="hp3" value="<?=$hp3?>">
                        </td>
                    </tr>
                        <td> 이메일 </td>
                        <td> <input type="text" id="email1" name="email1" value="<?=$email1?>"> @ <input type="text" name="email2" value="<?=$email2?>"> </td>
                    </tr>
                </table>
            </div>
		</div>
			<div class="clear"></div>
			<div id="must"> * 는 필수 입력항목입니다.^^</div>
		    <div id="button">
                <a href="#"><img src="../img/button_save.gif"  onclick="check_input()"></a>&nbsp;&nbsp;
		        <a href="#"><img src="../img/button_reset.gif" onclick="reset_form()"></a>
		    </div>
        </div>
	    </form>
	</div>
  </div>
</div>

</body>
</html>
