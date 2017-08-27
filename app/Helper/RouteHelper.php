<?php
namespace App\Helper;
use Illuminate\Support\Facades\Route;

class RouteHelper
{
	static function isActiveRoute($route, $output = "active")
	{
		if (Route::currentRouteName() == $route)
			return $output;
		return null;
	}

	static function areActiveRoutes(Array $routes, $output = "active")
	{
		foreach ($routes as $route)
		{
			if (Route::currentRouteName() == $route)
				return $output;
		}
		return null;
	}
}
?>