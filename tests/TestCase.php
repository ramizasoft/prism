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
