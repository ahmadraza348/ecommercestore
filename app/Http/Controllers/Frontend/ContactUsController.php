<?php

namespace App\Http\Controllers\Frontend;

use App\Events\AdminNotificationEvent;
use App\Events\NewsletterSubmit;
use App\Events\UserContactSubmitted;
use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\UserContactRequest;
use App\Models\Newsletter;
use App\Models\UserContact;
use Illuminate\Http\Request;

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
            event(new UserContactSubmitted($userContact));
        }
        toastr()->success('Thank you for contacting us!');

        return redirect()->back();
    }

    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:newsletters,email',
        ]);

        $newsletter = Newsletter::create([
            'email' => $request->email,
            'name' => $request->name ?? null,
        ]);

        if ($newsletter) {
             event(new NewsletterSubmit($newsletter));          
        }

        toastr()->success('Thank you for subscribing!');

        return redirect()->back();
    }
}
