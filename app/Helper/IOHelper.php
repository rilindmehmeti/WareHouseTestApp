<?php

namespace App\Helper;
use Illuminate\Support\Facades\Storage;
/**
 * IOHelper short summary.
 *
 * IOHelper description.
 *
 * @version 1.0
 *
 */
class IOHelper
{
	public static function writeFile($file, $dir, $filename)
	{
		$respath = Storage::putFileAs($dir, $file, $filename.'.'.$file->getClientOriginalExtension());
		return $respath;
	}

	public static function deleteFile($filename) 
	{
		Storage::delete($filename);
	}
}
