<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Service\OrderService;
use App\Service\DeviceService;
use App\Model\Domain\Order;
use Illuminate\Http\Request;
use Session;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
		$shops = DeviceService::listShopIds($request);
		$orders = OrderService::listItems($shops, $request->get('search'), 25, $request->get('from'), $request->get('to'), $request->get('orderby', 'orders.id'), $request->get('sort', 'desc'));

        return view('orders.index', ['orders' => $orders,
			'search' => $request->get('search'),
			'from' => $request->get('from'),
			'to' => $request->get('to')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('orders.create');
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
			OrderService::insert($request);
			return redirect('orders');
		}
		catch (\Exception $ex)
		{
			return redirect()->back()->withInput($request->toArray())->withErrors($ex->getMessage());
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
        $order = Order::findOrFail($id);
        return view('orders.show', compact('order'));
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
		$order = OrderService::get($id);
        return view('orders.edit', compact('order'));
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
			OrderService::update($request, $id);
			return redirect('orders');
		}
		catch (\Exception $ex)
		{
			return redirect()->back()->withInput($request->toArray())->withErrors($ex->getMessage());
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
			OrderService::delete($id);
			return redirect('orders');
		}
		catch (\Exception $ex)
		{
			return redirect('orders')->withErrors($ex->getMessage());
		}
    }

	public function getDevice(Request $request)
	{
		return OrderService::searchDevice($request);
	}

	public function invoice($id)
	{
		$order = OrderService::invoiceModel($id);
		return view('orders.invoice_form', compact('order'));
	}

	public function download(Request $request, $id)
	{
		$data = $request->toArray();
		$order = OrderService::invoiceModel($id);
		$pdf = \Barryvdh\Snappy\Facades\SnappyPdf::loadView('orders.invoice', compact('order'));
		return $pdf->download('invoice.pdf');
	}
}
