<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Product;
use Illuminate\Http\Request;
use PHPUnit\Exception;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Support\Collection
     */
    public function index()
    {
        return Product::productWithSales();
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function minimized()
    {
        return Product::products();
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
     * @param  \App\Http\Requests\StoreProductRequest $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        $product = Product::create($request->all());

        return $product->save() ? response('', 200) : response('Something went wrong', 500);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest $request
     * @param  \App\Product                            $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        if ($request->has('code')) {
            $response = $product->update(['code' => $request->get('code')]);
        } else {
            $response = $product->update(['name' => $request->get('name')]);
        }

        return $response ? response('', 200) : response("Couldn't update product", 500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product $product
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Product $product)
    {
        try {
            if (! $product->trashed()) {
                $product->delete();
            }

            return response('', 200);
        } catch (Exception $exception) {
            return response($exception->getMessage(), 500);
        }
    }
}
