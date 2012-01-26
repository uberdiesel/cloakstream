<?php

class SickBeard_DB extends SQLite3{

	function __construct($db_path = NULL){
		if($db_path == NULL)
			die('db not set');
		$this->open($db_path);
	}
	
	function get_shows($query = NULL){
		if($query != NULL){
			$rows = $this->query("SELECT s.tvdb_id, s.show_name 
								FROM tv_shows s,tv_episodes e 
								WHERE s.tvdb_id=e.showid 
									AND e.location LIKE '%mp4%' 
									
								GROUP BY s.tvdb_id, s.show_name 
								ORDER BY s.show_name
							");
		} else {
			//$rows = $this->query("SELECT * FROM tv_shows ORDER BY show_name");
			$rows = $this->query("SELECT s.tvdb_id, s.show_name FROM tv_shows s,tv_episodes e WHERE s.tvdb_id=e.showid AND e.location LIKE '%mp4%' GROUP BY s.tvdb_id, s.show_name ORDER BY s.show_name");
		}
		$result = array();
		while($row = $rows->fetchArray(SQLITE3_ASSOC) ){
			/*?><a href="<?=$_SERVER['PHP_SELF']?>?t=<?=$row['show_id']?>"><?=$row['show_name']?></a><br><?*/
			array_push($result,$row);
		}
		$rows->finalize();
		
		return $result;
	}
	
	private function search_helper($query,$field){
		$terms = explode(" ",$query);
		$query = "";
		foreach($terms as $term){
			$query .= " ".$field." LIKE '%".$term."%' AND ";
		}
		
		$query = substr($query,0,strlen($query-3));
		return $query;
		
	}
	
	function get_episodes($show_id){
		//$rows = $this->query("SELECT * FROM tv_episodes WHERE location!='' AND showid = ".$show_id);
		$rows = $this->query(
			"SELECT * 
			FROM tv_episodes 
			WHERE location!='' 
				AND location LIKE '%mp4%' 
				AND showid = ".$show_id
		);
		$result = array();
		while($row = $rows->fetchArray(SQLITE3_ASSOC) ){
			/*?><a href="<?=$_SERVER['PHP_SELF']?>?v=<?=$row['episode_id']?>"><?=$row['season']?>x<?=$row['episode']?> - <?=$row['name']?></a><br><?*/
			array_push($result,$row);
		}
		
		$rows->finalize();
		return $result;
	}
	
	function get_episode_file($episode_id){
		$result = $this->query(
			"SELECT location 
			FROM tv_episodes 
			WHERE episode_id=".$episode_id
		);
		$row = $result->fetchArray();
		
		$result->finalize();
		return $row['location'];
	}
	
	function get_episode_info($episode_id){
		$result = $this->query(
			"SELECT e.*, s.show_name, s.tvdb_id as tvdb_id
			FROM tv_episodes e,tv_shows s 
			WHERE episode_id=".$episode_id."
			AND s.tvdb_id = e.showid"
		);
		$row = $result->fetchArray();
		
		$result->finalize();
		return $row;
	}
	
	function get_episode_nav($episode_id){
		$result = $this->query(
			"SELECT e.episode_id 
			FROM tv_episodes e, tv_episodes e2
			WHERE e.showid = e2.showid
				AND e.location LIKE '%.mp4' 
				AND e2.episode_id=".$episode_id);
		$episodes = array();
		while($row = $result->fetchArray()){
			array_push($episodes,$row['episode_id']);
		}
		$index = array_search($episode_id,$episodes);
		$data = array();
		$data['next'] = (isset($episodes[$index+1]) ? $episodes[$index+1] : NULL);
		$data['prev'] = (isset($episodes[$index-1]) ? $episodes[$index-1] : NULL);
		
		return $data;
		
	}
	
	function get_show_info($show_id){
		$result = $this->query(
			"SELECT * 
			FROM tv_shows 
			WHERE tvdb_id=".$show_id
		);
		$row = $result->fetchArray();
		
		$result->finalize();
		return $row;
	}
	
	function new_episodes($limit = NULL){
		$rows = $this->query("
			SELECT * 
			FROM tv_episodes e, tv_shows s
			WHERE e.location LIKE '%.mp4' 
				AND s.tvdb_id = e.showid
			ORDER BY e.airdate DESC 
			LIMIT 10"
		);
		$result = array();
		while($row = $rows->fetchArray(SQLITE3_ASSOC) ){
			array_push($result,$row);
		}
		
		$rows->finalize();
		return $result;
	}
}

