<?php

namespace JustBetter\StatamicPostcodeservice;

use Illuminate\Support\Facades\Http;
use JustBetter\StatamicPostcodeservice\Tags\PostcodeserviceTag;
use Statamic\Providers\AddonServiceProvider;
use JustBetter\StatamicPostcodeservice\Fieldtypes\Postcodeservice;

class ServiceProvider extends AddonServiceProvider
{
    protected $tags = [
        PostcodeserviceTag::class,
    ];

    public function register(): void
    {
        $this->registerConfig();
    }
    public function boot(): void
    {
        parent::boot();

        $this
            ->bootRoutes()
            ->bootMacros()
            ->bootPublishables()
            ->bootCustomFieldTypes();
    }

    public function registerConfig() : self
    {
        $this->mergeConfigFrom(__DIR__.'/../config/justbetter-postcodeservice.php', 'justbetter-postcodeservice');

        return $this;
    }

    public function bootPublishables() : self
    {
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'justbetter-postcodeservice');

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'justbetter-postcodeservice');

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/justbetter-postcodeservice'),
        ], 'views');

        $this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/justbetter-postcodeservice'),
        ], 'lang');

        $this->publishes([
            __DIR__.'/../config/justbetter-postcodeservice.php' => config_path('justbetter-postcodeservice.php'),
        ], 'config');

        return $this;
    }

    public function bootRoutes() : self
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/api.php');

        return $this;
    }

    public function bootMacros() : self
    {
        Http::macro('postcodeservice', function () {
            return Http::withHeaders([
                'X-ClientId' => config('justbetter-postcodeservice.client_id'),
                'X-SecureCode' => config('justbetter-postcodeservice.secure_code'),
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->baseUrl('https://api.postcodeservice.com');
        });

        return $this;
    }

    public function bootCustomFieldTypes(): self
    {
        Postcodeservice::register();

        return $this;
    }
}
