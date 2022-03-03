<? 
	session_start(); 
    @extract($_POST);
    @extract($_GET);
    @extract($_SESSION);
    //세션변수 4
    //num=7&page=1

	include "../lib/dbconn.php";

	$sql = "select * from greet where num=$num";
	$result = mysql_query($sql, $connect);

	$row = mysql_fetch_array($result);       	
	$item_subject     = $row[subject];
	$item_content     = $row[content];
?>

<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>열린마당 - 공지사항</title>
	<!-- fontawesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
	<link rel="stylesheet" href="../common/css/common.css">
	<link rel="stylesheet" href="./css/greet.css">
    <!-- vendor prefix -->
    <script src="../common/js/prefixfree.min.js"></script>
</head>
<body>
	<? include "../common/sub_header.html" ?>

	<!-- visual -->
	<div class="visual">
        <img src="./images/visual.jpg" alt="비주얼">
        <h3>열린마당</h3>
    </div>

	<!-- sub_menu -->
	<div class="sub_menu">
		<ul>
			<li class="current"><a href="../greet/list.php">공지사항</a></li>
			<li><a href="../concert/list.php">홍보·언론자료</a></li>
			<li><a href="../sub6/sub6_3.html">자주묻는질문</a></li>
			<li><a href="../sub6/sub6_4.html">질문답변</a></li>
		</ul>
	</div>

	<!-- article -->
	<article id="content">
		<div class="title_area">
			<div class="line_map"><i class="fas fa-home"></i> &gt; 열린마당 &gt; <strong>공지사항</strong></div>
			<h2>공지사항</h2>
		</div>

		<div class="content_area">


			<form  name="board_form" method="post" action="insert.php?mode=modify&num=<?=$num?>&page=<?=$page?>"> 
				<div id="write_form">

					<div id="write_row1">
						<div class="col1"> 닉네임 </div>
						<div class="col2"><?=$usernick?></div>
					</div>

					<div id="write_row2">
						<div class="col1"> 제목   </div>
						<div class="col2"><input type="text" name="subject" value="<?=$item_subject?>" ></div>
					</div>

					<div id="write_row3">
						<div class="col1"> 내용   </div>
						<div class="col2"><textarea rows="15" cols="79" name="content"><?=$item_content?></textarea></div>
					</div>

				</div>

				<div id="write_button">
					<input type="submit" value="확인">&nbsp;
					<a href="list.php?page=<?=$page?>">목록</a>
				</div>
			</form>

		</div>
	</article>
	<? include "../common/sub_footer.html" ?>
	<script src="../common/js/select.js"></script>
</body>
</html>