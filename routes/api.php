<?php
use illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController as user;
Route::post("/upload_csv", [user::class, "uploadcsv"]);