<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostContactRequest;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function PostContact(PostContactRequest $request)
    {
        date_default_timezone_set("Asia/Tehran");
        Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
            'contact_time' => date('h:i:sa'),
            'contact_date' => date('Y:m:d'),
        ]);
    }
}
