<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    
    //1.Get all products along with their product line description
    public function getProductsWithProductLine(){

        $products = Product::join('productlines', 'products.productLine', '=', 'productlines.productLine')
        ->select('products.*', 'productlines.textDescription as productLineDescription')
        ->paginate(10);

        return response()->json($products);
    }

    //7.Retrieve the list of all products in stock:

    public function getProductsInStock(){

        $productsInStock = Product::where('quantityInStock', '>', 0)
        ->pluck('productName');
        // ->paginate(10);
        return response()->json($productsInStock);
    }

    //11.Retrieve all products that belong to a specific product line:

        public function getProductLineProduct($productLine){

            $productLineProduct = Product::where('productLine', $productLine)->get();
            // ->paginate(10);
            return response()->json($productLineProduct);
        }
}
