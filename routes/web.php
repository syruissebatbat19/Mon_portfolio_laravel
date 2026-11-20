<?php

use App\Http\Controllers\PortfolioController;
use Illuminate\Support\Facades\Route;

Route::get("/", [PortfolioController::class, "home"])->name("home");
Route::get("/projets/{project:slug}", [PortfolioController::class, "show"])->name("projects.show");
Route::post("/contact", [PortfolioController::class, "contact"])->name("contact.send");
