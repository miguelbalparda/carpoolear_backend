<?php

namespace STS\Providers;

use Illuminate\Support\Facades\Event;
use STS\Listeners\Ratings\CreateRatingDeleteTrip;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        \STS\Events\User\Create::class    => [
            \STS\Listeners\User\CreateHandler::class,
        ],
        \STS\Events\User\Update::class    => [
            \STS\Listeners\User\UpdateHandler::class,
        ],
        \STS\Events\User\Reset::class     => [
            \STS\Listeners\Notification\ResetPasswordHandler::class,
        ],
        \STS\Events\Friend\Request::class => [
            \STS\Listeners\Notification\FriendRequest::class,
        ],
        \STS\Events\Friend\Accept::class => [
            \STS\Listeners\Notification\FriendAccept::class,
        ],
        \STS\Events\Friend\Reject::class => [
            \STS\Listeners\Notification\FriendReject::class,
        ],
        \STS\Events\Friend\Cancel::class => [
            \STS\Listeners\Notification\FriendCancel::class,
        ],
        \STS\Events\Trip\Create::class => [
            \STS\Listeners\DownloadStaticImage::class,
            \STS\Listeners\Subscriptions\OnNewTrip::class,
            // 'STS\Listeners\Conversation\createConversation',
        ],
        \STS\Events\Trip\Update::class => [
            \STS\Listeners\DownloadStaticImage::class,
            \STS\Listeners\Notification\UpdateTrip::class,
            \STS\Listeners\Subscriptions\OnNewTrip::class,
        ],
        \STS\Events\Trip\Delete::class => [
            CreateRatingDeleteTrip::class,
        ],
        \STS\Events\Trip\Alert\HourLeft::class => [
            \STS\Listeners\Notification\TripHourLeft::class,
        ],
        \STS\Events\Trip\Alert\RequestRemainder::class => [
            \STS\Listeners\Notification\TripRequestRemainder::class,
        ],
        \STS\Events\Trip\Alert\RequestNotAnswer::class => [
            \STS\Listeners\Notification\TripRequestNotAnswer::class,
        ],

        \STS\Events\Notification\NotificationSending::class => [
            \STS\Listeners\Notification\CanSendEmail::class,
            \STS\Listeners\Notification\PreventMessageEmail::class,
        ],
        \STS\Events\Passenger\Request::class => [
            \STS\Listeners\Notification\PassengerRequest::class,
        ],
        \STS\Events\Passenger\Cancel::class => [
            \STS\Listeners\Notification\PassengerCancel::class,
            // 'STS\Listeners\Conversation\removeUserConversation',
        ],
        \STS\Events\Passenger\Accept::class => [
            \STS\Listeners\Notification\PassengerAccept::class,
            // 'STS\Listeners\Conversation\addUserConversation',
        ],
        \STS\Events\Passenger\Reject::class => [
            \STS\Listeners\Notification\PassengerReject::class,
        ],
        \STS\Events\Rating\PendingRate::class => [
            \STS\Listeners\Notification\PendingRate::class,
        ],
        \STS\Events\MessageSend::class => [
            \STS\Listeners\Notification\MessageSend::class,
        ],
    ];

    /**
     * Register any other events for your application.
     *
     * @param \Illuminate\Contracts\Events\Dispatcher $events
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
