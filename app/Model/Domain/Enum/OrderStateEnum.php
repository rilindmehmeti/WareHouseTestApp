<?php
namespace App\Model\Domain\Enum;

class OrderStateEnum extends EnumBase
{
	const OnStock = 0,
	BeingRepaired = 1,
	ToBeSold = 2,
	Sold = 3;

	/**
	 * @param int $num
	 * @return string
	 */
	static function getVal($num)
	{
		switch ($num)
		{
			case self::OnStock:
			default: return "On Stock";
			case self::BeingRepaired:
				return "Being Repaired";
			case self::ToBeSold:
				return "To Be Sold";
			case self::Sold: return "Sold";
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
			case "On Stock":
			default: return self::OnStock;
			case "Being Repaired":
				return self::BeingRepaired;
			case "To Be Sold":
				return self::ToBeSold;
			case "Sold":
				return self::Sold;
		}
	}
}
?>