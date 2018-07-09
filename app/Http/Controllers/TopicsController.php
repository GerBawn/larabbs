<?php

namespace App\Http\Controllers;

use App\Topic;
use Illuminate\Http\Request;

class TopicsController extends Controller
{
    public function index()
    {
        $topics = Topic::with('user', 'category')->paginate();

        return view('topics.index', compact('topics'));
    }
}
