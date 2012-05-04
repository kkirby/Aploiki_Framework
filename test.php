<?
require('MemoryTracker.php');

class asdf {
	public function __construct($s){
		$this->string = $s;
	}
	public $string = '';
}

$tracker = new MemoryTracker;

$tracker->track('before');
$array = array();
for($i = 0; $i <= 5000; $i++)new asdf("hi");
$tracker->track('after');
$tracker->output();
?>