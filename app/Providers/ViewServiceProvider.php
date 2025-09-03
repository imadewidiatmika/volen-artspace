<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Registration;
use Illuminate\Support\Facades\View;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
         View::composer('components.aside', function ($view) {
            
            // Hitung jumlah registrasi yang masuk hari ini
            $newRegistrationCount = Registration::whereDate('created_at', today())->count();

            // Kirim variabel '$newRegistrationCount' ke view 'components.aside'
            $view->with('newRegistrationCount', $newRegistrationCount);
        });
    }
}
