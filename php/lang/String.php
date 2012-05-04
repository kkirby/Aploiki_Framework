<?php
namespace php\lang;

import('php\lang\Object');

class String extends Object {
	
	private $_primitive = '';
	
	public function __construct($primitiveString = ""){
		$this->_setPrimitive($primitiveString);
	}
	
	private function _setPrimitive($primitive){
		$this->_primitive = $primitive;
	}
	
	private function _getPrimitive(){
		return $this->_primitive;
	}
	
	public function charAt($index){
		$string = $this->_getPrimitive();
		return $string{$index};
	}
	
	public function contains($input){
		return $this->indexOf($input) !== false;
	}
	
	public function concat($input){
		return String::alloc($this->_getPrimitive() . $input);
	}
	
	public function endsWith($input){
		return $this->indexOf($input) + strlen($input) == $this->length();
	}
	
	public function indexOf($input, $fromIndex = 0, $caseSensitive = false){
		if($caseSensitive)
			return \stripos($this->_getPrimitive(),$input,$fromIndex);
		else
			return \strpos($this->_getPrimitive(),$input,$fromIndex);
	}
	
	public function lastIndexOf($input, $fromIndex = 0, $caseSensitive = false){
		if($caseSensitive)
			return strripos($this->_getPrimitive(),$input,$fromIndex);
		else
			return strrpos($this->_getPrimitive(),$input,$fromIndex);
	}
	
	public function length(){
		return strlen($this->_getPrimitive());
	}
	
	public static function &format($format){
		$output = \call_user_func_array('sprintf',\func_get_args());
		return String::alloc($output);
	}
	
	public function &replaceAll($old,$new,&$count = 0, $caseSensitive = false){
		if($caseSensitive)
			return String::alloc(\str_replace($old,$new,$this->_getPrimitive(),&$count));
		else
			return String::alloc(\str_ireplace($old,$new,$this->_getPrimitive(),&$count));
	}
	
	public function &replaceFirst($old, $new, $fromIndex = 0, $caseSensitive = false){
		$index = $this->indexOf($old,$fromIndex,$caseSensitive);
		if($index)
			return String::alloc(\substr_replace($this->_getPrimitive(),$new,$index,\strlen($old)));
		else return false;
	}
	
	public function split($splitter){
		$parts = \explode($splitter,$this->_getPrimitive());
		foreach($parts as $k => $v)
			$parts[$k] = &String::alloc($v);
		return $parts;
	}
	
	public function startsWith($input){
		return $this->indexOf($input) === 0;
	}
	
	public function &subString($start){
		if(func_num_args() == 2)
			return String::alloc(\substr($this->_getPrimitive(),$start,\func_get_arg(1)));
		else return String::alloc(\substr($this->_getPrimitive(),$start));
	}
	
	public function toCharArray(){
		return str_split($this->_getPrimitive());
	}
	
	public function &toLowerCase(){
		return String::alloc(\strtolower($this->_getPrimitive()));
	}
	
	public function &toUpperCase(){
		return String::alloc(\strtoupper($this->_getPrimitive()));
	}
	
	public function __toString(){
		return $this->_getPrimitive();
	}
	
	public function &trim($charList = ''){
		if(\is_array($charList))
			$charList = \implode('',$charlist);
		return String::alloc(trim($this->_getPrimitive(),$charList));
	}
	
	public function &trimStart($charList = ''){
		if(is_array($charList))
			$charList = \implode('',$charlist);
		return String::alloc(\ltrim($this->_getPrimitive(),$charList));
	}
	
	public function &trimEnd($charList = ''){
		if(is_array($charList))
			$charList = \implode('',$charlist);
		return String::alloc(\rtrim($this->_getPrimitive(),$charList));
	}

	public static function &valueOf($input){
		if(is_bool($input))
			return String::alloc($input ? 'true' : 'false');
		else if(\is_numeric($input))
			return String::alloc(\strval($input));
		else return String::alloc((string)$input);
	}
}

?>