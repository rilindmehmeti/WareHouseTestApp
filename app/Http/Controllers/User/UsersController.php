<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

use App\Http\Requests;
use App\Model\Domain\User;
use App\Model\Domain\Shop;
use App\Service\UserService;
use Illuminate\Http\Request;
use Session;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','roles:admin'], ['except'=> 'show']);
    }

    public function index(Request $request)
    {
        $users = UserService::listItems($request->get('search'),$request->get('orderby'), $request->get('sort'), 10);
        return view('users.index', ['users' => $users, 'search' => $request->get('search')]);
    }

    public function create()
    {
        return view('users.create');
    }

    public function show($id)
    {
        try
        {
            $user = UserService::get($id);
            return view('users.show', compact('user'));
        }
        catch (\Exception $ex)
        {
            return redirect('users')->withErrors($ex->getMessage());
        }
    }

    public function destroy($id)
    {
        try
        {
            UserService::delete($id);
            return redirect('users');
        }
        catch (\Exception $ex)
        {
            return redirect('users')->withErrors($ex->getMessage());
        }
    }

    public function shops(User $user)
    {
        try
        {
            UserService::showShops($user);
            return view('users.shops', compact('user'));
        }
        catch (\Exception $ex)
        {
            return redirect('users')->withErrors($ex->getMessage());
        }

    }

    public function alterShop(User $user, Shop $shop){
        try
        {
            UserService::alterShop($user,$shop);
            return redirect('/users/'.$user->id.'/shops');
        }
        catch (\Exception $ex)
        {
            return redirect('users')->withErrors($ex->getMessage());
        }
    }
}
