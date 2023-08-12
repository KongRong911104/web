<!-- 紀錄登入次數 -->
<?php 
if (!isset($_SESSION)) {
    session_start();
    }
$time = (int)$_SESSION['logtime'];
$imgtime=(int)$_SESSION['captchatime'];
?>

<!DOCTYPE html>
<html lang="zw-TW">

<head>

    <title>
        登入囉!
    </title>
    <!-- <script>
        function keyLogin() {
            if (event.keyCode == 13) //enter的鍵值為13
                document.getElementById("button").click(); //觸動按鈕的點擊
        }
    </script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.0.0/crypto-js.min.js"></script>

    <link href="index.css?v=<?= time() ?>" rel="stylesheet">
</head>

<body>


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
        function logtime(){
            var passwordInput = document.getElementById('stu_passwd');
            // alert(passwordInput.value);
            var password = passwordInput.value;
            passwordInput.value=CryptoJS.SHA256(password.toString()).toString();
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