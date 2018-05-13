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

class Levels extends Section implements Initializable
{
    protected $checkAccess = false;

    protected $title = 'Уровни';

    protected $alias;

    protected $icon = 'fa fa-graduation-cap';

    public function initialize()
    {
        $this->addToNavigation($priority = 3, function() {
            return \App\Level::count();
        });
    }

    public function onDisplay()
    {
        $display = AdminDisplay::table()->setColumns([
            AdminColumnEditable::text('name')->setLabel('Заголовок')->setWidth('400px'),
            AdminColumn::text('count(lesson.id)')->setLabel('Кол. Уроков'),
            AdminColumnEditable::checkbox('is_available')->setLabel('Активен/Неактивен'),
        ]);
        $display->paginate(15);
        return $display;
    }

    public function onEdit($id)
    {
        $edit = AdminForm::panel()->addBody([
            AdminFormElement::text('name', 'Заголовок')->required(),
            AdminFormElement::select('is_available', 'Активен/Неактивен', [1 => 'Активен', 0 => 'Неактивен'])->required()
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
