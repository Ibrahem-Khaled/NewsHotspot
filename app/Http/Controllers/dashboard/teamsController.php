<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Models\Teams;


class teamsController extends Controller
{
    public function index()
    {
        $data = Teams::all();
        return view('dashboard.teams.index', compact('data'));
    }

    public function createshow()
    {
        $category = SubCategory::all();
        return view('dashboard.teams.create', compact('category'));
    }
    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
        ]);
        Teams::create($request->all());
        return redirect()->route('showCreatepageteams')
            ->with('success', 'Post created successfully.');
    }
    public function editshow($id)
    {
        $channel = Teams::find($id);
        $category = SubCategory::all();
        return view('dashboard.teams.edit', compact('category', 'channel'));
    }
    public function edit(Request $request, $id)
    {
        $channel = Teams::find($id);
        $request->validate([
            'name' => 'required|max:255',
        ]);
        $channel->update($request->all());

        return redirect()->route('showTeams')
            ->with('success', 'Post created successfully.');
    }
    public function delete($id)
    {
        $channel = Teams::find($id);
        $channel->delete();
        return redirect()->route('showTeams')
            ->with('success', 'Post created successfully.');
    }
}
