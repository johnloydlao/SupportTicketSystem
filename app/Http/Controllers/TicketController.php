<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\File;
use App\Models\Label;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TicketController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        return view('tickets.index', [
            'tickets' => $user->tickets()
                ->with('categories')
                ->latest()
                ->filter(request(['search', 'status', 'priority', 'category']))
                ->paginate(6)
                ->withQueryString(),
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
            'files.*' => 'mimes:jpg,jpeg,png,webp,pdf',
            'labels' => 'required|array',
            'categories' => 'required|array',
            'priority' => 'required'
        ]);

        $labelNames = $request->labels;
        $labelIds = Label::whereIn('name', $labelNames)->pluck('id')->toArray();

        $categoryNames = $request->categories;
        $categoryIds = Category::whereIn('name', $categoryNames)->pluck('id')->toArray();

        $ticket = Ticket::create([
            'user_id' => auth()->id(),
            'assigned_user_agent' => 2,
            'title' => $request->title,
            'description' => $request->description,
            'priority' => $request->priority,
            'status' => 'Open'
        ]);
        $ticket->categories()->attach($categoryIds);
        $ticket->labels()->attach($labelIds);

        $filesData = [];
        if ($files = $request->file('files')) {
            foreach ($files as $file) {
                $fileSize = $file->getSize();

                $extension = $file->getClientOriginalExtension();
                $filename =  auth()->id() . '-' . $file->getClientOriginalName(); // Use original filename

                $path = "storage/files/";
                $file->move($path, $filename);

                $filesData[] = [
                    'ticket_id' => $ticket->id,
                    'path' => $path,
                    'name' => $filename,
                    'size' => $fileSize,
                    'type' => $extension,
                ];
            }
        }

        File::insert($filesData);

        return redirect('/tickets');
    }

    public function show(Ticket $ticket)
    {

        if ($ticket->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        return view('tickets.show', [
            'ticket' => $ticket,
        ]);
    }
}
