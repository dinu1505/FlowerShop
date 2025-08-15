<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Arrangement;

class ArrangementController extends Controller
{
    // Show all arrangements for customers
    public function index()
    {
        $arrangements = Arrangement::all();
        return view('arrangements', compact('arrangements'));
    }

    // Show edit page for admin (all arrangements with add form)
    public function editMode()
    {
        $arrangements = Arrangement::all();
        return view('arrangements.edit', compact('arrangements'));
    }

    // Store a new arrangement
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|max:2048',
        ]);

        $arrangement = new Arrangement();
        $arrangement->name = $validated['name'];
        $arrangement->description = $validated['description'];
        $arrangement->price = $validated['price'];

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);  // save to public/images
            $arrangement->image = $imageName;                 // store filename
        }

        $arrangement->save();

        return redirect()->route('arrangements.editMode')->with('success', 'Arrangement added successfully.');
    }

    // Update an existing arrangement
    public function update(Request $request, $id)
    {
        $arrangement = Arrangement::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|max:2048',
        ]);

        $arrangement->name = $validated['name'];
        $arrangement->description = $validated['description'];
        $arrangement->price = $validated['price'];

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($arrangement->image && file_exists(public_path('images/' . $arrangement->image))) {
                unlink(public_path('images/' . $arrangement->image));
            }

            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images/arrangement'), $imageName);
            $arrangement->image = $imageName;
        }

        $arrangement->save();

        return redirect()->route('arrangements.editMode')->with('success', 'Arrangement updated successfully.');
    }

    // Delete an arrangement
    public function destroy($id)
    {
        $arrangement = Arrangement::findOrFail($id);

        // Delete image file if exists
        if ($arrangement->image && file_exists(public_path('images/' . $arrangement->image))) {
            unlink(public_path('images/' . $arrangement->image));
        }

        $arrangement->delete();

        return redirect()->route('arrangements.editMode')->with('success', 'Arrangement deleted successfully.');
    }
}
