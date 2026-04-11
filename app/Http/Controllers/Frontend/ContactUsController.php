<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\UserContactRequest;
use App\Models\UserContact;
use App\Mail\UserContactMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Models\Admin;
use App\Notifications\CustomerContactNotification;
use Illuminate\Support\Facades\Notification;
use App\Events\UserContact as UserContactEvent;
use Illuminate\Support\Facades\Event;

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
        Event::dispatch(new UserContactEvent($userContact)); 
    }
    toastr()->success('Thank you for contacting us!');
    return redirect()->back();
}
}
 