<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
//        'App\Events\SendMailFromContactEvent' => [
//            'App\Listeners\SendMailFromContactEventListener',
//        ],
//        'Illuminate\Mail\Events\MessageSending' => [
//            'App\Listeners\LogSentMessage',
//        ],
        'App\Events\CreateProvocation' => [
            'App\Listeners\CreateProvocationListener',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

//        Log::listen(function($level, $message, $context)
//        {
//            Mail::raw($message, function ($message) {
////            $message->to(config('app.admin_email'));
//            });
//        });
    }
}
