<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }

    // Add methods for other dashboard pages (e.g., users, posts)
    public function users()
    {
        return view('dashboard.users');
    }

    public function posts()
    {
        return view('dashboard.posts');
    }

    public function createPost()
    {
        return view('dashboard.posts.create');
    }

    
}