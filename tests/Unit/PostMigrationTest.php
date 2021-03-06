<?php

use Bondgenoot\NovaNewsTool\Models\PostModel;
use Bondgenoot\NovaNewsTool\Utils\Config;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Orchestra\Testbench\Factories\UserFactory;

uses(DatabaseMigrations::class);
uses(RefreshDatabase::class);

beforeEach(function () {
    $user = (new UserFactory())->create();

    actingAs($user);
});

it('has a title')
    ->expect(fn () => PostModel::factory()->create())
    ->title->toBeString();

it('has contents')
    ->expect(fn () => PostModel::factory()->create())
    ->contents->toBeNull();

it('has an image')
    ->expect(fn () => PostModel::factory()->create())
    ->contents->toBeNull();

it('has a hidden column')
    ->expect(fn () => PostModel::factory()->create())
    ->hidden->toBeBool();

it('has a published_at date')
    ->expect(fn () => PostModel::factory()->create())
    ->published_at->toBeInstanceOf(Carbon::class);

it('has a published_till date')
    ->expect(fn () => PostModel::factory()->create())
    ->published_till->toBeInstanceOf(Carbon::class);

it('could not have a published_till date')
    ->expect(
        fn () => PostModel::factory()->create(['published_till' => null]),
    )
    ->published_till->toBeNull();

it('can have an author', function () {
    $user = (new UserFactory)->create();

    $post = PostModel::factory()->create([
        'author_id' => $user->id,
    ]);

    expect($post)->toBeInstanceOf(PostModel::class);
    expect($post->author)->toBeInstanceOf(Config::authorClassname());
});

it('has a updated_at date')
    ->expect(fn () => PostModel::factory()->create())
    ->updated_at->toBeInstanceOf(Carbon::class);

it('has a created_at date')
    ->expect(fn () => PostModel::factory()->create())
    ->created_at->toBeInstanceOf(Carbon::class);

it('has a createdBy user')
    ->expect(fn () => PostModel::factory()->create())
    ->createdBy->toBeInstanceOf(User::class);

it('has not a deleted_at date when not deleted')
    ->expect(fn () => PostModel::factory()->create())
    ->deleted_at->toBeNull();

it('has a deleted_at date when deleted')
    ->expect(
        function () {
            $post = PostModel::factory()->create();
            $post->delete();

            return $post;
        },
    )
    ->deleted_at->toBeInstanceOf(Carbon::class);
