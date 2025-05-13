<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/ninjas', function () {
    $ninjas = [
        ["name" => "yared", "skill" => 75, "id" => 1],
        ["name" => "lugi", "skill" => 80, "id" => 2],
        ["name" => "kaleb", "skill" => 65, "id" => 3],
    ];
    return view('ninjas.index', ["greeting" => "hello", "ninjas" => $ninjas]);
});


Route::get('/ninjas/create', function () {
    return view('ninjas.create');
});

Route::get('/ninjas/{id}', function ($id) {
    $ninjas = [
        ["name" => "yared", "skill" => 75, "id" => 1],
        ["name" => "lugi", "skill" => 80, "id" => 2],
        ["name" => "kaleb", "skill" => 65, "id" => 3],
    ];
    return view('ninjas.show', ["id" => $id]);
});