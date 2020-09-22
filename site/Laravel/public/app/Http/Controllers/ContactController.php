<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\ContactFormRequest;
class ContactController extends Controller
{
    public function create()
    {
        return view('contact');
    }
    public function store(ContactFormRequest $request)
    {
        \Mail::send('emails.contact',
            array(
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'user_message' => $request->get('message')
            ), function($message)
            {
                $message->from('contact@handwars.de');
                $message->to('contact@handwars.de', 'Admin')->subject('Handwars Feedback');
            });
        return \Redirect::route('contact')->with('message', 'Thanks for contacting us!');
    }
}