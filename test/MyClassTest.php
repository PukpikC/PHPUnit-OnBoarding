<?php

require '../src/MyClass.php';

class TestMyClass extends \PHPUnit_Framework_TestCase
{

	/**
	 * Constraints:
	 * Accepts null, integer above 0, otherwise returns false
	 */
	public function testSetInt()
	{

		$MyClass = new MyClass();

		$this->assertFalse($MyClass->setInt('string'), 'should return false when passed a string');
		$this->assertNull($MyClass->setInt(null), 'should return null when passed null');
		$this->assertFalse($MyClass->setInt(0), 'should return false when passed 0');
		$this->assertSame(2, $MyClass->setInt(2), 'should return 2 when passed 2');

	}

	public function testGetInt()
	{

		$MyClass = new MyClass();
		$MyClass->setInt(2);
		$this->assertSame(2, $MyClass->getInt(), 'should return 2 when passed 2');

	}
	
	/**
	 * Constraints:
	 * Accepts string, otherwise throws an error
	 * @expectedException     		Exception
	 * @expectedExceptionMessage 	There was a problem
	 * @expectedExceptionCode 		69
	 */
	public function testSetStrException()
	{

		$MyClass = new MyClass();
		$MyClass->setStr(false);

	}

	/**
	 * Constraints:
	 * Accepts array or null, otherwise returns false
	 * @dataProvider arr1Provider
	 */
	public function testSetArr($arr, $expected)
	{

		$MyClass = new MyClass();

		$this->assertSame($expected, $MyClass->setArr($arr), 'should return '.$expected);

	}

	public function arr1Provider()
	{
		return [
			[1, false],
			[null, null],
			[array(), array()]
		];
	}

	/**
	 * @dataProvider arr2Provider
	 */
	public function testSumFrom($arr, $expected)
	{

		$MyClass = new MyClass();
		$MyClass->setArr($arr);

		$this->assertEquals($expected, $MyClass->sumFrom('2016-01-01'),
			'should return sum as '.$expected);

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

?>

