<html>
    <head>
<style>
@font-face {
    font-family: 'NEXON Lv2 Gothic';
    src: url('https://cdn.jsdelivr.net/gh/projectnoonnu/noonfonts_20-04@2.1/NEXON Lv2 Gothic.woff') format('woff');
    font-weight: normal;
    font-style: normal;
}

#menu {
    background-color: #000;
    display: flex;
    justify-content: space-around;
    align-items: center;
    padding: 0;
    margin: 0;
    max-width: 100%;
    height: auto;
}

#menu li {
    list-style-type: none;
    margin: 0;
    padding: 10px;
}

#menu li a {
    text-decoration: none;
    color: white;
    font-size: 20px;
    padding: 20px
}

#menu li a:hover {
    color: #0AAFD0;
}

/* 반응형 스타일 */
@media screen and (max-width: 768px) {
    #menu {
        flex-wrap: wrap;
        justify-content: center;
    }

    #menu li {
        flex: 0 0 50%;
        text-align: center;
    }
}
a {
	text-decoration:none;
	font-family:'NEXON Lv2 Gothic';
    color: white;
}
</style>
<ul>
<li><a href="./memo/memo.php">낙서장</a></li>
<li><a href="./greet/list.php">가입인사</a></li>
<li><a href="./download/list.php">자료실</a></li>
<li><a href="./free/list.php">자유게시판</a></li>
<li><a href="./anonym/list.php">익명게시판</a></li>
<li><a href="./quote/quote.php">오늘의명언</a></li>
<li><a href="./encoder/list.php">인코더</a></li>
</ul>
    </head>
</html>
