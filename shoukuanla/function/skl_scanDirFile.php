<?php
//获取文件目录列表,该方法返回数组,路径格式 d:/images/aliqrcode
function skl_scanDirFile($dir=null,$dirFile='dir'){
    $dirArray=array();
    if (false != ($handle = opendir ( $dir ))) {
        $i=0;
        while ( false !== ($file = readdir ( $handle )) ) {
            //扫描目录去掉"“.”、“..”以及带“.xxx”后缀的文件
						if($dirFile == 'dir'){
							if ($file != '.' && $file != '..' && is_dir($dir.'/'.$file)) {
									$dirArray[$i]=$file;
									$i++;
							}

						}elseif($dirFile == 'file'){
              //扫描文件名
							
							if ($file != '.' && $file != '..' && is_file($dir.'/'.$file)) {
									$dirArray[$i]=$file; 
									$i++;
							}						
 
						}

        }
        //关闭句柄
        closedir ( $handle );
    }
    return $dirArray;
}

?>