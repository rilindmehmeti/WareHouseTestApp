<?php
namespace App\Model\View;

abstract class ViewModelBase
{
	public function __construct($data = [])
	{
		$this->fill($data);
	}

	public function fill($data)
	{
		foreach ($data as $key => $value)
		{
			$this->{$key} = $value;
		}
	}
}
?>