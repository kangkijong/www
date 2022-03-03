<?
	session_start();
    @extract($_GET); 
    @extract($_POST); 
    @extract($_SESSION);  
?>

<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>로그인</title>
	<link href="../common/css/common.css" rel="stylesheet">
	<link href="./css/login.css" rel="stylesheet">
	
</head>
<body>
	<div class="wrap">
		<header>
			<h1><a class="logo" href="../index.html"><img src="./images/logo.png" alt=""></a></h1>
		</header>
		
		<article id="content">
			<form  name="member_form" method="post" action="login.php"> 
				<div id="id_pw_input">
					<ul>
						<li>
							<label for="id"></label>
							<input type="text" name="id" id="id" class="login_input" placeholder="아이디를 입력하세요.">
						</li>
						<li>
							<label for="pass"></label>
							<input type="password" name="pass" id="pass" class="login_input" placeholder="비밀번호를 입력하세요.">
						</li>
					</ul>						
				</div>
				
				<div id="login_button">
					<button class="login_button" type="submit">로그인</button>
				</div>

				<div id="login_find">
					<a href="./id_find.php">아이디 찾기</a>
					<a href="./pw_find.php">비밀번호 찾기</a>
				</div>

				<div class="note">
					<p>아직 회원이 아니신가요? <a href="../member/member_check.html" class="join">회원가입</a></p>
				</div>
			</form>
		</article>
	</div>
	
</body>
</html>

