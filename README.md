# PHPUnit-OnBoarding
Get up to speed on PHPUnit

# ReFaCoVe
Requirements
Failing Tests
Code
Verification

Manual
https://phpunit.de/manual/current/en/

Installing
https://phar.phpunit.de/phpunit.phar
or 
composer require "phpunit/phpunit=5.4.*"
composer global require "phpunit/phpunit=5.4.*"

# Running Tests
/project/test
phpunit TestClass.php

# Use a bootstrap file
phpunit --bootstrap ./bootstrap.php TestClass.php

# Other useful commands 
https://phpunit.de/manual/current/en/textui.html
--verbose --debug
--stop-on-error
--stop-on-failure

# Naming the Test Class
class MyClassTest extends \PHPUnit_Framework_TestCase
{

}

# Naming Test Functions
public function testConstructor()
{

}

public function testSetFoo()
{

}

# Assertations
https://phpunit.de/manual/current/en/appendixes.assertions.html
Common
assertEquals(Expected, Actual, Message)
assertSame(Expected, Actual, Message)
assertNull(Actual, Message)
assertInternalType('Expected', Actual, Message)
* Expected in brackets
assertFalse(bool $condition, Message)
assertTrue(bool $condition, Message)
assertFileExists(string $filename, Message)

Arrays
assertArrayHasKey('foo', ['bar' => 'baz'], Message);
assertContains(mixed $needle, Iterator|array $haystack, Message)
assertCount($expectedCount, $haystack, Message)
assertEmpty(mixed $actual, Message)

# Putting it all Together
public function testConstructor()
{

$foo = 1;
$bar = 'abc';
$arr = array();

$MyClass = new \crazyfactory\shop\MyClass($foo, $bar, $arr);

$this->assertEquals(1, $MyClass->foo, 
'should set foo as 1');
$this->assertInternalType('string', $MyClass->bar, 
'should set bar as type string');
$this->assertCount(0, $MyClass->arr, 
'should set arr as an empty array');

}

# Testing for Exceptions
/**      
* @expectedException     Exception
* @expectedExceptionMessage Some Message      
* @expectedExceptionCode 20      
*/     
public function testExceptionHasErrorcode20()     
{         
throw new Exception('Some Message', 20);
// Or method that throws exception
$MyClass = new MyClass();
$MyClass->setStr(false);

}

/**      
* @expectedException     Exception
* @expectedExceptionMessage There was a problem    
* @expectedExceptionCode 69      
*/  
public function testSetVarWithException()     
{         
$MyClass = new MyClass();
$MyClass->setStr(false);
}

class MyClass
{
public function setStr($str)
{
if (is_null($str) || is_string($str)) $this->str = $str;
else throw new Exception('There was a problem', 69);
return $this->str;
}
}


# Data Providers
/**
* @dataProvider additionProvider
*/
public function testAdd($a, $b, $expected)
{
$this->assertEquals($expected, $a + $b);
}

public function additionProvider()
{
return [
'adding zeros'  => [0, 0, 0],
'zero plus one' => [0, 1, 1],
'one plus zero' => [1, 0, 1],
'one plus one'  => [1, 1, 3]
];
}
With more complex data sets
class MyClass
{

public function setArr($arr)
{
if (is_null($arr) || is_array($arr)) $this->arr = $arr;
else $this->arr = false;
return $this->arr;
}

public function sumFrom($from)
{

$temp = array_filter($this->arr, function($item) use($from){
return $item['date'] >= $from;
});

$sum = array_reduce($temp, function($i, $arr) {
return $i += $arr['pnts'];
});

return $sum;

}
}

class MyClassTest extends \PHPUnit_Framework_TestCase
{

/**
* @dataProvider arr2Provider
*/
public function testSumFrom($arr, $expected)
{

$MyClass = new MyClass();
$MyClass->setArr($arr);

$this->assertEquals($expected, $MyClass->sumFrom('2016-01-01'), 'should return sum as '.$expected);

}

public function arr2Provider()
{
return 
[
[
array(
array('date'=>'2015-02-01', 'pnts'=>100),
array('date'=>'2015-03-01', 'pnts'=>50),
array('date'=>'2015-04-01', 'pnts'=>-75),
),
0
],
[
array(
array('date'=>'2016-02-01', 'pnts'=>200),
array('date'=>'2016-03-01', 'pnts'=>40),
array('date'=>'2016-04-01', 'pnts'=>-75),
),
165
],
[
array(
array('date'=>'2015-02-01', 'pnts'=>300),
array('date'=>'2016-03-01', 'pnts'=>-50),
array('date'=>'2017-04-01', 'pnts'=>-75),
),
-125
],
];
}

}
