<?php
namespace App\Model\Domain;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use App\Model\Domain\Shop;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'role' ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function managingShops()
	{
        if ($this->role == 'admin')
		{
            return DB::table('shops');
        }
        else
		{
            return $this->shops();
        }
    }

    public function availableShops()
    {
        return Shop::whereNotIn('id', $this->managingShops()->pluck('id'));
    }

    public function HasRole($role)
	{
        return $this->role == $role;
    }

    public function scopeByRole($query, $role)
	{
        return $query->where('role', $role);
    }

    public function shops()
	{
        return $this->belongsToMany('App\Model\Domain\Shop')->withTimestamps();
    }
}
