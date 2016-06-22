<?php

class MyClass
{
	
	private $int, $str, $arr;

	/**
	 * @return mixed
	 */
	public function getInt()
	{
		return $this->int;
	}

	/**
	 * @param mixed $int
	 */
	public function setInt($int)
	{
		if (is_null($int) || (is_integer($int) && $int > 0)) $this->int = $int;
		else $this->int = false;
		return $this->int;
	}

	/**
	 * @return mixed
	 */
	public function getStr()
	{
		return $this->str;
	}

	/**
	 * @param mixed $str
	 */
	public function setStr($str)
	{
		if (!is_string($str))
			throw new Exception('There was a problem', 69);

		$this->str = $str;

		return $this->str;
	}

	/**
	 * @return mixed
	 */
	public function getArr()
	{
		return $this->arr;
	}

	/**
	 * @param mixed $arr
	 */
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













































//
//class MyClass
//{
//
//	private
//		$int, $str, $arr;
//
//	/**
//	 * @return mixed
//	 */
//	public function getInt()
//	{
//		return $this->int;
//	}
//
//	/**
//	 * @param mixed $int
//	 */
//	public function setInt($int)
//	{
//		if (is_null($int) || (is_integer($int) && $int > 0)) $this->int = $int;
//		else $this->int = false;
//		return $this->int;
//	}
//
//	/**
//	 * @return mixed
//	 */
//	public function getStr()
//	{
//		return $this->str;
//	}
//
//	/**
//	 * @param mixed $str
//	 */
//	public function setStr($str)
//	{
//		if (is_null($str) || is_string($str)) $this->str = $str;
//		else throw new Exception('There was a problem', 69);
//		return $this->str;
//	}
//
//	/**
//	 * @return mixed
//	 */
//	public function getArr()
//	{
//		return $this->arr;
//	}
//
//	/**
//	 * @param mixed $arr
//	 */
//	public function setArr($arr)
//	{
//		if (is_null($arr) || is_array($arr)) $this->arr = $arr;
//		else $this->arr = false;
//		return $this->arr;
//	}
//
//	public function sumFrom($from)
//	{
//
//		$temp = array_filter($this->arr, function($item) use($from){
//			return $item['date'] >= $from;
//		});
//
//		$sum = array_reduce($temp, function($i, $arr) {
//			return $i += $arr['pnts'];
//		});
//
//		return $sum;
//
//	}
//
//
//}