<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

use App\Models\Appointment;
use App\Models\Review;
use App\Models\Vehicle;
use App\Models\WorkOrder;
use App\Policies\AppointmentPolicy;
use App\Policies\ReviewPolicy;
use App\Policies\VehiclePolicy;
use App\Policies\WorkOrderPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Vehicle::class => VehiclePolicy::class,
        Appointment::class => AppointmentPolicy::class,
        WorkOrder::class => WorkOrderPolicy::class,
        Review::class => ReviewPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
