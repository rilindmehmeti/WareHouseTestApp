<?php

namespace App\Model\Domain;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
/**
 * ModelBase short summary.
 *
 * ModelBase description.
 *
 * @version 1.0
 *
 */
abstract class ModelBase extends Model
{
	/**
	 * Validation rules
	 * @var array
	 */
	protected $rules = [];

    /**
	 * @return bool
	 */
    public function validate($data = [])
    {
		if (count($data) == 0)
			$data = $this->attributes;
        $v = Validator::make($data, $this->rules);
        return $v->passes();
	}
}