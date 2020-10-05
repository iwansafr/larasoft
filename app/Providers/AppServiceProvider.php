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
        $data_role = ['1' => 'Root', '2' => 'Admin', '3' => 'Member'];
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
                    'title' => 'CONTENT MANAGEMENT',
                    'role' => $role,
                    'header' => true
                ],
                [
                    'title' => 'Content',
                    'link' => '#',
                    'icon' => 'fa-edit',
                    'role' => $role,
                    'child' => [
                        [
                            'title' => 'Category',
                            'link' => '/admin/category',
                            'icon' => 'fa-circle',
                            'role' => $role,
                        ],
                        [
                            'title' => 'Add Content',
                            'link' => '/admin/content/create',
                            'icon' => 'fa-circle',
                            'role' => $role,
                        ],
                        [
                            'title' => 'Content List',
                            'link' => '/admin/content',
                            'icon' => 'fa-circle',
                            'role' => $role,
                        ],
                    ],
                ],
                [
                    'title' => 'Configuration',
                    'header' => true,
                    'role' => $role
                ],
                [
                    'title' => 'Menu',
                    'link' => '#',
                    'icon' => 'fa-list',
                    'role' => [1, 2],
                    'child' => [
                        [
                            'title' => 'Menu List',
                            'link' => '/admin/menu',
                            'icon' => 'fa-circle',
                            'role' => [1, 2],
                        ],
                        [
                            'title' => 'Add Menu',
                            'link' => '/admin/menu/create',
                            'icon' => 'fa-circle',
                            'role' => [1, 2],
                        ]
                    ],
                ],
            ];
        view()->share('AdminMenu', $AdminMenu);
        view()->share('_data_role', json_encode($data_role));
    }
}
