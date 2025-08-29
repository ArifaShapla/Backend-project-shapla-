<?php

namespace App\Http\Controllers;

use App\Models\GroceryItem;
use Illuminate\Http\Request;

class GroceryItemController extends Controller
{
    public function index()
    {
        $today = now()->format('Y-m-d');
        $availableDates = GroceryItem::select('date_logged')
            ->distinct()
            ->orderBy('date_logged', 'desc')
            ->pluck('date_logged');
            
        $selectedDate = request('selected_date', $today);
        $groceryItems = GroceryItem::where('date_logged', $selectedDate)->get();

        return view('grocery_items.index', compact('groceryItems', 'availableDates', 'selectedDate'));
    }

    public function create()
    {
        $defaultDate = now()->format('Y-m-d');
        return view('grocery_items.create', compact('defaultDate'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'item_name' => 'required',
            'unit' => 'required',
            'price' => 'required|numeric|min:0',
            'date_logged' => 'required|date'
        ]);

        GroceryItem::create($request->all());

        return redirect()->route('grocery-items.index')
            ->with('success', 'Grocery item logged successfully.');
    }

    public function show(GroceryItem $groceryItem)
    {
        return view('grocery_items.show', compact('groceryItem'));
    }

    public function edit(GroceryItem $groceryItem)
    {
        return view('grocery_items.edit', compact('groceryItem'));
    }

    public function update(Request $request, GroceryItem $groceryItem)
    {
        $request->validate([
            'item_name' => 'required',
            'unit' => 'required',
            'price' => 'required|numeric|min:0',
            'date_logged' => 'required|date'
        ]);

        $groceryItem->update($request->all());

        return redirect()->route('grocery-items.index')
            ->with('success', 'Grocery item updated successfully');
    }

    public function destroy(GroceryItem $groceryItem)
    {
        $groceryItem->delete();

        return redirect()->route('grocery-items.index')
            ->with('success', 'Grocery item deleted successfully');
    }
}