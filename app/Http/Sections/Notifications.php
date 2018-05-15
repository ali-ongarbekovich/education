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

class Notifications extends Section implements Initializable
{
    protected $checkAccess = false;

    protected $title = 'Уведомления';

    protected $alias;

    protected $icon = 'fa fa-bell-o';

    public function initialize()
    {
        $this->addToNavigation($priority = 5, function() {
            return \App\Notification::count();
        });
    }

    public function onDisplay()
    {
        $display = AdminDisplay::table()->setColumns([
            AdminColumn::link('title')->setLabel('Заголовок')->setWidth('400px'),
            AdminColumnEditable::select('is_read', 'Прочитан', [0 => 'Нет', 1 => 'Да'])->setWidth('400px'),
            AdminColumn::text('created_at')->setLabel('Дата')->setWidth('400px')
        ]);
        $display->paginate(15);
        return $display;
    }

    public function onEdit($id)
    {
        $edit = AdminForm::panel()->addBody([
            AdminFormElement::text('title', 'Заголовок')->required(),
            AdminFormElement::wysiwyg('description', 'Уведомление')->required(),
            AdminFormElement::select('is_read', 'Прочитан', [0 => 'Нет', 1 => 'Да'])
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
