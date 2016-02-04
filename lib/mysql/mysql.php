<?php

class Mysql_DB
{
	# 数据库对象 为了确保唯一性，请保证引用传递
	private $db;
	public function & get_db() {
		return $this->db;
	}

	########################################################
	# 构造函数
	#
	# $host: 数据库地址
	# $db_name: 数据库名称
	# $user: 用户
	# $passwd: 密码
	#
	public function __construct($host, $db_name, $user, $passwd) {
		@ $db = new mysqli($host, $user, $passwd, $db_name);
		if (mysqli_connect_errno())
			throw new Exception("数据库连接错误");
		$this->db = &$db;
	}

	# answer_query - 以事务的形式执行一个MySQL的指令
	#
	# $query: 指令
	#
	public function answer_query($query) {
		$db = &$this->db;
		$db->autocommit(FALSE);
		$result = $db->query($query);
		$this->done();
		return $result;
	}

	# answer_queries - 顺序地以事务的形式执行一系列MySQL的指令
	#
	# $queries: 指令们
	#
	public function answer_queries($queries) {
		$db = &$this->db;
		$db->autocommit(FALSE);
		for ($i = 0; $i < count($queries); $i++) {
			$result[$i] = $db->query($queries[$i]);
		}
		$this->done();
		return $result;
	}

	# start - 开始一个事务
    public function start() {
		$db = &$this->db;
		$db->autocommit(FALSE);
    }

	# done - 结束一个事务
	public function done() {
		$db = &$this->db;

		if (!$db->errno) {
			$db->commit();
		} else {
            $errno = $db->errno;
            $error = $db->error;
			$db->rollback();
            switch ($errno) {
            default:
                throw new Exception("数据库访问错误:Error-$errno. '$error'");
            }
		}
	}
}

?>
