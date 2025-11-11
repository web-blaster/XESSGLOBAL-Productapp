<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProductService
{
    /**
     * Create a new product
     */

    // Get all products
    public function all()
    {
        try {
            return Product::all();
        } catch (\Throwable $th) {
            Log::error('Failed to fetch all products', [
                'error' => $th->getMessage(),
                'trace' => $th->getTraceAsString()
            ]);

            return null; // Or throw a custom exception if you prefer
        }
    }

    // Find a specific product by ID
    public function find($id)
    {
        try {
            return Product::find($id);
        } catch (\Throwable $th) {
            Log::error('Failed to fetch product', [
                'product_id' => $id,
                'error' => $th->getMessage(),
                'trace' => $th->getTraceAsString()
            ]);

            return null; // Or throw a custom exception if needed
        }
    }


    //save product
    public function create(array $data): Product
    {
        DB::beginTransaction();

        try {
            $product = new Product();
            $product->name = $data['name'];
            $product->description = $data['description'] ?? null;
            $product->price = $data['price'];
            $product->stock = $data['stock'];
            $product->save();

            DB::commit();

            return $product;
        } catch (\Throwable $th) {
            DB::rollBack();

            Log::error('Product creation failed', [
                'error' => $th->getMessage(),
                'trace' => $th->getTraceAsString(),
                'data'  => $data,
            ]);

            throw $th; // rethrow to controller
        }
    }
     //save product

    /**
     * Update an existing product
     */
    public function update(Product $product, array $data): Product
    {
        DB::beginTransaction();

        try {
            $product->name = $data['name'];
            $product->description = $data['description'] ?? null;
            $product->price = $data['price'];
            $product->stock = $data['stock'];
            $product->save();

            DB::commit();

            return $product;
        } catch (\Throwable $th) {
            DB::rollBack();

            Log::error('Failed to update product', [
                'product_id' => $product->id,
                'error'      => $th->getMessage(),
                'trace'      => $th->getTraceAsString(),
                'data'       => $data,
            ]);

            throw $th;
        }
    }
}
