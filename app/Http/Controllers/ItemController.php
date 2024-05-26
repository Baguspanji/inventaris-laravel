<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $limit = $request->limit ?? 10;

        $items =  Item::query()->when($request->search, function ($query, $search) {
            $query->where('name', 'like', '%' . $search . '%');
            // ->OrWhere('content', 'like', '%' . $search . '%');
        })->paginate($limit);

        return Inertia::render(
            'Items/Index',
            [
                'items' => $items,
                'filters' => ['search' => $request->search]
            ]
        );
    }

    public function create()
    {
        return Inertia::render('Items/Create');
    }

    public function store(StoreItemRequest $request)
    {
        $validated = $request->validated();

        try {
            Item::create($validated);

            return redirect()->route('item.index');
        } catch (\Throwable $th) {
            Log::error($th);
            return redirect()->back()->with('error', 'Failed to create item');
        }
    }

    public function show(Item $item)
    {
        return Inertia::render('Items/Show', ['item' => $item]);
    }

    public function edit(Item $item)
    {
        return Inertia::render('Items/Edit', ['item' => $item]);
    }

    public function update(UpdateItemRequest $request, Item $item)
    {
        $validated = $request->validated();

        try {
            $item->update($validated);

            return redirect()->route('item.index');
        } catch (\Throwable $th) {
            Log::error($th);
            return redirect()->back()->with('error', 'Failed to update item');
        }
    }

    public function destroy(Item $item)
    {
        try {
            $item->delete();

            return redirect()->route('item.index');
        } catch (\Throwable $th) {
            Log::error($th);
            return redirect()->back()->with('error', 'Failed to delete item');
        }
    }
}
