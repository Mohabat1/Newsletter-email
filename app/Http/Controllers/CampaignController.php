<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Campaign;
use App\Notifications\CampaignNotification;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class CampaignController extends Controller
{
    public function create()
    {
        return view('campaign.send');
    }

    public function send(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        // Пример: отправка письма себе
        Mail::raw($request->body, function ($message) use ($request) {
            $message->to('your@email.com') // заменишь потом на список клиентов
            ->subject($request->subject);
        });

        return redirect()->route('campaign.form')->with('success', 'Письмо отправлено!');
    }
}
