<?php

namespace App\Providers;

use SleepingOwl\Admin\Contracts\Widgets\WidgetsRegistryInterface;
use SleepingOwl\Admin\Providers\AdminSectionsServiceProvider as ServiceProvider;

class AdminSectionsServiceProvider extends ServiceProvider
{

    /**
     * @var array
     */
    protected $widgets = [
        \App\Widgets\NavigationNotifications::class,
        \App\Widgets\NavigationUserBlock::class,
        \App\Widgets\DashboardMap::class
    ];
    protected $sections = [
        \App\User::class => 'App\Http\Sections\Users',
        \App\Day::class => 'App\Http\Sections\Days',
        \App\Lesson::class => 'App\Http\Sections\Lessons',
        \App\Level::class => 'App\Http\Sections\Levels',
        \App\Notification::class => 'App\Http\Sections\Notifications',
    ];

     public function boot(\SleepingOwl\Admin\Admin $admin)
     {
         parent::boot($admin);
         $this->app->call([$this, 'registerViews']);
     }

     public function registerViews(WidgetsRegistryInterface $widgetsRegistry)
     {
         foreach ($this->widgets as $widget) {
             $widgetsRegistry->registerWidget($widget);
         }
     }
}
