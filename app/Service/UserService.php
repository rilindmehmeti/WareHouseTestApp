<?php
namespace App\Service;
use App\Model\Domain\User;
use App\Model\Domain\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Helper\IOHelper;
use Mockery\Exception;

/**
 * DeviceService short summary.
 *
 * DeviceService description.
 *
 * @version 1.0
 *
 */
class UserService
{
    public static function listItems($keyword='',$orderby='', $sort= '', $perPage = 25)
    {


        if(empty($orderby))
            $orderby = 'id';

        if(empty($sort))
            $sort = 'desc';

        if (!empty($keyword)) {
            $users = User::where('name', 'LIKE', "%$keyword%")
                ->orWhere('email', 'LIKE', "%$keyword%")
                ->orWhere('role', 'LIKE', "%$keyword%")
                ->orWhere('id', 'LIKE', "%$keyword%")
                ->orderBy($orderby, $sort)
                ->paginate($perPage);
        } else {
            $users = User::orderBy($orderby, $sort)->paginate($perPage);
        }

        return $users;
    }

    public static function get($id)
    {
        $user = User::findOrFail($id);
        return $user;
    }

    public static function delete($id)
    {
        User::destroy($id);
        Session::flash('flash_message', 'User deleted!');
    }

    public static function alterShop(User $user, Shop $shop)
    {   if($user->HasRole('admin'))
            throw new Exception('Admins can manage all shops');
        if($user->shops->contains($shop)){
            $user->shops()->detach($shop);
        }else{
            $user->shops()->attach($shop);
        }
    }

    public static function showShops(User $user)
    {
        if($user->HasRole('admin'))
            throw new Exception('Admin can manage all shops');
    }

}
