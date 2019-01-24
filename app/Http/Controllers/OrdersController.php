<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Order;
use App\Product;
use App\Reservation;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('portal.orders.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();

        $reservations = Reservation::whereNull('nota')->whereHas('tables', function ($q) {
            $q->where('start', '<', Carbon::now());
        })->get();

        $devices = [
            ['id' => 1, 'name' => 'Device 1'],
            ['id' => 2, 'name' => 'Device 2'],
            ['id' => 3, 'name' => 'Device 3']
        ];
        return view('portal.orders.create', compact('products', 'reservations', 'devices'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'reservation_id'=> 'required'
        ]);

        if (!$request->products) {
            return redirect()->back()->with('error', 'De bestelling bevat geen producten');
        }

        $order = new Order();

        $order->reservation_id = $request->reservation_id;
        $order->device_id = $request->device_id;

        $order->save();

        $products = [];

        foreach ($request->products as $id => $amount) {
            $price = Product::CalculatePrice($id, $amount);
            $products[$id] = ['amount' => $amount, 'payed' => $price];
        }

        $order->products()->sync($products);

        return redirect()->back()->with('success', 'De bestelling is toegevoegd');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
