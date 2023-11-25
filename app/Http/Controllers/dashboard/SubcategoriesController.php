<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\Category;


class SubcategoriesController extends Controller
{
    public function index()
    {
        $data = SubCategory::all();
        return view('dashboard.sub-category.index', compact('data'));
    }

    public function createshow()
    {
        $category = Category::all();
        return view('dashboard.sub-category.create', compact('category'));
    }
    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
        ]);
        SubCategory::create($request->all());
        return redirect()->route('showCreatepageSubcategories')
            ->with('success', 'Post created successfully.');
    }
    public function editshow($id)
    {
        $channel = SubCategory::find($id);
        $category = Category::all();
        return view('dashboard.sub-category.edit', compact('category', 'channel'));
    }
    public function edit(Request $request, $id)
    {
        $channel = SubCategory::find($id);
        $request->validate([
            'name' => 'required|max:255',
        ]);
        $channel->update($request->all());

        return redirect()->route('showSubcategories')
            ->with('success', 'Post created successfully.');
    }
    public function delete($id)
    {
        $channel = SubCategory::find($id);
        $channel->delete();
        return redirect()->route('showSubcategories')
            ->with('success', 'Post created successfully.');
    }
}