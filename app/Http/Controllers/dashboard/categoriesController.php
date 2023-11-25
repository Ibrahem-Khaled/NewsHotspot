<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class categoriesController extends Controller
{
    public function index()
    {
        $data = Category::all();
        return view('dashboard.category.index', compact('data'));
    }

    public function createshow()
    {
        return view('dashboard.category.create');
    }
    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
        ]);
        Category::create($request->all());
        return redirect()->route('showCreatepagecategories')
            ->with('success', 'Post created successfully.');
    }
    public function editshow($id)
    {
        $channel = Category::find($id);
        return view('dashboard.category.edit', compact('channel'));
    }
    public function edit(Request $request, $id)
    {
        $channel = Category::find($id);
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
        ]);
        $channel->update($request->all());

        return redirect()->route('showcategories')
            ->with('success', 'Post created successfully.');
    }
    public function delete($id)
    {
        $channel = Category::find($id);
        $channel->delete();
        return redirect()->route('showcategories')
            ->with('success', 'Post created successfully.');
    }
}
