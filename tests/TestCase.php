<?php

declare(strict_types=1);

namespace Tests;

use Illuminate\Validation\Factory as ValidationFactory;
use Illuminate\Support\Facades\Validator as ValidatorFacade;
use LaravelZero\Framework\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        if (! $this->app->bound('config')) {
            $this->app->instance('config', new \Illuminate\Config\Repository());
        }
        
        // Configure Spatie Data
        $this->app['config']->set('data.validation_strategy', \Spatie\LaravelData\Support\Creation\ValidationStrategy::Always->value);
        $this->app['config']->set('data.date_format', DATE_ATOM);

        // Register Spatie Data Service Provider
        if (class_exists(\Spatie\LaravelData\LaravelDataServiceProvider::class)) {
            $this->app->register(\Spatie\LaravelData\LaravelDataServiceProvider::class);
        }

        $loader = new \Illuminate\Translation\ArrayLoader();
        $translator = new \Illuminate\Translation\Translator($loader, 'en');
        $this->app->instance('translation.loader', $loader);
        $this->app->instance('translator', $translator);

        $factory = new class($this->app['translator'], $this->app) extends ValidationFactory {
            public function flushState(): static
            {
                $this->verifier = null;

                return $this;
            }
        };

        $this->app->instance('validator', $factory);
        ValidatorFacade::swap($factory);
    }
}
