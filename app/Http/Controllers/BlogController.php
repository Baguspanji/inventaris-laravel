<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $limit = $request->limit ?? 10;

        $blogs =  Blog::query()->when($request->search, function ($query, $search) {
            $query->where('title', 'like', '%' . $search . '%');
            // ->OrWhere('content', 'like', '%' . $search . '%');
        })->paginate($limit);

        return Inertia::render(
            'Blogs/Index',
            [
                'blogs' => $blogs,
                'filters' => ['search' => $request->search]
            ]
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'content' => 'required',
        ]);
        Blog::create([
            'title' => $request->title,
            'slug' => \Str::slug($request->slug),
            'content' => $request->content
        ]);
        sleep(1);

        return redirect()->route('blogs.index')->with('message', 'Blog Created Successfully');
    }

    public function edit(Blog $blog)
    {
        return Inertia::render(
            'Blogs/Edit',
            [
                'blog' => $blog
            ]
        );
    }

    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'content' => 'required',
        ]);

        $blog->title = $request->title;
        $blog->slug = \Str::slug($request->slug);
        $blog->content = $request->content;
        $blog->save();
        sleep(1);

        return redirect()->route('blogs.index')->with('message', 'Blog Updated Successfully');
    }

    public function destroy(Blog $blog)
    {
        $blog->delete();
        sleep(1);

        return redirect()->route('blogs.index')->with('message', 'Blog Delete Successfully');
    }
}
