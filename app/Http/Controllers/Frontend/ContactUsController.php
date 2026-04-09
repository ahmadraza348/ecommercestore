<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\UserContactRequest;
use App\Models\UserContact;
use App\Mail\UserContactMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
class ContactUsController extends Controller
{
    public function index()
    {
        return view('frontend.contact');
    }
public function submit(UserContactRequest $contactRequest)
{
    $validatedData = $contactRequest->validated();
    $userContact = UserContact::create($validatedData);  

    if ($userContact) {
        Mail::to($userContact->email)->send(new UserContactMail($userContact->name));     
        Log::info('Contact message logged for: ' . $userContact->email);
    }
    toastr()->success('Thank you for contacting us!');
    return redirect()->back();
}
}
 