<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormMail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function show(): View
    {
        return view('pages.contact');
    }

    public function send(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:160'],
            'phone' => ['nullable', 'string', 'max:40'],
            'service' => ['nullable', 'string', 'max:80'],
            'message' => ['required', 'string', 'max:3000'],
        ], [
            'name.required' => 'Inserisci il nome.',
            'email.required' => 'Inserisci l’email.',
            'email.email' => 'Inserisci un’email valida.',
            'message.required' => 'Inserisci un messaggio.',
        ]);

        Mail::to('hello@glcarbone.it')->send(new ContactFormMail($data));

        return back()->with('success', 'Messaggio inviato correttamente. Ti ricontatterò al più presto.');
    }
}