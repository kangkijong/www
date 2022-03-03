<?
    session_start();

    @extract($_POST);
    @extract($_GET);
    @extract($_SESSION);
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>회원정보 수정</title>
    <link href="../common/css/common.css" rel="stylesheet">
    <link href="./css/member_modify.css" rel="stylesheet">

    <script src="../common/js/jquery-1.12.4.min.js"></script>
    <script src="../common/js/jquery-migrate-1.4.1.min.js"></script>

    <script>
        $(document).ready(function() {
                    
            //nick 중복검사		 
            $("#nick").keyup(function() {    // id입력 상자에 id값 입력시
                var nick = $('#nick').val();

                $.ajax({
                    type: "POST",
                    url: "check_nick.php",
                    data: "nick="+ nick,  
                    cache: false, 
                    success: function(data)
                    {
                        $("#loadtext2").html(data);
                    }
                });
            });		 

        });
	
	</script>

    <script>
        function check_id()
        {
            window.open("check_id.php?id=" + document.member_form.id.value,
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
                alert("비밀번호 확인을 입력하세요");    
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

<?
    //$userid='green';  //세션변수
    
    include "../lib/dbconn.php";

    $sql = "select * from member where id='$userid'";
    $result = mysql_query($sql, $connect);

    $row = mysql_fetch_array($result);
    //$row[id]....$row[level]

    $hp = explode("-", $row[hp]);  //000-0000-0000
    $hp1 = $hp[0];
    $hp2 = $hp[1];
    $hp3 = $hp[2];

    $email = explode("@", $row[email]);
    $email1 = $email[0];
    $email2 = $email[1];

    mysql_close();
?>

</head>
<body>
    <div class="wrap">
        <header>
        <h1><a class="logo" href="../index.html"><img src="./images/logo.png" alt=""></a></h1>
        </header>

        <article id="content">
            <form  name="member_form" method="post" action="modify.php"> 
                <div id="title">
                    <h2>회원정보 수정</h2>
                </div>

                <table>
                    <tr>
                        <th scope="col"><label for="id">아이디</label></th>
                        <td>
                            <?= $row[id] ?>     
                        </td>
                    </tr>
                    <tr>
                        <th scope="col"><label for="pass">비밀번호</label></th>
                        <td>
                            <input type="password" name="pass" value="">
                        </td>
                    </tr>
                    <tr>
                        <th scope="col"><label for="pass_confirm">비밀번호 확인</label></th>
                        <td>
                            <input type="password" name="pass_confirm" value="">
                        </td>
                    </tr>
                    <tr>
                        <th scope="col"><label for="name">이름</label></th>
                        <td>
                            <input type="text" name="name" value="<?= $row[name] ?>">
                        </td>
                    </tr>
                    <tr>
                        <th scope="col"><label for="nick">닉네임</label></th>
                        <td>
                            <input type="text" name="nick" id="nick" value="<?= $row[nick] ?>">
                            <span id="loadtext2"></span>
                        </td>
                    </tr>
                    <tr>
                        <th scope="col">휴대폰</th>
                        <td>
                            <input type="text" class="hp" name="hp1" value="<?= $hp1 ?>"> 
                                    - <input type="text" class="hp" name="hp2" value="<?= $hp2 ?>">
                                     - <input type="text" class="hp" name="hp3" value="<?= $hp3 ?>">
                        </td>
                    </tr>
                    <tr>
                        <th scope="col">이메일</th>
                        <td>
                            <input type="text" id="email1" name="email1" value="<?= $email1 ?>"> 
                            @ <input type="text" id="email2" name="email2" value="<?= $email2 ?>">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <button type="button" onclick="check_input()" class="save">저장하기</button>
                            <button type="button" onclick="reset_form()" class="cancel">취소하기</button>
                        </td>
                    </tr>

                </table>


            </form>
        </article>
    </div>
</body>
</html>