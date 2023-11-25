<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\LiveChannels;
use Illuminate\Http\Request;

class liveChannelsController extends Controller
{
    public function index()
    {
        $data = LiveChannels::all();
        return view('dashboard.live-channels.index', compact('data'));
    }
    public function createshow()
    {
        $category = Category::all();
        return view('dashboard.live-channels.create', compact('category'));
    }
    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'url' => 'required',
        ]);
        LiveChannels::create($request->all());
        return redirect()->route('showCreatepageLivechannles')
            ->with('success', 'Post created successfully.');
    }
    public function editshow($id)
    {
        $channel = LiveChannels::find($id);
        $category = Category::all();
        return view('dashboard.live-channels.edit', compact('category', 'channel'));
    }
    public function edit(Request $request, $id)
    {
        $channel = LiveChannels::find($id);
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'url' => 'required',
        ]);
        $channel->update($request->all());

        return redirect()->route('showLivechanels')
            ->with('success', 'Post created successfully.');
    }
    public function delete($id)
    {
        $channel = LiveChannels::find($id);
        $channel->delete();
        return redirect()->route('showLivechanels')
            ->with('success', 'Post created successfully.');
    }
}
