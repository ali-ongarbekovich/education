<?php

namespace App\Widgets;

use AdminTemplate;
use SleepingOwl\Admin\Widgets\Widget;

class DashboardMap extends Widget
{
    public function toHtml()
    {
        return view('admin.main');
    }
    public function template()
    {
        return AdminTemplate::getViewPath('dashboard');
    }

    public function block()
    {
        return 'block.top';
    }
}
