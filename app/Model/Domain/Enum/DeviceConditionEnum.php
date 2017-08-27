<?php
namespace App\Model\Domain\Enum;

class DeviceConditionEnum extends EnumBase
{
	const _New = 0,
	Opened = 1,
	BrokenFixable = 2,
	BrokenUnfixable = 3;

	/**
	 * @param int $num
	 * @return string
	 */
	static function getVal($num)
	{
		switch ($num)
		{
			case self::_New:
			default: return "New";
			case self::Opened:
				return "Opened";
			case self::BrokenFixable:
				return "Broken Fixable";
			case self::BrokenUnfixable:
				return "Broken Unfixable";
		}
	}


	/**
	 * @param string $val
	 * @return int
	 */
	static function getNum($val)
	{
		switch ($val)
		{
			case "New":
			default: return self::_New;
			case "Opened":
				return self::Opened;
			case "Broken fixable":
				return self::BrokenFixable;
			case "Broken Unfixable":
				return self::BrokenUnfixable;
		}
	}
}
?>