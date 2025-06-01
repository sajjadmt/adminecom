<?php

namespace App\Http\Controllers\User;

use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function PostContact(ContactRequest $request)
    {
        $name = $request->name;
        $email = $request->email;
        $message = $request->message;

        $result = Contact::create([
            'name' => $name,
            'email' => $email,
            'message' => $message,
        ]);

        return $result;
    }

    public function Contacts()
    {
        $contacts = Contact::orderBy('id','desc')->get();
        return view('admin.contact.all-contact', compact('contacts'));
    }

    public function ContactSearch(Request $request)
    {
        $query = $request->input('query');
        $contacts = Contact::where('name', 'LIKE', "%{$query}%")
            ->orWhere('email', 'LIKE', "%{$query}%")
            ->orWhere('message', 'LIKE', "%{$query}%")
            ->get();
        return view('admin.contact.contact-table-body', compact('contacts'));
    }

    public function ContactToggleStatus(Request $request)
    {
        $contact = Contact::findOrFail($request->id);
        $contact->status = $contact->status === 'read' ? 'unread' : 'read';
        $contact->save();
        return response()->json(['status' => $contact->status]);
    }

    public function ShowContact($id)
    {
        $contact = Contact::findOrFail($id);
        return response()->json([
            'contact' => $contact,
        ]);
    }

    public function DeleteContact($id)
    {
        $contact = Contact::findOrFail($id);
        if ($contact->status === 'unread'){
            $notification = array(
                'message' => 'Read Message And Then Delete It.',
                'alert-type' => 'error',
            );
            return redirect()->back()->with($notification);
        }
        $contact->delete();
        $notification = array(
            'message' => 'Contact Deleted Successfully.',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

}
