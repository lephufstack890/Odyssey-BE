<?php

namespace App\Http\Controllers;

use App\Mail\SendContactMail;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        $emailList = ["odysseycompanyvn@gmail.com", "Qkhanh2006@gmail.com"];
        $contact = Contact::create([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'company' => $request->input('company'),
            'phone' => $request->input('phone'),
            'job_title' => $request->input('job_title'),
            'yours_messenger' => $request->input('yours_messenger'),
        ]);
        foreach ($emailList as $email) {
            Mail::to($email)->send(new SendContactMail(
                $contact->first_name,
                $contact->last_name,
                $contact->email,
                $contact->company,
                $contact->phone,
                $contact->job_title,
                $contact->yours_messenger,
            ));
        }
        return response()->json([
            'code' => 200,
            'message' => "Gửi liên hệ thành công!"
        ]);
    }

    public function list()
    {
        if (Auth::check()) {
            $list = Contact::all();
            return response()->json([
                'code' => 200,
                'data' => $list
            ]);
        }
        // If not authenticated, return unauthorized response
        return response()->json(['message' => 'Unauthorized'], 401);
    }

    public function delete($id)
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            // Find the contact by ID
            $contact = Contact::find($id);
            if (!$contact) {
                return response()->json(['message' => 'Contact not found'], 404);
            }

            // Delete the contact
            $contact->delete();

            return response()->json(['message' => 'Contact deleted successfully'], 200);
        }

        // If not authenticated, return unauthorized response
        return response()->json(['message' => 'Unauthorized'], 401);
    }
}
