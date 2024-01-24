<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\mainSource;
use App\Models\source;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SourcesController extends Controller
{
    public function index()
    {
        $data = source::all();
        return view('dashboard.sources.index', compact('data'));
    }

    public function createshow()
    {
        $category = Category::all();
        $subcategory = SubCategory::all();
        $main_sources = mainSource::all();
        return view('dashboard.sources.create', compact('category', 'subcategory', 'main_sources'));
    }
    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'url' => 'required',
            'language' => 'required',
            'country' => 'required',
        ]);

        Source::create([
            'name' => $request->name,
            'url' => $request->url,
            'language' => $request->language,
            'country' => $request->country,
            'top_storis' => $request->has('top_storis'),
            'category_id' => $request->category_id,
            'main_sources_id' => $request->main_sources_id,
            'subcategory_id' => $request->subcategory_id,
        ]);

        return redirect()->route('showSources')
            ->with('success', 'created successfully.');
    }
    public function editshow($id)
    {
        $channel = source::find($id);

        $category = Category::all();
        $subcategory = SubCategory::all();
        $main_sources = mainSource::all();

        return view('dashboard.sources.edit', compact('channel', 'category', 'subcategory', 'main_sources'));
    }
    public function edit(Request $request, $id)
    {
        $channel = source::find($id);
        $request->validate([
            'name' => 'required|max:255',
            'url' => 'required',
            'language' => 'required',
            'country' => 'required',
        ]);
        $channel->update([
            'name' => $request->name,
            'url' => $request->url,
            'language' => $request->language,
            'country' => $request->country,
            'top_storis' => $request->has('top_storis'),
            'category_id' => $request->category_id,
            'main_sources_id' => $request->main_sources_id,
            'subcategory_id' => $request->subcategory_id,
        ]);
        return redirect()->route('showSources')
            ->with('success', 'Post created successfully.');
    }
    public function delete($id)
    {
        $channel = source::find($id);
        $channel->delete();
        return redirect()->route('showSources')
            ->with('success', 'Post created successfully.');
    }
}
