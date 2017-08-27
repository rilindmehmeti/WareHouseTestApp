<?php

namespace App\Http\Controllers\Shop;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\Domain\Shop;
use App\Service\ShopService;
use Illuminate\Http\Request;
use Session;

class ShopsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','roles:admin']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $shops = ShopService::listItems($request->get('search'),$request->get('orderby'),$request->get('sort'), 10);
        return view('shop.index', ['shops' => $shops, 'search' => $request->get('search')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('shop.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try
        {
            ShopService::insert($request);
            return redirect('shops');
        }
        catch (\Exception $ex)
        {
            return redirect('shops')->withErrors($ex->getMessage());
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        try
        {
            $shop = ShopService::get($id);
            return view('shop.show', compact('shop'));
        }
        catch (\Exception $ex)
        {
            return redirect('shops')->withErrors($ex->getMessage());
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        try
        {
            $shop = ShopService::get($id);
            return view('shop.edit', compact('shop'));
        }
        catch (\Exception $ex)
        {
            return redirect('shops')->withErrors($ex->getMessage());
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        try
        {
            ShopService::update($request,$id);
            return redirect('shops');
        }
        catch (\Exception $ex)
        {
            return redirect('shops')->withErrors($ex->getMessage());
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try
        {
            ShopService::delete($id);
            return redirect('shops');
        }
        catch (\Exception $ex)
        {
            return redirect('shops')->withErrors($ex->getMessage());
        }
    }
}
