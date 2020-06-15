<?php

class DataManager {

	private $redis;

	public function __construct(){
	
		$this->redis = new Redis();
		$this->redis->connect('127.0.0.1', 6379);
	
	}

	public function addNewUser($userId, $username){
		$this->redis->set('user:'.$userId, $username);			
	}

	public function removeUser($userId){
	
		$this->redis->del('user:'.$userId);
	}

	public function getAllUsers(){
	
		$userKeys = $this->redis->keys('*');
		$users = array();
		
		foreach($userKeys as $key){
		
			$users[] = explode(':', $key)[1];
		}
		
		return $users;
	} 
}
