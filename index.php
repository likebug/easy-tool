<?php
// 加密密码，将加密后的密码存储到文件中
function encryptPassword($password, $key, $file) {
    $encrypted = openssl_encrypt($password, "AES-128-ECB", $key, OPENSSL_RAW_DATA);
    $encrypted = base64_encode($encrypted);
    #file_put_contents($file, $encrypted);
    return $encrypted;
}

// 解密密码，从文件中读取加密后的密码，并将其解密
function decryptPassword($key, $password) {
    $encrypted = base64_decode($password);
    $decrypted = openssl_decrypt($encrypted, "AES-128-ECB", $key, OPENSSL_RAW_DATA);
    return $decrypted;
}

// 处理表单提交，根据提交的操作执行相应的操作
if (isset($_POST["submit"])) {
    $password = $_POST["password"];
    $key = $_POST["key"];
    $file = "password.txt"; // 文件名，请根据实际情况修改

    if ($_POST["submit"] == "加密") {
        $encrypted = encryptPassword($password, $key, $file);
        $result = "加密后的密码：<br><span id=\"encrypted\">" . nl2br(htmlspecialchars($encrypted)) . "</span><button type=\"button\" onclick=\"copyToClipboard('encrypted')\">复制密码</button><br>";
    } elseif ($_POST["submit"] == "解密") {
        $decrypted = decryptPassword($key, $password);
        if ($decrypted !== false) {
            $result = "解密后的密码：<br><span id=\"decrypted\">" . nl2br(htmlspecialchars($decrypted)) . "</span><button type=\"button\" onclick=\"copyToClipboard('decrypted')\">复制密码</button><br>";
        } else {
            $result = "无法解密该密码。";
        }
    }
}
?>



<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>密码加密和解密</title>
    <style type="text/css">
    * {
        box-sizing: border-box;
    }
    body {
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        font-size: 16px;
        line-height: 1.5;
        color: #333;
        margin: 0;
        padding: 0;
    }
    .container {
        margin: 50px auto;
        max-width: 600px;
        padding: 20px;
        background-color: #fff;
        box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
        border-radius: 5px;
    }
    h1 {
        font-size: 28px;
        font-weight: bold;
        text-align: center;
        margin-top: 0;
        margin-bottom: 30px;
    }
    form {
        margin-bottom: 30px;
    }
    label {
        display: block;
        margin-bottom: 10px;
        font-size: 18px;
        font-weight: bold;
    }
    input[type="password"] {
        width: 100%;
        padding: 10px 15px;
        font-size: 16px;
        border-radius: 5px;
        border: 2px solid #ccc;
    }
    button[type="submit"] {
        display: block;
        width: 100%;
        padding: 10px;
        background-color: #007bff;
        color: #fff;
        font-size: 20px;
        font-weight: bold;
        border: 2px solid #007bff;
        border-radius: 5px;
        transition: all 0.2s ease-in-out;
    }
    button[type="submit"]:hover,
    button[type="submit"]:focus {
        background-color: #fff;
        color: #007bff;
        outline: none;
    }
    .result {
        border: 2px solid #ccc;
        border-radius: 5px;
        padding: 20px;
        margin-bottom: 30px;
        position: relative;
    }
    .result span {
        display: inline-block;
        margin-bottom: 10px;
    }
    .result button {
        position: absolute;
        top: 10px;
        right: 10px;
        font-size: 14px;
        padding: 5px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 5px;
    }
    .result button:hover,
    .result button:focus {
        background-color: #03a9f4;
        cursor: pointer;
    }
    </style>
    <script type="text/javascript">
    function copyToClipboard(id) {
        var inputElement = document.getElementById(id);
        var text = inputElement.innerText || inputElement.value;
        var input = document.createElement('textarea');
        input.value = text;
        document.body.appendChild(input);
        input.select();
        document.execCommand('copy');
        document.body.removeChild(input);
        alert('密码复制成功！');
    }
    </script>
</head>
<body>
    <div class="container">
        <h1>密码加解密</h1>
        <form method="post">
            <label for="password">输入密码：</label>
            <input type="password" id="password" name="password" placeholder="请输入要加密/解密的密码">
            <label for="key">输入密钥：</label>
            <input type="password" id="key" name="key" placeholder="请输入密钥，确保加密和解密一致">
            <button type="submit" style="margin-top:10px;margin-bottom:10px;" name="submit" value="加密">加密</button>
            <button type="submit" name="submit" value="解密">解密</button>
        </form>
        <?php if (isset($result)) { ?>
        <div class="result">
            <?php echo $result; ?>
        </div>
        <?php } ?>
        <p >主要用于密码加密，解决明文存储密码存在安全风险的问题。其中密钥是自定义的，一定要记牢，密码加解密必须使用它才能正确解密。</p>
        <p style="text-align: center;">
            <a href="password.php" style="text-decoration: none; color: #007bff;
            font-size: 20px; position: relative;">
            跳转至密码生成器 
            <span style="position: absolute; bottom: -10px; left: 0; width: 100%; border-bottom: 2px solid #007bff;"></span>
          </a>
        </p>
    </div>
</body>
</html>
