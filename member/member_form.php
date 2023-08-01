<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta charset="utf-8">
<link href="../css/common.css" rel="stylesheet" type="text/css" media="all">
<link href="../css/member.css" rel="stylesheet" type="text/css" media="all">
    <style>
        /* 가운데 정렬을 위한 스타일링 */
        .center-table {
            margin-left: 720px;
        }
    </style>
<script>
    function check_id()
    {
        window.open("check_id.php?id=" + document.member_form.id.value,
            "IDcheck",
            "left=200,top=200,width=200,height=60,scrollbars=no,resizable=yes");
    }

    function check_nick()
    {
        window.open("check_nick.php?nick=" + document.member_form.nick.value,
            "NICKcheck",
            "left=200,top=200,width=200,height=60,scrollbars=no,resizable=yes");
    } 

    function check_input()
    {
        if (!document.member_form.id.value) {
            ("아이디를 입력하세요")
            document.member_form.id.focus();
            return false;
        }
        if (!document.member_form.pass.value) {
            alert("비밀번호를 입력하세요");    
            document.member_form.pass.focus();
            return false;
        }
        if (!document.member_form.pass_confirm.value) {
            alert("비밀번호확인을 입력하세요");    
            document.member_form.pass_confirm.focus();
            return false;
        }
        if (!document.member_form.name.value) {
            alert("이름을 입력하세요");    
            document.member_form.name.focus();
            return false;
        }
        if (!document.member_form.nick.value) {
            alert("닉네임을 입력하세요");    
            document.member_form.nick.focus();
            return false;
        }
        if (!document.member_form.hp2.value || !document.member_form.hp3.value ){
            alert("휴대폰 번호를 입력하세요");    
            document.member_form.nick.focus();
            return false;
        }
        if (document.member_form.pass.value != document.member_form.pass_confirm.value) {
            alert("비밀번호가 일치하지 않습니다.\n다시 입력해주세요.");    
            document.member_form.pass.focus();
            document.member_form.pass.select();
            return false;
        }
        document.member_form.submit();
        return true;
    }

    function reset_form() {
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
<div id="container">
    <body>
    <script>
        function showConfirmation() {

                alert("회원가입완료!");

        }
    </script>
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
        <form  name="member_form" method="post" action="insert.php"> 
		<div id="title">
			<h1>회 원 가 입</h1>
		</div>
<div class="center-table">
    <table>
        <tr>
            <td>아이디</td>
            <td>
                    <input type="text" name="id" class="input_12">
            </td>
        </tr>
        <tr>
            <td>비밀번호</td>
            <td>
            <input type="password" name="pass" class="input_12">
            </td>
        </tr>
        <tr>
            <td>
            </td>
            <td id="id3">
            ↳ 4~12자의 영문 소문자, 숫자와 특수기호(_) 만 사용할 수 있습니다.
            </td>
        </tr>
        <tr>
            <td id="id3">
            비밀번호 확인
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
                <input type="text" name="name" class="input_12">
            </td>
        </tr>
        <tr>
            <td>
                별명
            </td>
            <td>
                <input type="text" name="nick" class="input_12">
            </td>
        </tr>
        <tr>
            <td>
            휴대전화
            </td>
            <td class="phone-inputt">
                <select class="hp input_2" name="hp1"> 
                    <option value='010'>010</option>
                    <option value='011'>011</option>
                    <option value='016'>016</option>
                    <option value='017'>017</option>
                    <option value='018'>018</option>
                    <option value='019'>019</option>
                </select><b> -</b><input type="text" class="hp inputt123" name="hp2"><b>-</b><input type="text" class="hp inputt123" name="hp3">
        </td>
        </table>
    </table>
			<div class="clear"></div>
            <div id="buttong" class="center-bottom">
            <a href="#">
                <input type="button" class="button_1" onclick="showConfirmation(),check_input().call(this)" value="회원가입">
            </a>&nbsp;&nbsp;
		    <a href="#"><input type="button" class="button_1" onclick="reset_form()" value="리셋"></a>
	    </form>
        </div>
	</div> <!-- end of col2 -->
    </div> <!-- end of content -->
</div> <!-- end of wrap -->

</body>
</html>
