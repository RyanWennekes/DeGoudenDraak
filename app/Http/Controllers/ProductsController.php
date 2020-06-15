<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Offer;
use App\Product;
use App\ProductType;
use Illuminate\Http\Request;
use Mpdf\MpdfException;

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
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Product             $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $product->timestamps = false;

        return $product->update([
            'name' => $request->get('name'),
        ]) ? response('', 200) : response("Couldn't update product", 500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }

    public function generatePDF() {
        $defaultConfig = (new \Mpdf\Config\ConfigVariables())->getDefaults();
        $fontDirs = $defaultConfig['fontDir'];

        $defaultFontConfig = (new \Mpdf\Config\FontVariables())->getDefaults();
        $fontData = $defaultFontConfig['fontdata'];
        try {
            $mpdf = new \Mpdf\Mpdf(
                [
                    'tempDir' => public_path('/upload'),
                    'fontDir' => array_merge($fontDirs, [
                        public_path('/fonts')
                    ]),
                    'fontdata' => $fontData + [
                            'main' => [
                                'R' => 'main.ttf'
                            ]
                        ],
                ]
            );
        } catch (MpdfException $e) {
        }

        $data = "<link href='/css/pdf.css' rel='stylesheet' type='text/css'/><div class='outer'><div class='inner'><h1 class='menu-title'>Menukaart</h1>";
        $data .= "<h3 class='menu-title'>Aanbiedingen</h3><table>";
        foreach(Offer::all() as $offer) {
            $product = $offer->offer;
            $data .= "
                <tr>
                    <td class='code'>$product->code</td>
                    <td class='name'>$product->name</td>
                    <td class='price'><span class='strikethrough'>$product->price</span> => " . number_format($product->price * (100 - $offer->discount) / 100, 2) . "</td>
                </tr>
            ";
        }

        $data .= "</table>";

        foreach(ProductType::all() as $category) {
            $data .= "<h3 class='menu-title'>$category->type_nl</h3><table>";

            foreach($category->products as $product) {
                $data .= "
                    <tr>
                        <td class='code'>$product->code</td>
                        <td class='name'>$product->name</td>
                        <td class='price'>$product->price</td>
                    </tr>
                ";
            }

            $data .= "</table>";
        }

        $data .= "</div></div>";


        try {
            $mpdf->WriteHTML($data);
            return $mpdf->Output();
        } catch (MpdfException $e) {
        }

        return null;
    }
}
