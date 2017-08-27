<?php
namespace App\Model\Domain;

class Image extends ModelBase
{    /**
	 * The database table used by the model.
	 * @var string
	 */
    protected $table = 'images';

    /**
	 * The database primary key value.
	 * @var string
	 */
    protected $primaryKey = 'id';

    /**
	 * Attributes that should be mass-assignable.
	 * @var array
	 */
    protected $fillable = ['device_id', 'path'];

	protected $rules =
	[
		'device_id' => 'required',
		'path' => 'required'
    ];

	public function device()
	{
        return $this->belongsTo('App\Model\Domain\Device');
	}
}
