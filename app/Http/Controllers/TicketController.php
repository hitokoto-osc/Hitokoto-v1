<?php

namespace App\Http\Controllers;

use App\TicketReply;
use App\Tickets;
use Auth;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Input;

class TicketController extends Controller
{
    public $user;

    public function __construct ()
    {
        $this->middleware('auth');
        $this->user = Auth::user();
    }

    public function index()
    {
        $data = [
            'tickets' => Tickets::where('uid', $this->user->id)->whereNull('deleted_at')->orderBy('updated_at', 'desc')->get()
        ];
        return view('ticket.index')->with($data);
    }

    public function show($id)
    {
        if(!$this->user->is_admin) {
            $ticket = Tickets::where(['uid' => $this->user->id, 'id'=> $id])->first();
        }else{
            $ticket = Tickets::where(['id'=> $id])->first();
        }
        $data = [
            'ticket' => $ticket
        ];

        return view('ticket.show')->with($data);
    }

    public function deleteTicket ($id)
    {
        $ret = Tickets::find($id)->delete();
        if($ret) {
            echo json_encode(['status' => 'y', 'msg' => '删除成功']);
            return;
        }
        echo json_encode(['status' => 'n', 'msg' => '删除失败']);
    }

    public function closeTicket ($id)
    {
        $ret = Tickets::where('id', $id)->update(['status' => 2]);
        if($ret) {
            echo json_encode(['status' => 'y', 'msg' => '关闭成功']);
            return;
        }
        echo json_encode(['status' => 'n', 'msg' => '关闭失败']);
    }

    public function addReply ($id)
    {
        $content = Input::get('replycontent');
        $attachments = Input::get('attachment');
        if(!$content) return redirect()->back();
        $attach = [];
        if($attachments) {
            foreach ($attachments as $key => $attachment) {
                $attach[$key]['name'] = 'ticket_' . $id . '_' . ($key+1);
                $attach[$key]['date'] = date('Y-m-d H:i:s');
                $attach[$key]['url'] = $attachment;
            }
        }

        $ret = TicketReply::create([
            'belong_to' => (int)$id,
            'uid' => $this->user->id,
            'content' => $content,
            'attachment' => empty($attach) ? null : json_encode($attach),
            'reply_time' => date('Y-m-d H:i:s')
        ]);
        if($ret) {
            Tickets::where('id', $id)->update([
                'last_update' => Carbon::now(),
                'status' => $this->user->is_admin ? 3 : 1
            ]);
            return redirect()->back();
        }else{
            return redirect()->back();
        }
    }

    public function store()
    {
        $title       = Input::get('title');
        $content     = Input::get('content');
        $attachments = Input::get('attachment');
        if(!$title || !$content) return redirect()->back();

        if($attachments) {
            foreach ($attachments as $key => $attachment) {
                $attach[$key]['name'] = 'ticket_' . '_' . ($key + 1);
                $attach[$key]['date'] = date('Y-m-d H:i:s');
                $attach[$key]['url']  = $attachment;
            }
        }
        $ret = Tickets::create([
            'uid'         => $this->user->id,
            'title'       => $title,
            'content'     => $content,
            'attachment'  => empty($attach) ? null : json_encode($attach),
            'open_time'   => date('Y-m-d H:i:s'),
            'last_update' => date('Y-m-d H:i:s')
        ]);
        if($ret) {
            return redirect(url('tickets'));
        }else{
            return redirect()->back();
        }
    }

    public function create ()
    {
        return view('ticket.create');
    }
}
