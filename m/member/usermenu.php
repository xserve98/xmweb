<div class="nav">
	<ul>
		<li <?=$sub==1?"class='current'":""?>><a href="javascript:void(0);" onclick="Go('userinfo.php');return false">基本资料</a></li>
		<li <?=$sub==2?"class='current'":""?>><a href="javascript:void(0);" onclick="Go('password.php');return false">修改密码</a></li>
		<li <?=$sub==3?"class='current'":""?>><a href="javascript:void(0);" onclick="Go('sys_msg.php');return false">站内消息</a></li>
        <li <?=$sub==4?"class='current'":""?>><a href="javascript:void(0);" onclick="Go('sys_msg_add.php');return false">写信息</a></li>
	</ul>
</div>