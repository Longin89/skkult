<?php

namespace App\Controllers;

use App\Models\Users;
use App\Models\Schedule;
use App\Models\DaysOfWeek;
use Core\Controller;
use Core\Session;
use Core\Router;

class ScheduleController extends Controller
{
    public function __construct($controller, $action)
    {
        // Здесь и далее - если залогинен админ - подсовываем админскую верстку
        parent::__construct($controller, $action);
        if (Users::$currentLoggedInUser && Users::$currentLoggedInUser->username == 'admin') {
            $this->view->setLayout('admin');
        }
    }

    public function indexAction()
    {
        // Берем инфу из таблиц дней недели и расписания
        $schedules = Schedule::find(['order' => 'day_id ASC']);
        $days = DaysOfWeek::find();

        // Передаем информацию в вид
        $this->view->schedules = $schedules;
        $this->view->days = $days;
        $this->view->render('schedule/index');
    }

    public function listAction()
    {
        // Берем инфу из таблиц дней недели и расписания
        $schedules = Schedule::find(['order' => 'day_id ASC']);
        $days = DaysOfWeek::find();

        // Передаем информацию в вид
        $this->view->schedules = $schedules;
        $this->view->days = $days;
        $this->view->render('schedule/list');
    }

    public function editAction($id)
    {
        // Находим услугу и день недели по id
        $schedule = Schedule::findById($id);
        $day = DaysOfWeek::findById($id);
        if (!$schedule) {
            // Если не находим - возвращаем ошибку
            Session::addMsg('danger', 'Запись не найдена');
            Router::redirect('schedule/list');
        }
        if ($this->request->isPost()) {
            // Если валидация прошла - сохраняем
            $this->request->csrfCheck();
            $schedule->assign($this->request->get());
            $schedule->save();
            if ($schedule->validationPassed()) {
                Session::addMsg('success', 'Расписание обновлено');
                Router::redirect('schedule/list');
            }
        }
        // Передаем информацию в вид
        $this->view->schedule = $schedule;
        $this->view->day = $day;
        $this->view->formAction = PROOT . 'schedule/edit/' . $id;
        $this->view->displayErrors = $schedule->getErrorMessages();
        $this->view->render('schedule/edit');
    }
}
