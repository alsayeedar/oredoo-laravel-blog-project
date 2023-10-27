<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define("update-post", function (User $user, $post) {
            if ($user->role == User::IS_ADMIN) {
                return true;
            }
            return $user->id === $post->user_id;
        });

        Gate::define("update-comment", function (User $user, $comment) {
            if ($user->role == User::IS_ADMIN) {
                return true;
            }
            return $user->id === $comment->post->user_id;
        });

        Gate::define("update-media", function (User $user, $media) {
            if ($user->role == User::IS_ADMIN) {
                return true;
            }
            return $user->id === $media->user_id;
        });
    }
}
