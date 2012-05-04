<?php
require('MemoryTracker.php');
require('php/lang/Import.php');
$tracker = new MemoryTracker;

\php\lang\import('php\lang\Allocator');

\php\lang\import('php\lang\Constants');
\php\lang\import('php\lang\Object');
\php\lang\import('php\lang\collection\Set');
\php\lang\import('php\lang\collection\OrderedList');
\php\lang\import('php\lang\String');

$tracker->track('Before alloc');


$set = \php\lang\collection\OrderedList::alloc();
//$set = new \php\lang\collection\OrderedList;


$tracker->track('After alloc');

//$a = &$set->get(0);

//$set->release();
unset($a);

$tracker->track('After destruct');

$tracker->output();



exit;


$object = &php\String::alloc("Hello world!");
var_dump($object->toUpperCase());


?>