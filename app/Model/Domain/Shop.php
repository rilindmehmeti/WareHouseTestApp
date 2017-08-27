<?php
namespace App\Model\Domain;

class Shop extends ModelBase
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'shops';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'country', 'city', 'active'];
    protected $rules =
        [
            'name' => 'required',
            'country' => 'required',
            'city'  => 'required',
            'active' => 'required'
        ];

    public function users()
	{
        return $this->belongsToMany('App\Model\Domain\User')->withTimestamps();
    }

	public function devices()
	{
		return $this->hasMany('App\Model\Domain\Device');
	}
}
