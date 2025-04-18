<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\BannerAdvertisement;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    //
    public function index(){
        $categories = Category::all();

        $posts = Post::with(['category'])
        ->where('is_featured', 'not_featured')
        ->latest()
        ->take(3)
        ->get();

        $featured_posts = Post::with(['category'])
        ->where('is_featured', 'featured')
        ->inRandomOrder()
        ->take(3)
        ->get();

        $banner_advertisements =
        BannerAdvertisement::where('is_active', 'active')
        ->where('type', 'banner')
        ->inRandomOrder()
        // ->take(1)
        ->first();

        $authors = Author::all();

        $entertainment_posts = Post::whereHas('category', function($query){
            $query->where('judul', 'Entertainment');
        })
        ->where('is_featured', 'not_featured')
        ->latest()
        ->take(3)
        ->get();

        $prestasi_posts = Post::whereHas('category', function($query){
            $query->where('judul', 'Prestasi');
        })
        ->where('is_featured', 'not_featured')
        ->latest()
        ->take(3)
        ->get();

        return view('front.index',
        compact('categories','authors', 'entertainment_posts', 'posts', 'featured_posts', 'banner_advertisements', 'prestasi_posts'));

}

    public function category(Category $category){
        $categories = Category::all();


        $banner_advertisements =
        BannerAdvertisement::where('is_active', 'active')
        ->where('type', 'banner')
        ->inRandomOrder()
        ->first();

        return view('front.category',
        compact('category', 'categories', 'banner_advertisements'));
    }

    public function author(Author $author){
        $categories = Category::all();

        $authors = Author::find($author);

        $banner_advertisements =
        BannerAdvertisement::where('is_active', 'active')
        ->where('type', 'banner')
        ->inRandomOrder()
        ->first();

        return view('front.author',
        compact('categories', 'banner_advertisements', 'authors'));
    }

}
