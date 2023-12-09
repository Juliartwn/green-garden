<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use App\Models\Product;
use App\Models\Seller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Product::paginate(5);
        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Categorie::all();
        $sellers = Seller::all();

        $data['categories'] = $categories;
        $data['sellers'] = $sellers;

        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = $request->validate([
            'name_product' => 'required',
            'desc_product' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'id_seller' => 'required',
            'id_category' => 'required',
            'img_product' => 'required|file|mimes:png,jpg',
        ]);

        try {
            $filename = time() . $request->file('img_product')->getClientOriginalName();
            $path = $request->file('img_product')->storeAs('uploads/products', $filename);
            $validation['img_product'] = $path;
            $response = Product::create($validation);

            return response()->json([
                'success' => true,
                'message' => 'success',
                'data' => $response,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error',
                'errors' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    function seller() {
        $data = Seller::all();
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Product::find($id);
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validation = $request->validate([
            'name_product' => 'required',
            'desc_product' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'id_seller' => 'required',
            'id_category' => 'required',
            'img_product' => '',
        ]);

        try {
            if($request->file('img_product')) {
                $filename = time() . $request->file('img_product')->getClientOriginalName();
                $path = $request->file('img_product')->storeAs('uploads/products', $filename);
                $validation['img_product'] = $path;
            }
            $response = Product::find($id);
            $response->update($validation);

            return response()->json([
                'success' => true,
                'message' => 'success',
                'data' => $response,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error',
                'errors' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $product=Product::find($id);
            $product->delete();
            return response()->json([
                'success' => true,
                'message' => 'Success'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error',
                'errors' => $e->getMessage(),
            ]);
        }

    }
}
