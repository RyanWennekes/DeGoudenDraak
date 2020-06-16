<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Order;
use App\Sale;
use Carbon\Carbon;
use Endroid\QrCode\QrCode;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrderRequest $request)
    {
        try {
            $order = Order::create([
                'table_id' => $request->get('table_id'),
            ]);

            $order->save();

            foreach ($request->get('products') as $product) {
                Sale::create([
                    'product_id' => $product['id'],
                    'order_id'   => $order->id,
                    'price'      => $product['discountPrice'],
                    'amount'     => $product['total'],
                    'comment'    => isset($product['comment']) ? $product['comment'] : null,
                ])->save();
            }
        } catch (\Exception $exception) {
            return response('', 500);
        }

        return response('', 200);
    }

    public function storeTakeout(Request $request) {
        try {
            $data = [];
            $basket = $request->get('basket');
            $order = Order::create([
                'created_at' => Carbon::now()
            ]);

            array_push($data, $order);

            $info = "Order nr: ".$order->id."\n\nGerechten:\n";

            foreach($basket as $product) {
                $price = $product['price'];

                if(count($product['offers'])) {
                    foreach($product['offers'] as $offer) {
                        $price *= (100 - $offer['discount']) / 100;
                    }
                }

                $sale = Sale::create([
                    'product_id' => $product['id'],
                    'order_id' => $order->id,
                    'price' => $price,
                    'amount' => $product['count'],
                    'created_at' => Carbon::now()
                ]);

                array_push($data, $sale);
//                $info .= '['.$product['code'].' - '.$product['name'].' x'.$product['count'].'], ';
                $info .= $product['code'].": ".$product['name']." x".$product['count']."\n";
            }

            $info .= "\n\n Hoogachtend,\n De Gouden Draak";

            $image = new QrCode($info);
        } catch(\Exception $exception) {
            return response($exception, 500);
        }

        return response(json_encode(["code" => base64_encode($image->writeString()), "order" => $order['id']]), 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Order               $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
