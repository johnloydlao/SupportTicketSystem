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

        return view('tickets.index', [
            'tickets' => Ticket::with('categories')->latest()->filter(request(['search', 'status', 'priority', 'category']))->paginate(6)->withQueryString(),
            'categories' => Category::all(),
            'currentStatus' => request('status'),
            'currentPriority' => request('priority'),
            'currentCategory' => Category::firstWhere('name', request('category')),
        ]);
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

    public function show(Ticket $ticket)
    {
        return view('tickets.show', [
            'ticket' => $ticket
        ]);
    }
}
