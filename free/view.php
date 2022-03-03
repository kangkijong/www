<? 
	session_start(); 
    @extract($_POST);
    @extract($_GET);
    @extract($_SESSION);

	include "../lib/dbconn.php";

	$sql = "select * from $table where num=$num";
	$result = mysql_query($sql, $connect);
    $row = mysql_fetch_array($result);       
	
	$item_num     = $row[num];
	$item_id      = $row[id];
	$item_name    = $row[name];
  	$item_nick    = $row[nick];
	$item_hit     = $row[hit];

	$image_name[0]   = $row[file_name_0];
	$image_name[1]   = $row[file_name_1];
	$image_name[2]   = $row[file_name_2];
	$image_copied[0] = $row[file_copied_0];
	$image_copied[1] = $row[file_copied_1];
	$image_copied[2] = $row[file_copied_2];

    $item_date    = $row[regist_day];
	$item_subject = str_replace(" ", "&nbsp;", $row[subject]);
	$item_content = $row[content];
	$is_html      = $row[is_html];

	if ($is_html!="y")
	{
		$item_content = str_replace(" ", "&nbsp;", $item_content);
		$item_content = str_replace("\n", "<br>", $item_content);
	}	

	for ($i=0; $i<3; $i++)
	{
		if ($image_copied[$i]) 
		{
			$imageinfo = GetImageSize("./data/".$image_copied[$i]);
			$image_width[$i] = $imageinfo[0];
			$image_height[$i] = $imageinfo[1];
			$image_type[$i]  = $imageinfo[2];

			if ($image_width[$i] > 785)
				$image_width[$i] = 785;
		}
		else
		{
			$image_width[$i] = "";
			$image_height[$i] = "";
			$image_type[$i]  = "";
		}
	}
	$new_hit = $item_hit + 1;
	$sql = "update $table set hit=$new_hit where num=$num";   // 글 조회수 증가시킴
	mysql_query($sql, $connect);
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
	<script>
		function check_input()	//추가 함수
		{
			if (!document.ripple_form.ripple_content.value)
			{
				alert("댓글의 내용을 입력하세요!");    
				document.ripple_form.ripple_content.focus();
				return;
			}
			document.ripple_form.submit();
		}
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

			<div id="view_title">
				<div id="view_title1"><?= $item_subject ?></div><div id="view_title2"><?= $item_nick ?> | 조회 : <?= $item_hit ?>  
									| <?= $item_date ?> </div>	
			</div>

		<div id="view_content">
			<?
				for ($i=0; $i<3; $i++)
				{
					if ($image_copied[$i])
					{
						$img_name = $image_copied[$i];
						$img_name = "./data/".$img_name;
						$img_width = $image_width[$i];
						
						echo "<img src='$img_name' width='$img_width'>"."<br><br>";
					}
				}
			?>
			<?= $item_content ?>
		</div>

		<div id="ripple">
			<?
			//댓글 보기 및 댓글 입력 추가
			$sql = "select * from free_ripple where parent='$item_num'";
			$ripple_result = mysql_query($sql);

			while ($row_ripple = mysql_fetch_array($ripple_result))
			{
				$ripple_num     = $row_ripple[num];
				$ripple_id      = $row_ripple[id];
				$ripple_nick    = $row_ripple[nick];
				$ripple_content = str_replace("\n", "<br>", $row_ripple[content]);
				$ripple_content = str_replace(" ", "&nbsp;", $ripple_content);
				$ripple_date    = $row_ripple[regist_day];
			?>
			<div id="ripple_writer_title">
				<ul>
					<li id="writer_title1"><?=$ripple_nick?></li>
					<li id="writer_title2"><?=$ripple_date?></li>
					<li id="writer_title3"> 
					<? 
						if($userid=="admin" || $userid==$ripple_id)
						echo "<a href='delete_ripple.php?table=$table&num=$item_num&ripple_num=$ripple_num'>[삭제]</a>"; 
					?>
					</li>
				</ul>
			</div>
			<div id="ripple_content"><?=$ripple_content?></div>
			<div class="hor_line_ripple"></div>
				<?
						}
				?>			
				<form  name="ripple_form" method="post" action="insert_ripple.php?table=<?=$table?>&num=<?=$item_num?>">  
				<div id="ripple_box">
					<div id="ripple_box1">댓글 쓰기</div>
					<div id="ripple_box2"><textarea rows="5" cols="65" name="ripple_content" placeholder="댓글을 입력하세요."></textarea></div>
					<!-- <div id="ripple_box3"><a href="#"><img src="../img/ok_ripple.gif"  onclick="check_input()"></a></div> -->
					<div id="ripple_box3"><button class="ripple_write">댓글 작성</button></div>
				</div>
				</form>
			</div> <!-- end of ripple -->

			<div id="view_button">
				<a href="list.php?table=<?=$table?>&page=<?=$page?>">목록</a>&nbsp;
				<? 
					if($userid && ($userid==$item_id))
					{
				?>
				<a href="write_form.php?table=<?=$table?>&mode=modify&num=<?=$num?>&page=<?=$page?>">수정</a>&nbsp;
				<a href="javascript:del('delete.php?table=<?=$table?>&num=<?=$num?>')">삭제</a>&nbsp;
				<?
					}
				?>
				<? 
					if($userid)
					{
				?>
				<a href="write_form.php?table=<?=$table?>">글쓰기</a>
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