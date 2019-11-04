<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Hqtest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use DB;

class EmergencyCallReceived extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('sulithil@gmail.com');
    }
}

class HqtestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query=trim($request->get('searchText'));
        if($request)
        {
            $query=trim($request->get('searchText'));
            
            $messages=DB::table('messages')
            ->select('idmessage', 'subject', 'message')
            ->where('subject','LIKE','%'.$query.'%')
            ->orderBy('idmessage','desc')
            ->paginate(5);

            return view('hqtest.index', ['messages' => $messages, "searchText"=>$query]);
        }
        else
        {
            $messages = Hqtest::orderBy('idmessage', 'DESC')->paginate(5);

            return view('hqtest.index', ['messages' => $messages, "searchText"=>$query]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('hqtest.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'subject' => 'max:32|required',
            'message' => 'max:65535|required'
        ]);

        $message = new Hqtest($request->all());
        $message->save();
        
        $msg['message'] = 'A message has been registered ';
        
        Mail::send('hqtest.emailreg', $msg, function($message) {
 
            $message->to('sulithil@gmail.com', 'HQTest')
 
                    ->subject('Message log in the application');
        });

        flash('Message has been added!')->success()->important();

        return redirect()->route('hqtest.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $message = Hqtest::find($id);
        return view('hqtest.edit', ['message' => $message]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $message = Hqtest::find($id);
        $message->fill($request->all());
        $message->save();

        $msg['message'] = 'A message has been updated ';
        
        Mail::send('hqtest.emailup', $msg, function($message) {
 
            $message->to('sulithil@gmail.com', 'HQTest')
 
                    ->subject('Message update in the application');
        });

        flash("The message was modified!")->warning()->important();

        return redirect()->route('hqtest.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $message = Hqtest::find($id);
        $message->delete();

        flash("The message was deleted!")->error()->important();

        return redirect()->Route('hqtest.index');
    }
}
