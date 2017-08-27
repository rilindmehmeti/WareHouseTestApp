<?php
namespace App\Helper;

class HtmlHelper
{
	public static function sortCell($name, $label, $attributes = [])
	{
		$url = request()->getPathInfo();
		$orderby = request()->get('orderby', 'id');
		$sort = request()->get('sort', 'desc');
		$from = request()->get('from');
		$to = request()->get('to');
		$search = request()->get('search');

		if(empty($sort))
			$sort = 'desc';

		if(empty($orderby))
			$orderby = 'orders.id';

		$caret = ($sort == 'desc' ? 'down' : 'up');

		if($orderby == $name)
			$sort = ($sort == 'desc' ? 'asc' : 'desc');
		else
			$sort = 'desc';

		$attr = "";
		foreach ($attributes as $k => $v)
			$attr.= ' '.$k.'="'.$v.'"';

		echo '<a href="'.$url.'?orderby='.$name.'&sort='.$sort.'&from='.$from.'&to='.$to.'&search='.$search.'" '.$attr.'>'.$label.($orderby == $name ? ' <i class="fa fa-caret-'.$caret.'"></i>' : '').'</a>';
	}
}
?>