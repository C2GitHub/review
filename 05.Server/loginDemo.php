<?php 
    // 处理post提交数据
    function handle_post () {
        global $message;
        if (empty($_POST['username'])) {
            $message = "用户名不能为空";
            trturn;
        }
        if (empty($_POST['password'])) {
            $message = "密码不能为空";
            trturn;
        }
        $username = $_POST['username'];
        file_put_contents('users.txt', $_POST['username'] . '|'. $_POST['password'] . "\r\n", FILE_APPEND);

        var_dump($_FILES);
    }

    // 处理文件提交
    function handle_upload() {
        if (!isset($_FILES)) {
            return;
        }

        if ($_FILES['text']['err'] !== 0) {
            $message = "文件上传失败！";
            return;
        }

        if (isset($_FILES['text']) && $_FILES['text']['err'] !== 0) {
            $tem = $_FILES['text']['tmp_name'];
            $target = './uploads/' . $_FILES['text']['name'];
            // 移动保存上传文件
            $is_moved = move_uploaded_file($tem, $target);
            if (!$is_moved) {
                $message = "文件上传失败";
            }
        }
    }


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        handle_post();
        handle_upload();

        // 设置重定向
        header('Location: http://www.baidu.com');
    }

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
    <dl>
        <dt><label for="username">用户名：</label></dt>
        <dd><input type="text" name="username" id="username" <?php if (isset($username)) {
            echo 'value='. $username;
        } ?>></dd>
    </dl>
    <dl>
        <dt><label for="password">密码：</label></dt>
        <dd><input type="password" name="password" id="password"></dd>
    </dl>
    <dl>
        <dt><label for="confirm">确认密码：</label></dt>
        <dd><input type="password" id="confirm"></dd>
    </dl>
    <dl>
        <dt></dt>
        <dd><input type="checkbox" id="agree">同意协议</dd>
    </dl>
    <dl>
        <dt>上传头像</dt>
        <dd><input type="file" name="text" accept="text/plain"></dd>
    </dl>
    <dl>
        <?php if ($message): ?>
            <dl>
                <dt></dt>
                <dd><?php echo $message; ?></dd>
            </dl>
        <?php endif ?>
    <dt></dt>
    <dd><button id="btn" disabled="disabled">登录</button></dd>
    </dl>
    </form>

    <script type="text/javascript">
        var agree = document.getElementById('agree');
        var btn = document.getElementById('btn');
        var password = document.getElementById("password");
        var confirm = document.getElementById('confirm');
        agree.onclick = function () {
            if (this.checked) {
                btn.disabled = false;
            } else {
                btn.disabled = true;
            }
        }

        confirm.onblur = function () {
            if (this.value !== password.value) {
                alert("两次输入的密码不一致！");
            }
        }
    </script>
</body>
</html>