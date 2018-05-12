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

class Lessons extends Section implements Initializable
{
    protected $checkAccess = false;

    protected $title = 'Уроки';

    protected $alias;

    public function initialize()
    {
        $this->addToNavigation($priority = 1, function() {
            return \App\Lesson::count();
        });
    }

    public function onDisplay()
    {
        $display = AdminDisplay::table()->setColumns([
            AdminColumn::link('name')->setLabel('Заголовок')->setWidth('400px'),
            AdminColumn::text('level.name')->setLabel('Уровень'),
            AdminColumn::text('count(days.id)')->setLabel('Кол. ДЗ'),
            AdminColumnEditable::checkbox('is_available')->setLabel('Активен/Неактивен'),
        ]);
        $display->paginate(15);
        return $display;
    }

    public function onEdit($id)
    {
        $edit = AdminForm::panel()->addBody([
            AdminFormElement::text('name', 'Заголовок')->required(),
            AdminFormElement::select('level_id', 'Уровень', \App\Level::pluck('id', 'name')->all())->required(),
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
