<?php

namespace App\Http\Controllers;

use App\Events\OrderCompletedEvent;
use App\Http\Requests\Orders\CreateRequest;
use App\Order;
use App\Partner;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('orders.index');
    }

    public function getAll()
    {
        $orders = Order::with(['products', 'partner'])->paginate(10);
        $orders = Order::setPrice($orders);

        return $orders;
    }

    public function getPastDue()
    {
        $orders = Order::with(['products', 'partner'])
            ->whereDate('delivery_dt', '<', Carbon::now()->format('Y-m-d'))
            ->where('status', Order::getStatusCode(Order::CONFIRMED))
            ->orderBy('delivery_dt', 'desc')
            ->limit(50)
            ->get();
        $orders = Order::setPrice($orders);

        return $orders;
    }

    public function getCurrent()
    {
        $orders = Order::with(['products', 'partner'])
            ->whereDate('delivery_dt', Carbon::now()->format('Y-m-d'))
            ->where('status', Order::getStatusCode(Order::CONFIRMED))
            ->orderBy('delivery_dt', 'asc')
            ->paginate(10);
        $orders = Order::setPrice($orders);

        return $orders;
    }

    public function getNew()
    {
        $orders = Order::with(['products', 'partner'])
            ->whereDate('delivery_dt', '>', Carbon::now()->format('Y-m-d'))
            ->where('status', Order::getStatusCode(Order::NEW))
            ->orderBy('delivery_dt', 'asc')
            ->limit(50)
            ->get();
        $orders = Order::setPrice($orders);

        return $orders;
    }

    public function getCompleted()
    {
        $orders = Order::with(['products', 'partner'])
            ->whereDate('delivery_dt', Carbon::now()->format('Y-m-d'))
            ->where('status', Order::getStatusCode(Order::COMPLETED))
            ->orderBy('delivery_dt', 'asc')
            ->limit(50)
            ->get();
        $orders = Order::setPrice($orders);

        return $orders;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Order $order
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        $order = $order->load(['partner', 'products']);
        $partners = Partner::all();
        $statuses = Order::STATUSES;

        return view('orders.edit', compact('order', 'partners', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CreateRequest $request
     * @param Order $order
     * @return \Illuminate\Http\Response
     */
    public function update(CreateRequest $request, Order $order)
    {
        $order->client_email = $request->input('client_email');
        $order->partner_id = $request->input('partner');
        $order->status = $request->input('status');
        $order->save();

        if ($order->status === Order::COMPLETED) {
            event(new OrderCompletedEvent($order));
        }

        return redirect()->route('orders.index')->with('message', 'Заказ #' . $order->id . ' успешно обновлен');
    }
}
