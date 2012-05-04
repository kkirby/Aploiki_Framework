<?php
namespace php\lang\collection;

\php\lang\import('php\lang\Object');
\php\lang\import('php\lang\Collection');

class Set extends \php\lang\Object implements \php\lang\Collection {
	private $_collection = array();
	
	public function add(\php\lang\Object &$o){
		if(!isset($this->_collection[$o->getClass()])){
			$o->retain();
			$this->_collection[$o->getClass()] = &$o;
		}
	}
	
	public function addAll(\php\lang\Collection $o){
		foreach($o as $v)
			$this->add(&$v);
	}
	
	public function remove(\php\lang\Object $o){
		if(isset($this->_collection[$o->getClass()]) && $this->_collection[$o->getClass()] === $o){
			$o->release();
			unset($this->_collection[$o->getClass()]);
		}
	}
	
	public function removeAll(\php\lang\Collection $o){
		foreach($o as $v)
			$this->remove($v);
	}
	
	public function contains(\php\lang\Object $o){
		return isset($$this->_collection[$o->getClass()]) && $this->_collection[$o->getClass()] === $o;
	}
	
	public function clear(){
		foreach($this->_container as $v)
			$v->release();
		$this->_container = array();
	}
	
	public function size(){
		return \count($this->_collection);
	}
	
	public function isEmpty(){
		return $this->size() == 0;
	}
	
	public function toArray(){
		$return = array();
		foreach($this as $v)
			$return[] = &$v;
		return $return;
	}
	
	public function current(){
		return \current($this->_collection);
	}
	
	public function key(){
		return \key($this->_collection);
	}
	
	public function valid(){
		return \current($this->_collection) !== false;
	}
	
	public function next(){
		\next($this->_collection);
	}
	
	public function rewind(){
		\reset($this->_collection);
	}
	
	public function map($function){
		foreach($this->_collection as $key => $value){
			$this->_collection[$key] = &$function($key,&$value);
		}
	}
	
	public function each($function){
		foreach($this->_collection as $value)
			$function($value);
	}
	
	public function dealloc(){
		foreach($this as $item){
			$item->release();
		}
		parent::dealloc();
	}
}
?>