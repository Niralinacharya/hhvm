<?php
class A {}
class B extends A {}
class C extends B {}

interface I {}
class X implements I {}

$classNames = array('A', 'B', 'C', 'I', 'X'); 

//Create ReflectionClasses
foreach ($classNames as $className) {
	$rcs[$className] = new ReflectionClass($className);
}

//Create ReflectionObjects
foreach ($classNames as $className) {
	if ($rcs[$className]->isInstantiable()) {
		$ros[$className] = new ReflectionObject(new $className);
	}
}

foreach ($ros as $childName => $child) {
	foreach ($rcs as $parentName => $parent) {
		echo "Is " . $childName . " a subclass of " . $parentName . "? \n";
		echo "   - Using ReflectionClass object argument: ";
		var_dump($child->isSubclassOf($parent));
		if ($parent->isInstantiable()) {
			echo "   - Using ReflectionObject object argument: ";
			var_dump($child->isSubclassOf($ros[$parentName]));
		}
		echo "   - Using string argument: ";
		var_dump($child->isSubclassOf($parentName)); 
	}
}
?>
