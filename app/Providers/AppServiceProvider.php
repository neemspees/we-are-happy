<?php

namespace App\Providers;

use App\Repositories\Interfaces\IVoteCastRepository;
use App\Repositories\Interfaces\IVoteRepository;
use App\Repositories\VoteCastRepository;
use App\Repositories\VoteRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public $bindings = [
        IVoteRepository::class => VoteRepository::class,
        IVoteCastRepository::class => VoteCastRepository::class
    ];

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
