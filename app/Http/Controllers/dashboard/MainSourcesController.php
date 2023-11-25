<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\mainSource;
use Illuminate\Http\Request;

class MainSourcesController extends Controller
{
    public function index()
    {
        $data = mainSource::all();
        return view('dashboard.m-sources.index', compact('data'));
    }

    public function createshow()
    {
        return view('dashboard.m-sources.create');
    }
    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
        ]);
        mainSource::create($request->all());
        return redirect()->route('showCreatepagemainSources')
            ->with('success', 'Post created successfully.');
    }
    public function editshow($id)
    {
        $channel = mainSource::find($id);
        return view('dashboard.m-sources.edit', compact('channel'));
    }
    public function edit(Request $request, $id)
    {
        $channel = mainSource::find($id);
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
        ]);
        $channel->update($request->all());

        return redirect()->route('showmainSources')
            ->with('success', 'Post created successfully.');
    }
    public function delete($id)
    {
        $channel = mainSource::find($id);
        $channel->delete();
        return redirect()->route('showmainSources')
            ->with('success', 'Post created successfully.');
    }
}
