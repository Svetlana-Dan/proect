<?php
    include_once 'classes/database.php';
    $topics = Database::exec("SELECT * FROM `topics`");
    $durations = Database::exec("SELECT * FROM `durations`");
    $if_doned =  Database::exec("SELECT * FROM `if_doned`");
    $data_rel = false;
    $data = null;
    $message = null;
    $what_search = array(
        'nothing' => 'Все задачи',
        'now' => 'Текущие задачи',
        'over' => 'Просроченные задачи',
        'completed' => 'Выполненные задачи',
    );    
    $when_search = array(
        'all' => 'Все',
        'today' => 'Сегодня',
        'tomorrow' => 'Завтра',
        'this_week' => 'На эту неделю',
        'next_week' => 'На следующую неделю',
    );