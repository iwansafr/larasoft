<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $role = [1, 2, 3];
        $AdminMenu =
            [
                [
                    'title' => 'Dashboard',
                    'link' => '/admin',
                    'icon' => 'fa-tachometer-alt',
                    'role' => $role
                ],
                [
                    'title' => 'User',
                    'link' => '#',
                    'icon' => 'fa-user',
                    'role' => [1],
                    'child' => [
                        [
                            'title' => 'User List',
                            'link' => '/admin/user',
                            'icon' => 'fa-circle',
                            'role' => [1],
                        ],
                        [
                            'title' => 'Add User',
                            'link' => '/admin/user/create',
                            'icon' => 'fa-circle',
                            'role' => [1],
                        ]
                    ],
                ],
                [
                    'title' => 'Category',
                    'link' => '#',
                    'icon' => 'fa-user',
                    'role' => $role,
                    'child' => [
                        [
                            'title' => 'Category List',
                            'link' => '/admin/category',
                            'icon' => 'fa-circle',
                            'role' => $role,
                        ],
                        [
                            'title' => 'Add Category',
                            'link' => '/admin/category/create',
                            'icon' => 'fa-circle',
                            'role' => $role,
                        ]
                    ],
                ]
            ];
        view()->share('AdminMenu', $AdminMenu);
    }
}
