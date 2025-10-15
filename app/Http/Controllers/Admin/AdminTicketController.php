<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ticket;

class AdminTicketController extends Controller
{
    public function index()
    {
        // make relation with package and user both
        $tickets = Ticket::with(['package','user'])->get();
        return view('admin.ticket.index', compact('tickets'));
    }

    public function change_status($id,$status)
    {
        $ticket = Ticket::where('id',$id)->first();
        $ticket->payment_status = $status;
        $ticket->save();
        return redirect()->back()->with('success','Status changed successfully');
    }

    public function delete($id)
    {
        $ticket = Ticket::where('id',$id)->first();
        $ticket->delete();

        return redirect()->back()->with('success','Ticket deleted successfully!');
    }

    public function invoice($id)
    {
        $ticket = Ticket::with(['package','user'])->where('id',$id)->first();
        return view('admin.ticket.invoice', compact('ticket'));
    }
}
