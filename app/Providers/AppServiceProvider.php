<?php

namespace App\Providers;

use App\Repositories\Interfaces\IVoteCastRepository;
use App\Repositories\Interfaces\IVoteRepository;
use App\Repositories\VoteCastRepository;
use App\Repositories\VoteRepository;
use App\Services\Interfaces\IVoteService;
use App\Services\VoteService;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public $bindings = [
        IVoteRepository::class => VoteRepository::class,
        IVoteCastRepository::class => VoteCastRepository::class,
        IVoteService::class => VoteService::class
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
        Blade::directive('mood', function ($mood) {
            $mood = round($mood);
            $moodsEmoticons = [0 => ':-(', 1 => ':-|', 2 => ':-)'];
            return $moodsEmoticons[$mood] ?? '';
        });
    }
}
