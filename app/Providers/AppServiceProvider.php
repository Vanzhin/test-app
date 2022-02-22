<?php

namespace App\Providers;

use App\Contracts\Parser;
use App\Contracts\SideAuth;
use App\Http\Controllers\Admin\ParserController;
use App\Services\ParserService;
use App\Services\SideAuthService;
use App\Services\UploadService;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(Parser::class, ParserService::class);
        $this->app->bind(SideAuth::class, SideAuthService::class);
        $this->app->bind(UploadService::class);
        Schema::defaultStringLength(191);


    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
    }
}
