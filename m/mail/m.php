<?php
include "mail.php";
if (!empty($_POST['to'])  && !empty($_POST['fromname']) && !empty($_POST['title']) && !empty($_POST['content'])) {
    send_mail($_POST['to'],$_POST['fromname'],$_POST['title'],$_POST['content']);
}


?>
<form action="#" method="post">
接收人：<input type="text" name="to" /><br>
发件人昵称：<input type="text" name="fromname" /><br>
标题：<input type="text" name="title" /><br>
内容：<input type="text" name="content" style="width:400;height:100;" /><br>
<input type="submit" value="提交" />
注:默认是用作者的QQ邮箱发送 请注意改成自己的数据
</form>