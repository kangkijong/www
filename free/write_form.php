<? 
	session_start(); 
    @extract($_POST);
    @extract($_GET);
    @extract($_SESSION);

	include "../lib/dbconn.php";

	if ($mode=="modify")
	{
		$sql = "select * from $table where num=$num";
		$result = mysql_query($sql, $connect);
		$row = mysql_fetch_array($result);       
	
		$item_subject     = $row[subject];
		$item_content     = $row[content];
		$item_file_0 = $row[file_name_0];
		$item_file_1 = $row[file_name_1];
		$item_file_2 = $row[file_name_2];

		$copied_file_0 = $row[file_copied_0];
		$copied_file_1 = $row[file_copied_1];
		$copied_file_2 = $row[file_copied_2];
	}
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
		function check_input()
		{
			if (!document.board_form.subject.value)
			{
				alert("제목을 입력하세요1");    
				document.board_form.subject.focus();
				return;
			}

			if (!document.board_form.content.value)
			{
				alert("내용을 입력하세요!");    
				document.board_form.content.focus();
				return;
			}
			document.board_form.submit();
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

			<?
				if($mode=="modify")
				{
			?>
				<form  name="board_form" method="post" action="insert.php?mode=modify&num=<?=$num?>&page=<?=$page?>&table=<?=$table?>" enctype="multipart/form-data"> 
			<?
				}
				else
				{
			?>
				<form  name="board_form" method="post" action="insert.php?table=<?=$table?>" enctype="multipart/form-data"> 
			<?
				}
			?>
				<div id="write_form">
					<div id="write_row1">
						<div class="col1"> 별명 </div>
						<div class="col2"><?=$usernick?></div>
			<?
				if( $userid && ($mode != "modify"))
				{
			?>
				<div class="col3"><input type="checkbox" name="html_ok" value="y"> HTML 쓰기</div>
			<?
				}
			?>			
				</div>
				<div id="write_row2">
					<div class="col1"> 제목   </div>
					<div class="col2"><input type="text" name="subject" value="<?=$item_subject?>" ></div>
				</div>

				<div id="write_row3">
					<div class="col1"> 내용   </div>		
					<div class="col2"><textarea rows="15" cols="79" name="content"><?=$item_content?></textarea></div>
				</div>

				<div id="write_row4">
					<div class="col1"> 이미지파일1   </div>
					<div class="col2"><input type="file" name="upfile[]"></div>
				</div>

			<? 	
				if ($mode=="modify" && $item_file_0)
				{
			?>
				<div class="delete_ok"><?=$item_file_0?> 파일이 등록되어 있습니다. <input type="checkbox" name="del_file[]" value="0"> 삭제</div>
			<?
				}
			?>
				<div id="write_row5">
					<div class="col1"> 이미지파일2  </div>
			    	<div class="col2"><input type="file" name="upfile[]"></div>
				</div>
			<? 	
				if ($mode=="modify" && $item_file_1)
				{
			?>
			<div class="delete_ok">
				<?=$item_file_1?> 파일이 등록되어 있습니다. <input type="checkbox" name="del_file[]" value="1"> 삭제</div>
			<?
				}
			?>
				<div id="write_row6">
					<div class="col1"> 이미지파일3   </div>
					<div class="col2"><input type="file" name="upfile[]"></div>
				</div>
			<? 	
				if ($mode=="modify" && $item_file_2)
				{
			?>
				<div class="delete_ok"><?=$item_file_2?> 파일이 등록되어 있습니다. <input type="checkbox" name="del_file[]" value="2"> 삭제</div>
			<?
				}
			?>
				</div>

				<div id="write_button">
					<input type="submit" value="확인">&nbsp;
					<a href="list.php?table=<?=$table?>&page=<?=$page?>">목록</a>
				</div>

			</form>
			
		</div>

	</article>

	<? include "../common/sub_footer.html" ?>
	<script src="../common/js/select.js"></script>
</body>
</html>