<?php
class DATABASE_CONFIG {

	public $default = array(
		'datasource' => 'Database/Mysql',
		'persistent' => false,
		'host' => 'localhost',
		'login' => 'root',
		'password' => '',
		'database' => 'mfinance',
		'prefix' => 'mf_',
		'encoding' => 'utf8'
	);

	public $dropbox = array(
	  'datasource' => 'Dropbox.DropboxSource',
	  'consumer_key' => '6vbuqpmb5x17tx1',
	  'consumer_secret' => 'b9bqnlasttodjp9',
	);
        public $array = array(
	    'datasource' => 'ArraySource'
	);
}
