<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Flower;

class FlowerController extends Controller
{
    // Show flowers for customers
    public function index()
    {
        $roses = Flower::where('category', 'rose')->get();
        $lotus = Flower::where('category', 'lotus')->get();
        $other = Flower::where('category', 'other')->get();

        return view('flowers', compact('roses', 'lotus', 'other'));
    }

    // Show edit page for admin
    public function editMode()
    {
        $roses = Flower::where('category', 'rose')->get();
        $lotus = Flower::where('category', 'lotus')->get();
        $others = Flower::where('category', 'other')->get();

        return view('flowers.edit', compact('roses', 'lotus', 'others'));
    }

    // Add new flower
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'required|string',
            'category'    => 'required|string|in:rose,lotus,other',
            'price'       => 'required|numeric|min:0',
            'image'       => 'nullable|image|max:2048',
        ]);

        $flower = new Flower();
        $flower->name = $validated['name'];
        $flower->description = $validated['description'];
        $flower->category = $validated['category'];
        $flower->price = $validated['price'];

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);
            $flower->image = $imageName;
        }

        $flower->save();

        return redirect()->route('flowers.editMode')->with('success', 'Flower added successfully.');
    }

    // Update existing flower
    public function update(Request $request, $id)
    {
        $flower = Flower::findOrFail($id);

        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'required|string',
            'category'    => 'required|string|in:rose,lotus,other',
            'price'       => 'required|numeric|min:0',
            'image'       => 'nullable|image|max:2048',
        ]);

        $flower->name = $validated['name'];
        $flower->description = $validated['description'];
        $flower->category = $validated['category'];
        $flower->price = $validated['price'];

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($flower->image && file_exists(public_path('images/' . $flower->image))) {
                unlink(public_path('images/' . $flower->image));
            }

            // Store new image
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images/flower'), $imageName);
            $flower->image = $imageName;
        }

        $flower->save();

        return redirect()->route('flowers.editMode')->with('success', 'Flower updated successfully.');
    }

    // Delete flower
    public function destroy($id)
    {
        $flower = Flower::findOrFail($id);

        if ($flower->image && file_exists(public_path('images/' . $flower->image))) {
            unlink(public_path('images/' . $flower->image));
        }

        $flower->delete();

        return redirect()->route('flowers.editMode')->with('success', 'Flower deleted successfully.');
    }
}
