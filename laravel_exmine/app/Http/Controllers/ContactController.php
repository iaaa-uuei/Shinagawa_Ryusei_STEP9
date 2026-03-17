<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use Illuminate\View\View;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\StoreContactRequest;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    public function create(): View
    {
        return view('contact.create');
    }

    public function store(StoreContactRequest $request)
    {
        try{
        
            $validated = $request->validated();

            Mail::to('tanaka@example.com')->send(
                new ContactMail($validated)
            );

            return redirect()->route('contact.thanks')->with('status', '送信しました。');
        } catch(\Exception $e){
            Log::error($e);

            return redirect()
                ->back()
                ->with('error', '送信に失敗しました');
        }
    }

    public function thanks(): View
    {
        return view('contact.thanks');
    }
}
