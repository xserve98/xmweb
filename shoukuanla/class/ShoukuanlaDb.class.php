<?php
/*
功能：MySql数据库操作
作者：宇卓(QQ659915080)
官网：www.shoukuanla.net
备用域名：www.chonty.com
*/
class ShoukuanlaDb{
    private $link; //数据库连接
    //public $table; //表名
    private $prefix; //表前缀
	  private $dbName;//数据库名
    //private $db_config; //数据库配置
    /**连接数据库
     * 参数:表名 数据库配置数组 或 数据库配置文件路径
     * @param $table
     * @param string $db_config_arr_path
     */
    function __construct(){
        //引入数据库配置文件
		//define('IN_JB',true);
		$config=skl_C();

		$this->dbName=$config['cfg_DB_NAME'];
		$this->prefix=$config['cfg_DB_PREFIX'];

		$this->link = mysql_connect($config['cfg_DB_HOST'].':'.$config['cfg_DB_PORT'],$config['cfg_DB_USER'],$config['cfg_DB_PWD']) or die('数据库服务器连接错误:' . mysql_error());
		mysql_select_db($this->dbName) or die('数据库连接错误:' . mysql_error());
		mysql_query('set names '.$config['cfg_DB_CHARSET']);
		

    }
 
    //设置表名
    /*public function setTableName($tableName=null){
       $this->table=$this->prefix.$tableName;
    }*/

    /**
     * 数据查询
     * 参数:sql条件 查询字段 使用的sql函数名
     * @param string $where
     * @param string $field
     * @param string $fun
     * @return array
     * 返回值:结果集 或 结果(出错返回空字符串)
     */
    public function select($tableName=null,$field = "*", $where = '1',  $fun = '',$isAddPrefix=true){
				if($isAddPrefix){  
					$tableName=$this->prefix.$tableName;
				}
        $rarr = array();
        if (empty($fun)) {
            $sqlStr = "SELECT $field FROM $tableName WHERE $where";
            $rt = mysql_query($sqlStr, $this->link);
            while ($rt && $arr = mysql_fetch_assoc($rt)) {
                array_push($rarr, $arr);
            }
        } else {
            $sqlStr = "SELECT $fun($field) as rt FROM $tableName WHERE $where";
            $rt = mysql_query($sqlStr, $this->link);
            if ($rt) {
                $arr = mysql_fetch_assoc($rt);
                $rarr = $arr['rt'];
            } else {
                $rarr =false;
            }
        }
        return $rarr;
    }


		/**
     * 查询一条数据
     * 参数:sql条件 查询字段 使用的sql函数名
     * @param string $where
     * @param string $field
     * @param string $fun
     * @return array
     * 返回值:结果集 或 结果(出错返回空字符串)
     */
    public function find($tableName=null,$field ='*', $where = '1',  $fun = '',$isAddPrefix=true){
				if($isAddPrefix){  
					$tableName=$this->prefix.$tableName;
				}

        $rarr = array();
        $where.=' LIMIT 1';
        if (empty($fun)) {
            $sqlStr = "SELECT $field FROM $tableName WHERE $where";
            $rt = mysql_query($sqlStr, $this->link);
            $rarr= mysql_fetch_assoc($rt);
        } else {
            $sqlStr = "SELECT $fun($field) as rt FROM $tableName WHERE $where";
            $rt = mysql_query($sqlStr, $this->link);
            if ($rt) {
                $arr = mysql_fetch_assoc($rt);
                $rarr = $arr['rt'];
            } else {
                $rarr = false;
            }
        }
        return $rarr;
    }

    /**
     * 数据更新
     * 参数:sql条件 要更新的数据(字符串 或 关联数组)
     * @param $where
     * @param $data
     * @return bool
     * 返回值:语句执行成功或失败,执行成功并不意味着对数据库做出了影响
     */
    public function update($tableName=null, $data=null,$where=null)
    {
			  $tableName=$this->prefix.$tableName;
        $ddata = '';
        if (is_array($data)) {

						foreach($data as $k=>$v){
                if (empty($ddata)) {
                    $ddata = "`$k`='$v'";

                } else {
                    $ddata .= ",`$k`='$v'";
                }						
						
						}

        } else {
            $ddata = $data;
        }
        $sqlStr = "UPDATE $tableName SET $ddata WHERE $where";
				mysql_query($sqlStr);
        return mysql_affected_rows();
    }

    /**
     * 数据添加
     * 参数:数据(数组 或 关联数组 或 字符串)
     * @param $data
     * @return int
     * 返回值:插入的数据的ID 或者 0
     */
    public function insert($tableName=null,$data=null)
    {
			  $tableName=$this->prefix.$tableName;
        $field = '';
        $idata = '';
        if (is_array($data) && array_keys($data) != range(0, count($data) - 1)) {
            //关联数组
            foreach($data as $k=>$v){
                if (empty($field)) {
                    $field = "`$k`";
                    $idata = "'$v'";
                } else {
                    $field .= ",`$k`";
                    $idata .= ",'$v'";
                }
            }
            $sqlStr = "INSERT INTO $tableName ($field) VALUES ($idata)";
        } else {
            //非关联数组 或字符串
            if (is_array($data)) {
                while (list($k, $v) = each($data)) {
                    if (empty($idata)) {
                        $idata = "'$v'";
                    } else {
                        $idata .= ",'$v'";
                    }
                }

            } else {
                //为字符串
                $idata = $data;
            }
            $sqlStr = "INSERT INTO $tableName $idata";
        }
        if(mysql_query($sqlStr,$this->link))
        {
            return mysql_insert_id($this->link);
        }
        return '';
    }

    /**
     * 数据删除
     * 参数:sql条件
     * @param $where
     * @return bool
     */
    public function delete($tableName=null,$where=null){   
		  $tableName=$this->prefix.$tableName;	
		  mysql_query("DELETE FROM $tableName WHERE $where");
		
      return mysql_affected_rows();
    }


    /**
     * 执行sql语句
     */
    public function query($sql=null){
		  return mysql_query(str_replace('@#',$this->prefix,$sql));
		
    }

		//析构函数
		function __destruct(){
 
			//关闭MySQL连接
			mysql_close($this->link);

		}
}


/* 数据库配置
  return array(
    'DB_CONFIG' => array(
        //数据库配置
        'DB_HOST'=>'127.0.0.1',    //服务器地址
        'DB_NAME' => 'tmp', // 数据库名
        'DB_USER' => 'root', // 用户名
        'DB_PWD' => '', // 密码
        'DB_ENCODE'=>'utf8',//编码
        'DB_PREFIX' => 'dmtx_' // 数据库表前缀
    )
);
 */
?>