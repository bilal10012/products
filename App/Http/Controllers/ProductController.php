<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Model\Product;
use App\Model\Category;
use App\Model\ProductVarient;
use App\Model\ProductVarientValues;
use App\Model\Option;

class ProductController extends Controller
{
    //
    public function store()
    {
        $categories = Category::all();
        return view("products", compact("categories"));
    }
    public function create(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'category_ids' => 'required|array',
            'category_ids.*' => 'exists:categories,id',
        ]);

        $product = new Product();
        $product->name = $validated['name'];
        $product->price = $validated['price'];

        $product->save();

        $product->categories()->attach($validated['category_ids']);

        return redirect()->route('products')->with('success', 'Product added successfully!');
    }
    public function show()
    {
        $products = Product::with('categories', 'options')->get();
        return view('showproducts', compact('products'));
    }
    public function manage($id)
    {
        $product = Product::findOrFail($id);
        $variants = ProductVarient::where('product_id', $id)->get();

        return view('manage', compact('product', 'variants'));
    }


    public function storeVariants(Request $request)
    {
        $validated = $request->validate([
            'name.*' => 'required|string|max:255',
            'product_id' => 'required|exists:products,id'
        ]);

        $productId = $validated['product_id']; 

        foreach ($validated['name'] as $variantName) {
            $variant = new ProductVarient();
            $variant->product_id = $productId;
            $variant->attribute = $variantName;
            $variant->save();
        }

        return redirect()->route('showproducts')->with('success', 'Variants added successfully!');
    }
    public function managevalues(Request $request, $id)
    {
        $products = Product::find($id);
        $variants = ProductVarient::where('product_id', $id)->with('products')->get();


        return view('managevalues', compact('products', 'variants'));
    }
    public function manageattributevalues(Request $request, $id)
    {
        $products = Product::find($id);
        $variants = ProductVarient::where('product_id', $id)->with('products')->get();

        return view('addvalues', compact('products', 'variants'));



    }




    public function submitForm(Request $request)
    {
        $validatedData = $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'variants' => 'required|array',
            'variants.*.value' => 'required|string|max:255',
            'stock' => 'required|integer|min:0',
        ]);

        $variantIds = [];
        foreach ($validatedData['variants'] as $variantId => $variantData) {
            $variantValue = ProductVarientValues::firstOrCreate(
                ['varient_id' => $variantId, 'value' => $variantData['value']]
            );

            $variantIds[] = $variantData['value'];
        }

        Option::create([
            'product_id' => $validatedData['product_id'],
            'variant_id' => json_encode($variantIds), 
            'stock' => $validatedData['stock'],
        ]);

        return redirect()->route('showproducts')->with('success', 'Variant values and options added successfully!');
    }

    public function showOptions($productId)
    {
        $product = Product::findOrFail($productId);
        $productvariant=ProductVarient::where('product_id', $productId)->get();
    
        $options = Option::where('product_id', $productId)->get();
    
        $options->transform(function ($option) {
            $option->variant_values = json_decode($option->variant_id, true);
            return $option;
        });
    
        return view('options', compact('product', 'options','productvariant'));
    }
    
    







}