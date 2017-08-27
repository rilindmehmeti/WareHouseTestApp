<?php
namespace App\Model\Domain;

class Order extends ModelBase
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'orders';

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
    protected $fillable = ['device_id', 'status', 'saleOrderId'];


	public function device()
	{
        return $this->belongsTo('App\Model\Domain\Device');
	}
}
