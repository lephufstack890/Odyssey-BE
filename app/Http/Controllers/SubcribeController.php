<?php

namespace App\Http\Controllers;

use App\Mail\SubcribeMail;
use App\Models\Subcribe;
use App\Models\Subscribe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class SubcribeController extends Controller
{
    public function index(Request $request)
    {
        $emailList = ["odysseycompanyvn@gmail.com", "Qkhanh2006@gmail.com"];

        $contact = Subscribe::create([
            'email' => $request->input('email'),
        ]);
        foreach ($emailList as $email) {
            Mail::to($email)->send(new SubcribeMail(
                $contact->email
            ));
        }
        return response()->json([
            'code' => 200,
            'message' => "Gửi subcribe thành công!"
        ]);
    }

    public function list()
    {
        if (Auth::check()) {
            $list = Subscribe::all();
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
            $subscribe = Subscribe::find($id);
            if (!$subscribe) {
                return response()->json(['message' => 'Subscribe not found'], 404);
            }

            // Delete the Subscribe
            $subscribe->delete();

            return response()->json(['message' => 'Subscribe deleted successfully'], 200);
        }

        // If not authenticated, return unauthorized response
        return response()->json(['message' => 'Unauthorized'], 401);
    }
}
