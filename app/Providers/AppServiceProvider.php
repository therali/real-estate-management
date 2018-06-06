<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Laravel\Dusk\DuskServiceProvider;

class AppServiceProvider extends ServiceProvider {
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        Blade::directive( 'dateform', function ( $expression ) {
            return "<?php echo ($expression)->format('d/m/Y'); ?>";
        } );
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        if ( $this->app->environment( 'local', 'testing' ) ) {
            $this->app->register( DuskServiceProvider::class );
        }
    }
}
