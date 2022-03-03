<? 
	session_start(); 
    @extract($_POST);
    @extract($_GET);
    @extract($_SESSION);

	include "../lib/dbconn.php";

	$sql = "select * from $table where num=$num";
	$result = mysql_query($sql, $connect);

    $row = mysql_fetch_array($result);       
      // 하나의 레코드 가져오기
	
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
		if ($image_copied[$i]) //업로드한 파일이 존재하면 0 1 2
		{
			$imageinfo = GetImageSize("./data/".$image_copied[$i]);
            //GetImageSize(서버에 업로드된 파일 경로 파일명)
              // => 파일의 너비와 높이값, 종류
			$image_width[$i] = $imageinfo[0];  //파일너비
			$image_height[$i] = $imageinfo[1]; //파일높이
			$image_type[$i]  = $imageinfo[2];  //파일종류

        if ($image_width[$i] > 785)	//785px는 레이아웃의 너비
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
	<title>열린마당 - 홍보·언론자료</title>
	<!-- fontawesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
	<link rel="stylesheet" href="../common/css/common.css">
	<link rel="stylesheet" href="./css/concert.css">
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
			<li><a href="../greet/list.php">공지사항</a></li>
			<li class="current"><a href="../concert/list.php">홍보·언론자료</a></li>
			<li><a href="../sub6/sub6_3.html">자주묻는질문</a></li>
			<li><a href="../sub6/sub6_4.html">질문답변</a></li>
		</ul>
	</div>

	<!-- article -->
	<article id="content">
		<div class="title_area">
			<div class="line_map"><i class="fas fa-home"></i> &gt; 열린마당 &gt; <strong>홍보·언론자료</strong></div>
			<h2>홍보·언론자료</h2>
		</div>

		<div class="content_area">

			<div id="view_title">
				<div id="view_title1"><?= $item_subject ?></div><div id="view_title2"><?= $item_nick ?> | 조회 : <?= $item_hit ?>  
									| <?= $item_date ?> </div>	
			</div>

			<div id="view_content">
				<?
					for ($i=0; $i<3; $i++)  //업로드된 이미지를 출력한다
					{
						if ($image_copied[$i])	//첨부된 파일이 있으면
						{
							$img_name = $image_copied[$i];
							$img_name = "./data/".$img_name; 
							// ./data/2019_03_22_10_07_15_0.jpg
							$img_width = $image_width[$i];
							
							echo "<img src='$img_name' width='$img_width'>"."<br><br>";
						}
					}
				?>
				<?= $item_content ?>
			</div>

			<div id="view_button">
				<a href="list.php?table=<?=$table?>&page=<?=$page?>">목록</a>&nbsp;

				<? 
					if($userid==$item_id || $userid=="kijong4309" || $userlevel==1 )
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