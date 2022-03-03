<? 
	session_start(); 
    @extract($_POST);
    @extract($_GET);
    @extract($_SESSION);

    //세션변수
    //view.php?num=7&page=1

	include "../lib/dbconn.php";

	$sql = "select * from greet where num=$num";
	$result = mysql_query($sql, $connect);

    $row = mysql_fetch_array($result);       
      // 하나의 레코드 가져오기
	
	$item_num     = $row[num];
	$item_id      = $row[id];
	$item_name    = $row[name];
  	$item_nick    = $row[nick];
	$item_hit     = $row[hit];

    $item_date    = $row[regist_day];

	$item_subject = str_replace(" ", "&nbsp;", $row[subject]);

	$item_content = $row[content];
	$is_html      = $row[is_html];

	if ($is_html!="y")
	{
		$item_content = str_replace(" ", "&nbsp;", $item_content);
		$item_content = str_replace("\n", "<br>", $item_content);
	}	

	$new_hit = $item_hit + 1;

	$sql = "update greet set hit=$new_hit where num=$num";   // 글 조회수 증가시킴
	mysql_query($sql, $connect);
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
	<script>
		function del(href) 
		{
			if(confirm("한번 삭제한 자료는 복구할 방법이 없습니다.\n\n정말 삭제하시겠습니까?")) {
					document.location.href = href;
			}
		}
	</script>
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

			<div id="view_title">
				<div id="view_title1"><?= $item_subject ?></div><div id="view_title2"><?= $item_nick ?> &nbsp; 조회 : <?= $item_hit ?>  
				&nbsp; <?= $item_date ?> </div>	
			</div>

			<div id="view_content">
				<?= $item_content ?>
			</div>

			<div id="view_button">
				<a href="list.php?page=<?=$page?>">목록</a>&nbsp;

				<? 
					if($userid==$item_id || $userlevel==1 || $userid=="admin")
					{
				?>
					<a href="modify_form.php?num=<?=$num?>&page=<?=$page?>">수정</a>&nbsp;
					<a href="javascript:del('delete.php?num=<?=$num?>')">삭제</a>&nbsp;

				<?
					}
				?>

				<? 
					if($userid )  //로그인이 되면 글쓰기
					{
				?>

					<a href="write_form.php">글쓰기</a>

				<?
					}
				?>

			</div>

		</div>

	</article>

	<? include "../common/sub_footer.html" ?>
	<script src="../common/js/select.js"></script>
</body>
</html>