<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Notifications\TicketUpdatedNotification;
use App\Models\User;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $tickets = $user->isAdmin ? Ticket::latest()->get() : $user->tickets;
        return view('ticket.index',['tickets' => $tickets]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ticket.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTicketRequest $request)
    {
        $ticket = Ticket::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => $request->user()->id
        ]);

        if ($attachment = $request->file('attachment')) {
            $this->uploadAttachmet($attachment,$ticket);
        }

        return redirect(route('ticket.index'));
    }


    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        return view('ticket.show',compact('ticket'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ticket $ticket)
    {
        return view('ticket.edit',compact('ticket'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTicketRequest $request, Ticket $ticket)
    {
        $ticket->update($request->except('attachment'));
        if ($request->has('status')) {
            //$user = User::find($ticket->user_id);
            $ticket->user->notify(new TicketUpdatedNotification($ticket));            
            //return (new TicketUpdatedNotification($ticket))->toMail($user);
        }

        if ($attachment = $request->file('attachment')) {
            if(!empty($ticket->attachment)) Storage::disk('public')->delete($ticket->attachment);
            $this->uploadAttachmet($attachment,$ticket);
        }
        return redirect(route('ticket.show',$ticket->id));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        $ticket->delete();
        return redirect(route('ticket.index'));
    }

    protected function uploadAttachmet($attachment,$ticket) {
        $contents = file_get_contents($attachment);
        $fileName = $attachment->getClientOriginalName();
        $path = "upload/attachments/$fileName";
        Storage::disk('public')->put($path,$contents);
        $ticket->update(['attachment' => $path]);
    }
}