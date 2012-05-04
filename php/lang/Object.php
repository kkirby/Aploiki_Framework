<?php
namespace php\lang;

class Object {
	public $class, $superclass;
		
	protected $_identifier, $_retain = 0;
	
	public function __construct(){}
	
	public function getClass(){
		return $this->class;
	}
	
	public function getSuperClass(){
		return $this->superclass;
	}
	
	public function __toString(){
		return $this->class;
	}
	
	private function _initalize(){
		$this->class = \get_class();
		$this->superclass = \get_parent_class();
	}
	
	public function setIdentifier($identifier){
		$this->_identifier = $identifier;
		return $this;
	}
	
	public function getIdentifier(){
		return $this->_identifier;
	}
	
	public function retain(){
		$this->_retain++;
		return $this;
	}
	
	public function release(){
		$this->_retain--;
		if($this->_retain == 0)
			$this->dealloc();
		return $this;
	}
	
	public function getRetainCount(){
		return $this->_retain;
	}
	
	protected function resetRetainCount(){
		$this->_retain = 0;
		return $this;
	}
	
	public function &copy(){
		$object = &Allocator::alloc(clone($this));
		$object->resetRetainCount()->retain();
		return $object;
	}
	
	public static function &alloc(){
		$reflection = new \ReflectionClass(get_called_class());
		$returnValue = &Allocator::alloc($reflection->newInstanceArgs(func_get_args()));
		unset($reflection);
		$returnValue->_initalize();
		return $returnValue;
	}
	
	public static function &passAlloc(){
		$reflection = new \ReflectionClass(get_called_class());
		$returnValue = &Allocator::alloc($reflection->newInstanceArgs(func_get_args()),false);
		unset($reflection);
		$returnValue->_initalize();
		return $returnValue;
	}
	
	protected function dealloc(){
		Allocator::dealloc($this);
	}
}

?>