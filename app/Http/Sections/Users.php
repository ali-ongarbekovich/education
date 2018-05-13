<?php

namespace App\Http\Sections;

use AdminColumn;
use AdminColumnEditable;
use AdminDisplay;
use AdminForm;
use AdminFormElement;
use SleepingOwl\Admin\Contracts\DisplayInterface;
use SleepingOwl\Admin\Contracts\FormInterface;
use SleepingOwl\Admin\Contracts\Initializable;
use SleepingOwl\Admin\Section;

class Users extends Section implements Initializable
{
    protected $checkAccess = false;

    protected $title = 'Пользователи';

    protected $alias;

    protected $icon = 'fa fa-user';

    public function initialize()
    {
        $this->addToNavigation($priority = 4, function() {
            return \App\User::count();
        });
    }

    public function onDisplay()
    {
        $display = AdminDisplay::table()->setColumns([
            AdminColumn::link('name')->setLabel('Имя  пользователя')->setWidth('400px'),
            AdminColumn::text('email')->setLabel('Email  пользователя')->setWidth('400px')
        ]);
        $display->paginate(15);
        return $display;
    }

    public function onEdit($id)
    {
        $edit = AdminForm::panel()->addBody([
            AdminFormElement::text('name', 'Имя  пользователя')->required()
        ]);
        return $edit;
    }

    public function onCreate()
    {
        return $this->onEdit(null);
    }

    public function onDelete($id)
    {
        // remove if unused
    }

    public function onRestore($id)
    {
        // remove if unused
    }
}
