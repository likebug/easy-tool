<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>密码生成器</title>
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
    input[type="text"] {
        width: 100%;
        padding: 10px 15px;
        font-size: 16px;
        border-radius: 5px;
        border: 2px solid #ccc;
    }
    button {
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
    butto:hover,
    button:focus {
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
    .readonly-button {
        pointer-events: none;
        opacity: 0.5;
    }
    .result button:hover,
    .result button:focus {
        background-color: #03a9f4;
        cursor: pointer;
    }
    </style>
    <script>
		// 生成密码
		function generatePassword() {
			// 获取勾选框的状态
			var useLowercaseLetters = document.getElementById("lowercase").checked;
			var useUppercaseLetters = document.getElementById("uppercase").checked;
			var useNumbers = document.getElementById("numbers").checked;
			var useSpecialCharacters = document.getElementById("special").checked;

			// 根据勾选框的状态生成字符集
			var chars = "";
			if (useLowercaseLetters) {
				chars += "abcdefghijklmnopqrstuvwxyz";
			}
			if (useUppercaseLetters) {
				chars += "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
			}
			if (useNumbers) {
				chars += "0123456789";
			}
			if (useSpecialCharacters) {
				chars += "~!@#$%^&*()_+-=";
			}

			// 生成密码
			var length = parseInt(document.getElementById("length").value);
			var password = "";
			for (var i = 0; i < length; i++) {
				password += chars.charAt(Math.floor(Math.random() * chars.length));
			}

			// 显示密码
			var result = document.getElementById("result");
			result.innerHTML = "<p>生成的密码：<br><span>" + password + "</span></p>";
			
			result.style.display = "block";
			var buttons = document.getElementById("copys");
            buttons.className = "";
		}

		// 复制密码
		function copyPassword() {
			var result = document.getElementById("result");
			var password = result.querySelector("span").innerHTML;
			if (password) {
				var temp = document.createElement("input");
				temp.type = "text";
				temp.value = password;
				document.body.appendChild(temp);
				temp.select();
				document.execCommand("copy");
				document.body.removeChild(temp);
				result.innerHTML += "<p>密码已复制到剪贴板。</p>";
				document.getElementById("copys")
				var buttons = document.getElementById("copys");
                buttons.className = "readonly-button";
			}
		}
	</script>
</head>
<body>
    <div class="container">
        <h1>密码生成器</h1>
        
            <label for="text">输入密码长度：</label>
            <input type="text" id="length" name="length" value="16">
            <p>
                <label for="key">密码生成规则：</label>
                <label><input type="checkbox" id="lowercase" checked>小写字母</label> <label><input type="checkbox" id="uppercase" checked>大写字母</label> <label><input type="checkbox" id="numbers" checked>数字</label> <label><input type="checkbox" id="special" checked>特殊字符</label>
            </p>
            <button style="margin-top:10px;margin-bottom:10px;" onclick="generatePassword()">生成密码</button>
            <button id="copys" class="" onclick="copyPassword()">复制密码</button>
            <div class="result" id="result" style="display: none;"></div>
        <p style="text-align: center;">
          <a href="index.php" style="text-decoration: none; color: #007bff;
            font-size: 20px; position: relative;">
            跳转至密码加解密 
            <span style="position: absolute; bottom: -10px; left: 0; width: 100%; border-bottom: 2px solid #007bff;"></span>
          </a>
        </p>

    </div>
</body>
</html>
