<?php

Route::get("/", "ArticlesController@index");
Route::resource("articles", "ArticlesController");