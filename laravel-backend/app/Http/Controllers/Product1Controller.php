<?php

namespace App\Http\Controllers;

use App\Models\Product1;
use App\Traits\ApiResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Product1Controller extends Controller
{
    use ApiResponses;

    public function index()
    {
        $products = Product1::with('category')->get();
        return response()->json($products);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
        ]);

        $product = Product1::create($validated);

        return response()->json([
            'message' => 'Product created successfully',
            'data' => $product
        ], 201);
    }

    public function show(Product1 $product1)
    {
        return response()->json($product1->load('category'));
    }

    public function update(Request $request, Product1 $product1)
    {
        $validated = $request->validate([
            'category_id' => 'sometimes|required|exists:categories,id',
            'name' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'sometimes|required|numeric|min:0',
        ]);

        $product1->update($validated);

        return response()->json([
            'message' => 'Product updated successfully',
            'data' => $product1
        ]);
    }

    public function destroy(Product1 $product1)
    {
        $product1->delete();

        return response()->json([
            'message' => 'Product deleted successfully'
        ]);
    }

    public function queries()
    {
        $queryResults = [
            'name_and_price' => Product1::select('name', 'price')->get(),
            'products_with_category' => Product1::with('category')->get(),
            'products_ordered_by_price' => Product1::select('id', 'name')->orderBy('price', 'asc')->get(),
            'first_five_products' => Product1::limit(5)->get(),
            'price_greater_than_or_equal' => Product1::where('price', '>=', 3)->get(),
            'electronics' => Product1::whereHas('category', fn ($query) => $query->where('name', 'Electronics'))->get(),
            'total_price' => Product1::sum('price'),
            'average_price' => number_format((float) Product1::avg('price'), 2, '.', ''),
            'highest_price' => Product1::max('price'),
            'lowest_price' => Product1::min('price'),
            'total_price_per_category' => $this->categoryAggregate('SUM(product1s.price)', 'total_price')->get(),
            'average_price_per_category' => $this->categoryAggregate('AVG(product1s.price)', 'avg_price')->get(),
            'lowest_price_per_category' => $this->categoryAggregate('MIN(product1s.price)', 'min_price')->get(),
            'average_price_sorted' => $this->categoryAggregate('AVG(product1s.price)', 'avg_price')->orderBy('avg_price', 'asc')->get(),
            'electronics_and_books' => $this->categoryAggregate('AVG(product1s.price)', 'avg_price')
                ->whereIn('categories.name', ['Electronics', 'Books'])->get(),
        ];

        return $this->success('Query results retrieved successfully', $queryResults);
    }

    private function categoryAggregate(string $aggregate, string $alias)
    {
        return Product1::join('categories', 'product1s.category_id', '=', 'categories.id')
            ->select('categories.name', DB::raw("{$aggregate} as {$alias}"))
            ->groupBy('categories.name');
    }
}
