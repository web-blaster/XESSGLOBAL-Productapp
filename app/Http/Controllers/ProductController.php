<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }
    public function index()
    {
        try {
            //code...

            $products = Product::latest()->paginate(10);
            return view('products.index', compact('products'));
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function create()
    {
        return view('products.create');
    }




    public function store(ProductRequest $request)
    {
        try {
            $this->productService->create($request->validated());

            return redirect()->route('products.index')->with('success', 'Product created successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function update(ProductRequest $request, Product $product)
    {
        try {
            $this->productService->update($product, $request->validated());

            return redirect()->route('products.index')->with('success', 'Product updated successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Failed to update product. Please try again.');
        }
    }


    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }


    public function destroy(Product $product)
    {
        DB::beginTransaction();

        try {
            $product->delete(); // delete the product

            DB::commit();

            return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
        } catch (\Throwable $th) {
            DB::rollBack();

            // Log the error
            Log::error('Failed to delete product', [
                'product_id' => $product->id,
                'error' => $th->getMessage(),
                'trace' => $th->getTraceAsString()
            ]);

            return redirect()->route('products.index')->with('error', 'Failed to delete product. Please try again.');
        }
    }
}
