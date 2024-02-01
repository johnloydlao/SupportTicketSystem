<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Label;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    public function index()
    {
        $userTicketsWithCategories = Ticket::with('categories')
        ->where('user_id', Auth::id())
        ->get();

        return view('tickets.index', compact('userTicketsWithCategories'));
    }

    public function create()
    {
        return view("tickets.create");
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'labels' => 'required|array',
            'categories' => 'required|array',
            'priority' => 'required'
        ]);

        $labelNames = $request->labels;
        $labelIds = Label::whereIn('name', $labelNames)->pluck('id')->toArray();

        $categoryNames = $request->categories;
        $categoryIds = Category::whereIn('name', $categoryNames)->pluck('id')->toArray();

        $ticket = Ticket::create([
            'user_id' =>  auth()->id(),
            'title' => $request->title,
            'description' => $request->description,
            'priority' => $request->priority,
        ]);


        $ticket->categories()->attach($categoryIds);
        $ticket->labels()->attach($labelIds);

        return redirect('/dashboard');
    }
}
