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
        // Validate the form data
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
        $product = Product::findOrFail($id); // Fetch a single product instance
        $variants = ProductVarient::where('product_id', $id)->get();

        return view('manage', compact('product', 'variants'));
    }


    public function storeVariants(Request $request)
    {
        // Validate the form data
        $validated = $request->validate([
            'name.*' => 'required|string|max:255',
            'product_id' => 'required|exists:products,id'
        ]);

        // Get the product ID (assuming it's passed in the request or session)
        $productId = $validated['product_id']; // Replace with your actual product ID retrieval logic

        // Process each variant name and store in product_variants table
        foreach ($validated['name'] as $variantName) {
            // Create a new ProductVariant instance
            $variant = new ProductVarient();
            $variant->product_id = $productId;
            $variant->attribute = $variantName;
            $variant->save();
        }

        // Redirect back or to a success page
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
            $variantValue = ProductVarientValues::create([
                'varient_id' => $variantId, // Assuming variant_id is the actual ID of the variant
                'value' => $variantData['value'],
                // If stock is stored in the ProductVariantValues table, uncomment the line below
                // 'stock' => $validatedData['stock'],
            ]);

            $variantIds[] = $variantId;
        }

        Option::create([
            'product_id' => $validatedData['product_id'],
            'variant_id' => json_encode($variantIds), // Convert array to JSON format
            'value_id' => $variantValue->id, // Assuming $variantValue is the last created ProductVariantValue instance
            'stock' => $validatedData['stock'],
        ]);

        return redirect()->route('showproducts')->with('success', 'Variant values and options added successfully!');
    }
    public function showoptions($id)
    {
        $product = Product::findOrFail($id);
    $options = $product->options()->get(['variant_id', 'value_id', 'stock']);

    // Retrieve associated variant information for each option
    foreach ($options as $option) {
        $variantIds = json_decode($option->variant_id);

        // Example assuming ProductVariantValues model and relationship exists
        $variants = ProductVarientValues::whereIn('id', $variantIds)->get();

        // Format the variants information as needed (example)
        $option->variants = $variants->pluck('value_id', 'id')->toArray();
    }

        return view('options', compact('product', 'options'));
    }






}