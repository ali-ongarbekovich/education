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

class Days extends Section implements Initializable
{
    protected $checkAccess = false;

    protected $title = 'Домашние задания';

    protected $alias;

    public function initialize()
    {
        $this->addToNavigation($priority = 0, function() {
            return \App\Day::count();
        });
    }

    public function onDisplay()
    {
        $display = AdminDisplay::table()->setColumns([
            AdminColumn::link('name')->setLabel('Заголовок')->setWidth('400px'),
            AdminColumn::text('lesson.name')->setLabel('Урок'),
            AdminColumn::text('task')->setLabel('Задача'),
            AdminColumn::text('answer')->setLabel('Ответ'),
            AdminColumnEditable::checkbox('is_available')->setLabel('Активен/Неактивен'),
        ]);
        $display->paginate(15);
        return $display;
    }

    public function onEdit($id)
    {
        $edit = AdminForm::panel()->addBody([
            AdminFormElement::text('name', 'Заголовок')->required(),
            AdminFormElement::select('lesson_id', 'Урок', \App\Lesson::pluck('id', 'name')->all())->required(),
            AdminFormElement::wysiwyg('description', 'Описание')->required(),
            AdminFormElement::text('task', 'Задача')->required(),
            AdminFormElement::text('answer', 'Ответ')->required(),
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
