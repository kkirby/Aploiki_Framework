<?php

class MemoryTracker{
	public $tracks = array();
	
	public function __construct(){
		$this->track('Baseline');
	}
	
	public function track($message){
		$memory = memory_get_usage();
		$this->tracks[] = array($memory,$message);
	}
	
	public static function memoryFormat($input){
		$kb = 1024;
		$mb = 1024 * $kb;
		if(abs($input) >= $mb){
			$return = array($input / $mb, 'MB');
		}
		else if (abs($input) >= $kb){
			$return = array($input / $kb, 'KB');
		}
		else $return = array($input, 'B');
		return round($return[0],2) . $return[1]; 
	}
	
	public function output(){
		foreach($this->tracks as $index => $array){
			$memory = $array[0];
			if($index > 0)
				$memory = $memory - $this->tracks[$index-1][0];
			
			echo ($memory > 0 ? '+' : '') . self::memoryFormat($memory) . ' - ' . $array[1] . '<br/>';
		}
	}
	
}

?>