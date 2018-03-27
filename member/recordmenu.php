<div class="nav">
 <form name="form1" method="GET" action="agent_record_ss.php" >
  		<select name="type" >
        	<option value="所有彩种">所有彩种</option>
        	<option value="重庆时时彩">重庆时时彩</option>
            <option value="江西时时彩">江西时时彩</option>
            	<option value="新疆时时彩">新疆时时彩</option>
            <option value="新疆时时彩">新疆时时彩</option>
            	<option value="幸运飞艇">幸运飞艇</option>
            <option value="重庆幸运农场">重庆幸运农场</option>
            	<option value="广东快乐十分">广东快乐十分</option>
            <option value="北京快乐8">北京快乐8</option>
            	<option value="PC蛋蛋">PC蛋蛋</option>
            <option value="加拿大28">加拿大28</option>
            <option value="福彩3D">福彩3D</option>
            <option value="体彩排列三">体彩排列三</option>
           
        </select>
       <select name="state" >
            <option value="2" selected>所有状态</option>
            <option value="1">已结算</option>
            <option value="3">未结算</option>     
        </select> 
       <select name="utype" >
         <option value="3">所有下线</option>
            <option value="2">直属下线</option>
            
        </select>
       
       <span>用户名： <input height="20" value="" name="username" style="border: 1px solid #999;height: 20px;width: 40px;padding-left: 5px;font-size: 12px;font-family: '微软雅黑';color: #999;" /></span>
  
       
    <span>开始日期</span>
                        <input name="cn_begin" type="text" id="cn_begin" class="input_100 laydate-icon" size="10" readonly="readonly" value="<?=$cn_begin?>" onclick="laydate({format: 'YYYY-MM-DD', isclear: false, max: laydate.now()});" style="cursor: pointer" />至 <span style="margin-left: 15px">结束日期</span>
                        <input name="cn_end" type="text" id="cn_end" class="input_100 laydate-icon" size="10" readonly="readonly" value="<?=$cn_end?>" onclick="laydate({format: 'YYYY-MM-DD', isclear: false, max: laydate.now()});" style="cursor: pointer" />
         
    
         <input type="submit" value="查 询"/>
  </form> 
</div>