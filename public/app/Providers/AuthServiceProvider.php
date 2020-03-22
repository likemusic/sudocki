<?php

namespace App\Providers;

use App\Contracts\AbilityInterface;
use App\User;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @param GateContract $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies();

        $gate->define(AbilityInterface::BROWSE_PRODUCTS_PRICES, function (User $user) {
            return $user->hasPermission(AbilityInterface::BROWSE_PRODUCTS_PRICES);
        });
    }
}
