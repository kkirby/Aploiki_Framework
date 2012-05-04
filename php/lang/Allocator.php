<?php
namespace php\lang;

class Allocator{
	static private $_allocations;
	
	public static function &alloc(&$object,$retain = true){
		$iden = count(self::$_allocations);
		$object->setIdentifier($iden);
		if($retain)$object->retain();
		
		self::$_allocations[$iden] = &$object;
		
		return self::$_allocations[$iden];
	}
	
	public static function dealloc(Object $object){
		$iden = $object->getIdentifier();
		if(isset(self::$_allocations[$iden]) && self::$_allocations[$iden]->getRetainCount() == 0){
			self::$_allocations[$iden] = null;
			unset(self::$_allocations[$iden]);
		}
		else throw new Exception("The object is still in use.");
	}
}

?>