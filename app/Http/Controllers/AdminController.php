<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContentPage;

class AdminController extends Controller
{
    public function index()
    {
        $pages = ContentPage::all();
        return view('admin.index', compact('pages'));
    }
    
    public function create()
    {
        return view('admin.create');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'slug' => 'required|string|unique:content_pages|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'instructions' => 'required|string',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        
        $page = ContentPage::create($request->only(['slug', 'title', 'description', 'instructions']));
        
        // Handle image uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $page->addMedia($image)->toMediaCollection('images');
            }
        }
        
        return redirect()->route('admin.index')->with('success', 'Page created successfully!');
    }
    
    public function edit(ContentPage $page)
    {
        return view('admin.edit', compact('page'));
    }
    
    public function update(Request $request, ContentPage $page)
    {
        $request->validate([
            'slug' => 'required|string|max:255|unique:content_pages,slug,' . $page->id,
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'instructions' => 'required|string',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        
        $page->update($request->only(['slug', 'title', 'description', 'instructions']));
        
        // Handle new image uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $page->addMedia($image)->toMediaCollection('images');
            }
        }
        
        return redirect()->route('admin.index')->with('success', 'Page updated successfully!');
    }
    
    public function destroy(ContentPage $page)
    {
        $page->delete();
        return redirect()->route('admin.index')->with('success', 'Page deleted successfully!');
    }
    
    public function removeImage(Request $request, ContentPage $page)
    {
        $mediaId = $request->input('media_id');
        $media = $page->getMedia('images')->where('id', $mediaId)->first();
        
        if ($media) {
            $media->delete();
        }
        
        return response()->json(['success' => true]);
    }
}
