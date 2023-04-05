<?php

namespace App\Listeners;

use App\Enums\Detail\DetailTypeEnum;
use App\Events\UserSaved;
use App\Models\Detail;
use App\Services\UserService;

class SaveUserBackgroundInformation
{
    protected $userService;
    /**
     * Create the event listener.
     */
    public function __construct(UserService $userService)
    {
        $this->userService=$userService;
    }

    /**
     * Handle the event.
     */
    public function handle(UserSaved $event): void
    {
        $this->userService->handleSavingDetails($event->user);

    }
}
