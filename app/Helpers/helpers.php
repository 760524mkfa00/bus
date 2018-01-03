<?php

function sort_students_by($column, $body)
{

    $direction = (Request::get('direction') == 'asc') ? 'desc' : 'asc';
//    $params = $_GET;
//    $sorting = ['sortBy' => $column, 'direction' => $direction];
    $params = array_merge($_GET, ['sortBy' => $column, 'direction' => $direction]);
    $route = route('list_student', $params);

    return "<a href='{$route}'>$body</a>";
}