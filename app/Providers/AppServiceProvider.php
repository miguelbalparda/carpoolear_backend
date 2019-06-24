<?php

namespace STS\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\STS\Contracts\Logic\User::class, \STS\Services\Logic\UsersManager::class);
        $this->app->bind(\STS\Contracts\Repository\User::class, \STS\Repository\UserRepository::class);

        $this->app->bind(\STS\Contracts\Logic\Devices::class, \STS\Services\Logic\DeviceManager::class);
        $this->app->bind(\STS\Contracts\Repository\Devices::class, \STS\Repository\DeviceRepository::class);

        $this->app->bind(\STS\Contracts\Repository\Friends::class, \STS\Repository\FriendsRepository::class);
        $this->app->bind(\STS\Contracts\Logic\Friends::class, \STS\Services\Logic\FriendsManager::class);

        $this->app->bind(\STS\Contracts\Repository\Files::class, \STS\Repository\FileRepository::class);

        $this->app->bind(\STS\Contracts\Repository\Social::class, \STS\Repository\SocialRepository::class);
        $this->app->bind(\STS\Contracts\Logic\Social::class, \STS\Services\Logic\SocialManager::class);

        $this->app->bind(\STS\Contracts\Repository\Conversations::class, \STS\Repository\ConversationRepository::class);
        $this->app->bind(\STS\Contracts\Repository\Messages::class, \STS\Repository\MessageRepository::class);
        $this->app->bind(\STS\Contracts\Logic\Conversation::class, \STS\Services\Logic\ConversationsManager::class);
        $this->app->bind(\STS\Contracts\Repository\Trip::class, \STS\Repository\TripRepository::class);
        $this->app->bind(\STS\Contracts\Logic\Trip::class, \STS\Services\Logic\TripsManager::class);

        $this->app->bind(\STS\Contracts\Repository\Car::class, \STS\Repository\CarsRepository::class);
        $this->app->bind(\STS\Contracts\Logic\Car::class, \STS\Services\Logic\CarsManager::class);

        $this->app->bind(\STS\Contracts\Repository\IPassengersRepository::class, \STS\Repository\PassengersRepository::class);
        $this->app->bind(\STS\Contracts\Logic\IPassengersLogic::class, \STS\Services\Logic\PassengersManager::class);

        $this->app->bind(\STS\Contracts\Repository\INotification::class, \STS\Repository\NotificationRepository::class);
        $this->app->bind(\STS\Contracts\Logic\INotification::class, \STS\Services\Logic\NotificationManager::class);

        $this->app->bind(\STS\Contracts\Repository\IRatingRepository::class, \STS\Repository\RatingRepository::class);
        $this->app->bind(\STS\Contracts\Logic\IRateLogic::class, \STS\Services\Logic\RatingManager::class);

        $this->app->bind(\STS\Contracts\Repository\Subscription::class, \STS\Repository\SubscriptionsRepository::class);
        $this->app->bind(\STS\Contracts\Logic\Subscription::class, \STS\Services\Logic\SubscriptionsManager::class);
    }
}
