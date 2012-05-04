<?php
namespace php\lang;

interface Collection extends \Iterator {
	public function add(\php\lang\Object &$o);
	public function addAll(\php\lang\Collection $o);
	public function remove(\php\lang\Object $o);
	public function removeAll(\php\lang\Collection $o);
	public function contains(\php\lang\Object $o);
	public function clear();
	public function size();
	public function isEmpty();
	public function toArray();
	public function map($function);
	public function each($function);
}
?>