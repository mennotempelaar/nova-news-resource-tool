<?php

use Bondgenoot\NovaNewsTool\Providers\NewsEventsServiceProvider;
use Bondgenoot\NovaNewsTool\Providers\NewsServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('It creates the default service provider', function () {
    $provider = new NewsServiceProvider($this->app);

    expect($provider)->toBeInstanceOf(NewsServiceProvider::class);
});

test('It creates the events service provider', function () {
    $provider = new NewsEventsServiceProvider($this->app);

    expect($provider)->toBeInstanceOf(NewsEventsServiceProvider::class);
});
