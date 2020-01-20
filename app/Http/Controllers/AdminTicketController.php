<?php

namespace App\Http\Controllers;

use App\Tickets;
use Illuminate\Http\Request;

use App\Http\Requests;

class AdminTicketController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function Index()
    {
        $data = [
            'tickets' => Tickets::whereNull('deleted_at')->orderBy('created_at', 'desc')->get()
        ];
        return view('admin.ticket.index')->with($data);
    }
}
