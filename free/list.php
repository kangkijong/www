<? 
	session_start(); 
    @extract($_POST);
    @extract($_GET);
    @extract($_SESSION);

	$table = "free";
	$ripple = "free_ripple";
?>

<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>열린마당 - 질문답변</title>
	<!-- fontawesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
	<link rel="stylesheet" href="../common/css/common.css">
	<link rel="stylesheet" href="./css/free.css">
    <!-- vendor prefix -->
    <script src="../common/js/prefixfree.min.js"></script>
</head>
<?
	include "../lib/dbconn.php";
	$scale=10;			// 한 화면에 표시되는 글 수

    if ($mode=="search")
	{
		if(!$search)
		{
			echo("
				<script>
				 window.alert('검색할 단어를 입력해 주세요!');
			     history.go(-1);
				</script>
			");
			exit;
		}
		$sql = "select * from $table where $find like '%$search%' order by num desc";
	}
	else
	{
		$sql = "select * from $table order by num desc";
	}

	$result = mysql_query($sql, $connect);
	$total_record = mysql_num_rows($result); // 전체 글 수

	// 전체 페이지 수($total_page) 계산 
	if ($total_record % $scale == 0)     
		$total_page = floor($total_record/$scale);      
	else
		$total_page = floor($total_record/$scale) + 1; 
 
	if (!$page)                 // 페이지번호($page)가 0 일 때
		$page = 1;              // 페이지 번호를 1로 초기화
 
	// 표시할 페이지($page)에 따라 $start 계산  
	$start = ($page - 1) * $scale;      
	$number = $total_record - $start;
?>

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
			<li><a href="../greet/list.php">공지사항</a></li>
			<li><a href="../concert/list.php">홍보·언론자료</a></li>
			<li><a href="../sub6/sub6_3.html">자주묻는질문</a></li>
			<li class="current"><a href="../free/list.php">질문답변</a></li>
		</ul>
	</div>

	<!-- article -->
	<article id="content">
		<div class="title_area">
			<div class="line_map"><i class="fas fa-home"></i> &gt; 열린마당 &gt; <strong>질문답변</strong></div>
			<h2>질문답변</h2>
		</div>

		<div class="content_area">

			<form  name="board_form" method="post" action="list.php?table=<?=$table?>&mode=search">
				<div id="list_search">
					<div id="list_search3">
						<select name="find">
							<option value='subject'>제목</option>
							<option value='content'>내용</option>
							<option value='nick'>별명</option>
							<option value='name'>이름</option>
						</select>
					</div>
					<div id="list_search4"><input type="text" name="search"></div>
					<div id="list_search5">
						<input type="submit" id="search_btn" value="검색">
					</div>
				</div>

				<div id="list_search1">TOTAL <?= $total_record ?></div>
			
				<div id="list_search2">
					<select name="scale" onchange="location.href='list.php?scale='+this.value">
						<option value=''>보기</option>
						<option value='5'>5</option>
						<option value='10'>10</option>
						<option value='15'>15</option>
						<option value='20'>20</option>
					</select>
				</div>
			</form>

			<div id="list_top_title">
				<ul>
					<li id="list_title1">번호</li>
					<li id="list_title2">제목</li>
					<li id="list_title3">글쓴이</li>
					<li id="list_title4">등록일</li>
					<li id="list_title5">조회</li>
				</ul>		
			</div>

			<div id="list_content">
				<?		
				for ($i=$start; $i<$start+$scale && $i < $total_record; $i++)                    
				{
					mysql_data_seek($result, $i);       
					// 가져올 레코드로 위치(포인터) 이동  
					$row = mysql_fetch_array($result);       
					// 하나의 레코드 가져오기
					
					$item_num     = $row[num];
					$item_id      = $row[id];
					$item_name    = $row[name];
					$item_nick    = $row[nick];
					$item_hit     = $row[hit];
					$item_date    = $row[regist_day];
					$item_date = substr($item_date, 0, 10);  
					$item_subject = str_replace(" ", "&nbsp;", $row[subject]);
						
					$sql = "select * from $ripple where parent=$item_num";	//추가
					$result2 = mysql_query($sql, $connect);	//추가
					$num_ripple = mysql_num_rows($result2);	//추가	해당 메인 게시글의 댓글의 개수
				?>

			<div id="list_item">
				<div id="list_item1"><?= $number ?></div>
				<div id="list_item2"><a href="view.php?table=<?=$table?>&num=<?=$item_num?>&page=<?=$page?>"><?= $item_subject ?></a>
					<?
					if ($num_ripple)	//추가
							echo " [$num_ripple]";	//추가
					?>
				</div>
				<div id="list_item3"><?= $item_nick ?></div>
				<div id="list_item4"><?= $item_date ?></div>
				<div id="list_item5"><?= $item_hit ?></div>
			</div>

			<?
				$number--;
			}
			?>

			<div id="page_button">
				<div id="page_num"> ◀ 이전 &nbsp;&nbsp;&nbsp;&nbsp; 

					<?
					// 게시판 목록 하단에 페이지 링크 번호 출력
					for ($i=1; $i<=$total_page; $i++)
					{
						if ($page == $i)     // 현재 페이지 번호 링크 안함
						{
							echo "<b> $i </b>";
						}
						else
						{ 
							
						if($mode=="search"){
							echo "<a href='list.php?page=$i&scale=$scale&mode=search&find=$find&search=$search'> $i </a>"; 
						}else{    
							
							echo "<a href='list.php?page=$i&scale=$scale'> $i </a>";
						}
							
						
						}      
					}
					?>			

					&nbsp;&nbsp;&nbsp;&nbsp;다음 ▶
				</div>
				<div id="button">
					<a href="list.php?table=<?=$table?>&page=<?=$page?>">목록</a>&nbsp;

					<? 
						if($userid)
						{
					?>

					<a href="write_form.php?table=<?=$table?>">글쓰기</a>

					<?
						}
					?>

				</div> <!-- end of page_button -->
					
			</div> <!-- end of list content -->

		</div>

	</article>

	<? include "../common/sub_footer.html" ?>
	<script src="../common/js/select.js"></script>
</body>
</html>