<?php

namespace App\Http\Controllers;

use App\Http\Requests\TopicRequest;
use App\Models\Category;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TopicsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    public function index(Request $request)
    {
        $topics = Topic::withOrder($request->order)->paginate();

        return view('topics.index', compact('topics'));
    }

    public function create(Topic $topic)
    {
        $categories = Category::all();

        return view('topics.create_and_edit', compact('topic', 'categories'));
    }

    public function store(TopicRequest $request, Topic $topic)
    {
        $topic->fill($request->all());
        $topic->user_id = Auth::id();

        $topic->save();

        return redirect()->route('topics.show', $topic->id)->with('message', 'Created success');
    }

    public function show(Topic $topic)
    {
        return view('topics.show', compact('topic'));
    }
}
