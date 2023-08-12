<!-- 紀錄登入次數 -->
<?php session_start();
$time = (int)$_SESSION['logtime'];
$imgtime=(int)$_SESSION['captchatime'];
?>

<!DOCTYPE html>
<html lang="zw-TW">

<head>

    <title>
        登入囉!
    </title>
    <script>
        function keyLogin() {
            if (event.keyCode == 13) //enter的鍵值為13
                document.getElementById("button").click(); //觸動按鈕的點擊
        }
    </script>

    <style>
        html,
        body {
            background-color: rgb(255, 255, 255);
        }

        form {
            border: 2px solid;
            border-color: #9fc5e8;
            margin-top: 15%;
            margin-bottom: 0%;
            margin-left: 25%;
            /* margin-right: 30%; */
            width: 33%;
            /* height: 25%; */
            box-shadow: 10px 10px rgba(156, 156, 156, 0.66);


        }

        .page-header {
            margin-left: 12%;
            font-size: 27px;
            font-style: arial;
            color: rgb(31, 30, 30);
        }

        hr {
            margin-left: 30px;
            margin-right: 30px;
            border: 0.1px solid rgba(134, 134, 134, 0.525);
        }
        .log{
            height: 5px;
            position: relative;
            left:77px;
            color:red;
        }

        .inputStyle {
            ime-mode: disabled;
            width: 52%;
            height: 40px;
            margin-left: 12%;
            margin-top: 10px;
            border: 2px solid;
            border-radius: 8px;
            border-color: #9fc5e8;
            font-size: 27px;
            color: rgba(28, 28, 28, 0.685);
            background-color: rgba(195, 195, 195, 0.242);
        }

        .inputStyle::placeholder {
            color: rgba(134, 134, 134, 0.434);
        }

        .inputStyle:focus {
            outline: none;
            border-color: rgba(4, 171, 248, 0.733);
        }

        .checkinputStyle {
            ime-mode: disabled;
            width: 16%;
            height: 25px;
            margin-left: 12%;
            margin-top: 5px;
            border: 2px solid;
            border-radius: 8px;
            border-color: #9fc5e8;
            font-size: 16px;
            color: rgba(28, 28, 28, 0.685);
            background-color: rgba(195, 195, 195, 0.242);
        }

        .checkinputStyle::placeholder {
            color: rgba(134, 134, 134, 0.434);
        }

        .checkinputStyle:focus {
            outline: none;
            border-color: rgba(4, 171, 248, 0.733);
        }

        .buttonStyle {

            position: relative;
            top: -60px;
            left: 70%;

            width: 16%;
            height: 48px;
            font-size: 27px;
            background-color: rgba(27, 53, 250, 0.623);
            border-radius: 8px;
            border-color: #9fc5e8;
            border: 0.1px;
            font-style: arial;
        }

        .buttonStyle:hover {
            color: rgb(255, 255, 255);
            background-color: rgba(155, 158, 252, 0.852);
        }

        .buttonStyle:active {
            background-color: rgba(6, 105, 218, 0.799);
        }

        .passwd {
            width: 30px;
            height: 40px;
            position: relative;
            top: 11px;
            left: -40px;
            border: hidden;
            border-radius: 8px;


        }

        .passwdphoto {
            width: 20px;
            position: relative;
            left: -36px;
            border: hidden;
            border-radius: 8px;

        }

        .checkimg {
            position: relative;
            top: 9px;
            border: hidden;
        }
    </style>
</head>

<body onkeydown="keyLogin();">


    <form method="post" action="logincheck.php">
        <p class="page-header">登入帳號</p>
        <hr />
        <p class ="log"id="loginX"></p>
        <input class="inputStyle" name='id' id=stu_id type="text" placeholder="請輸入帳號" oninput="value=value.replace(/[^\w\.\/]/ig,'')" onpaste="return false" ondragenter="return false" oncontextmenu="return false;"></input><br />
        <input class="inputStyle" name='passwd' id=stu_passwd type="password" placeholder="請輸入密碼" oninput="value=value.replace(/[^\w\.\/]/ig,'')" onpaste="return false" ondragenter="return false" oncontextmenu="return false;"></input>
        <img id="photo" class="passwdphoto" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR7ctsdnXvbnMJVHf84_wdB8aLoyziQo2TlRA&usqp=CAU" width=20px onclick="displaypasswd()"><br />
        <p class ="log"id="loginimgX"></p> 
        <input class="checkinputStyle" id=check name="checkword" type="text" placeholder="請輸入驗證碼" oninput="value=value.replace(/[^\w\.\/]/ig,'')" onpaste="return false" ondragenter="return false" oncontextmenu="return false;"></input>
        <img id="imgcode" src="captcha.php" onclick="resetimg()" class="checkimg" />不分大小寫<br />
        
        <p><input id="button" class="buttonStyle" type="submit" onclick="logtime()" value="登入"></input></p>
        
    </form>

    <script>
        // 登入錯誤資訊
        var time = <?php echo $time ?>;
        var imgtime = <?php echo $imgtime ?>;
        if (time > 0) {
            var logfail = document.getElementById("loginX");
            logfail.innerHTML = "帳號或密碼錯誤";
            <?php 
            $_SESSION['logtime']=0;
            $_SESSION['captchatime']=0;
            ?>

        }
        if (imgtime > 0) {
            var logimgfail = document.getElementById("loginimgX");
            logimgfail.innerHTML = "驗證碼錯誤";
            <?php 
            $_SESSION['logtime']=0;
            $_SESSION['captchatime']=0;
            ?>

        }
        // 驗證碼重整
        function resetimg() {
            var $img = document.getElementById("imgcode");
            $img.src = "captcha.php";
        }
        // 顯示密碼
        function displaypasswd() {
            var stu_passwd = document.getElementById("stu_passwd");
            var passwdphoto = document.getElementById("photo");
            if (stu_passwd.type == "password") {
                stu_passwd.type = "text";
                passwdphoto.src = "https://pic.616pic.com/ys_img/00/07/68/7ITJDBrim7.jpg"
            } else if (stu_passwd.type == "text") {
                stu_passwd.type = "password";
                passwdphoto.src = "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR7ctsdnXvbnMJVHf84_wdB8aLoyziQo2TlRA&usqp=CAU";
            }
        }
    </script>
</body>

</html>