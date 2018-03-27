<?php
set_time_limit(0);
require dirname(__FILE__) . '/Curl.Class.php';
class caipiao{
	public static $obj;
	private static $File = '';
	
	public static function data( $Num = 0 ) {
	  if ( self::cache( $Num ) ) {
		$Curl = new curl;
		$Curl -> seting('http://kj.1680api.com/sharehtml/live?setcode=' . $Num, '104.20.75.45');
		$Json = $Curl -> post('http://kj.1680api.com/Open/CurrentOpenOne?code=' . $Num . '&_=' . rand());
		file_put_contents( self::$File, $Json );
		return json_decode( $Json, true);
	  } else {
		return json_decode(file_get_contents(self::$File), true); 
	  }
	}
	
	public static function exists( $tab = '', $where = '' ) {
		$q = self::$obj -> query(!empty( $where ) ? "select * from `{$tab}` where {$where} " : "select * from `{$tab}` " );
		return $q -> num_rows;
	}
	
	public static function insert( $tab = '', $data = array() ) {
		if ( is_array( $data ) && sizeof( $data ) ) {
			$Sql    = "insert into `{$tab}` (";
			$fileld = $value = array();
			foreach( $data as $key => $val ) {
				$fileld[] = "`{$key}`";
				$value[]  = is_numeric( $val ) ? $val : '\'' . $val . '\'';
			}
			$Sql .= join(', ', $fileld ) . ') values ( ' . join(', ', $value ) . ')';
			self::$obj -> query( $Sql ) or die(self::$obj -> error);
			return self::$obj -> insert_id;
		} else {
			return false;
		}
	}
	
	public static function select( $tab = '', $field = ' * ', $where = '', $limit = 0 ) {
		$Sql = "select {$field} from `{$tab}`";
		empty( $where ) or $Sql .= ' where {$where} ';
		$limit <= 0 or $Sql .= ' limit ' . $limit;
		$s = self::$obj -> query( $Sql );
		if ( $s ) {
			if ( $s -> num_row ) {
				if ( $limit == 1 ) {
					return $s -> fetch_assoc();
				} else {
					$u = array();
					while( $rs = $s -> fetch_assoc() ) {
					  $u[] = $rs;	
					}
					return $u;
				}
			} else {
			  return false;	
			}
		} else {
		  return false;	
		}
	}
	
	public static function update( $tab = '', $data = array(), $where = "" ) {
		if ( is_array( $data ) && sizeof( $data ) && !empty( $where ) ) {
		  $Sql = "Update `{$tab}` Set ";
		  $Set = array();
		  foreach( $data as $key => $val ) {
			  $Set[] = "`{$key}` = " . (is_numeric( $val ) ? $val : "'{$val}'");
		  }
		  $Sql .= join(', ', $Set ) . " where {$where}";
		  self::$obj -> query( $Sql ) or die( self::$obj -> error);
		  return self::$obj -> affected_rows;
		} else {
		  return false;	
		}
	}
	
	private static function cache( $n = 0 ) {
		$Dir = dirname(__FILE__).'/cache';
		is_dir( $Dir ) or mkdir( $Dir );
		self::$File = $Dir . '/' . $n . '.json';
		if ( !file_exists( self::$File ) ) {
		   return true;	
		} elseif ( time() - filemtime(self::$File) >= 30 ) {
		   return true;	
		} else {
		  return false;
		}
	}
	
	
}
caipiao::$obj = $mysqli;