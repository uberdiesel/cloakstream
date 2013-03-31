<?php

class CouchPotato_DB extends SQLite3{

	function __construct($db_path = NULL){
		if($db_path == NULL)
			die('db not set');
		$this->open($db_path);
	}
	
	function get_files(){
		$rows = $this->query("
			SELECT DISTINCT F.path, LT.title, F.id, L.id as library_id, L.year FROM 
			file as F, 
			release_files__file_release as RF, 
			release as R, 
			library as L,
			librarytitle as LT,
			movie as M
			WHERE 
			F.id = RF.file_id AND
			RF.release_id = R.id AND
			R.movie_id = M.id AND
			M.library_id = L.id AND
			L.id = LT.libraries_id AND
			LT.'default' == '1' AND
			F.type_id = '5' AND
			F.path LIKE '%.mp4'
			ORDER BY LT.title
		");
		$result = array();
		while($row = $rows->fetchArray(SQLITE3_ASSOC) ){
			array_push($result,$row);
		}
		
		$rows->finalize();
		return $result;
	}
	
	function get_movie($fid){
		$rows = $this->query("
			SELECT F.*, LT.title, L.*  FROM 
			file as F, 
			release_files__file_release as RF, 
			release as R, 
			library as L,
			librarytitle as LT,
			movie as M
			WHERE
			F.id = RF.file_id AND
			RF.release_id = R.id AND
			R.movie_id = M.id AND
			M.library_id = L.id AND
			L.id = LT.libraries_id AND
			LT.'default' == '1' AND 
			F.id = '$fid'"
			);
		
		$result = $rows->fetchArray(SQLITE3_ASSOC);
		
		$rows->finalize();
		return $result;
			
		
	}
	
	function get_posters($lid){
		$rows = $this->query("
			SELECT F.path  FROM 
			file as F, 
			library_files__file_library as LF
			WHERE
			F.id = LF.file_id AND
			LF.library_id = '$lid' AND
			(F.type_id = '1' OR F.type_id='2')
			ORDER BY type_id"
			);
		
		$result = $rows->fetchArray(SQLITE3_ASSOC);
		
		$rows->finalize();
		return $result;
	}
	

}

