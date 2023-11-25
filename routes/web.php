<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dashboard\liveChannelsController;
use App\Http\Controllers\dashboard\teamsController;
use App\Http\Controllers\dashboard\SubcategoriesController;
use App\Http\Controllers\dashboard\categoriesController;
use App\Http\Controllers\dashboard\MainSourcesController;
use App\Http\Controllers\dashboard\SourcesController;
use App\Http\Controllers\dashboard\usersController;



Route::group(['prefix' => 'dashboard', 'middleware' => ['admin']], function () {
    // crud live channels 
    Route::get('/show/livechannels', [liveChannelsController::class, 'index'])->name('showLivechanels');
    Route::get('show/create/livechannels', [liveChannelsController::class, 'createshow'])->name('showCreatepageLivechannles');
    Route::post('create/livechannels', [liveChannelsController::class, 'create'])->name('CreatepageLivechannles');
    Route::get('show/edit/livechannels/{id}', [liveChannelsController::class, 'editshow'])->name('showEditepageLivechannles');
    Route::post('edit/livechannels/{id}', [liveChannelsController::class, 'edit'])->name('EditLivechannles');
    Route::post('delete/livechannels/{id}', [liveChannelsController::class, 'delete'])->name('DeleteLivechannles');

    // crud Teams 
    Route::get('/show/teams', [teamsController::class, 'index'])->name('showTeams');
    Route::get('show/create/teams', [teamsController::class, 'createshow'])->name('showCreatepageteams');
    Route::post('create/teams', [teamsController::class, 'create'])->name('Createpageteams');
    Route::get('show/edit/teams/{id}', [teamsController::class, 'editshow'])->name('showEditepageteams');
    Route::post('edit/teams/{id}', [teamsController::class, 'edit'])->name('Editteams');
    Route::post('delete/teams/{id}', [teamsController::class, 'delete'])->name('Deleteteams');

    // crud sub_categories
    Route::get('/show/Subcategories', [SubcategoriesController::class, 'index'])->name('showSubcategories');
    Route::get('show/create/Subcategories', [SubcategoriesController::class, 'createshow'])->name('showCreatepageSubcategories');
    Route::post('create/Subcategories', [SubcategoriesController::class, 'create'])->name('CreatepageSubcategories');
    Route::get('show/edit/Subcategories/{id}', [SubcategoriesController::class, 'editshow'])->name('showEditepageSubcategories');
    Route::post('edit/Subcategories/{id}', [SubcategoriesController::class, 'edit'])->name('EditSubcategories');
    Route::post('delete/Subcategories/{id}', [SubcategoriesController::class, 'delete'])->name('DeleteSubcategories');

    // crud categories
    Route::get('/show/categories', [categoriesController::class, 'index'])->name('showcategories');
    Route::get('show/create/categories', [categoriesController::class, 'createshow'])->name('showCreatepagecategories');
    Route::post('create/categories', [categoriesController::class, 'create'])->name('Createpagecategories');
    Route::get('show/edit/categories/{id}', [categoriesController::class, 'editshow'])->name('showEditepagecategories');
    Route::post('edit/categories/{id}', [categoriesController::class, 'edit'])->name('Editcategories');
    Route::post('delete/categories/{id}', [categoriesController::class, 'delete'])->name('Deletecategories');

    // crud Main-sources
    Route::get('/show/mainSources', [MainSourcesController::class, 'index'])->name('showmainSources');
    Route::get('show/create/mainSources', [MainSourcesController::class, 'createshow'])->name('showCreatepagemainSources');
    Route::post('create/mainSources', [MainSourcesController::class, 'create'])->name('CreatepagemainSources');
    Route::get('show/edit/mainSources/{id}', [MainSourcesController::class, 'editshow'])->name('showEditepagemainSources');
    Route::post('edit/mainSources/{id}', [MainSourcesController::class, 'edit'])->name('EditmainSources');
    Route::post('delete/mainSources/{id}', [MainSourcesController::class, 'delete'])->name('DeletemainSources');

    // crud Sources
    Route::get('/show/Sources', [SourcesController::class, 'index'])->name('showSources');
    Route::get('show/create/Sources', [SourcesController::class, 'createshow'])->name('showCreatepageSources');
    Route::post('create/Sources', [SourcesController::class, 'create'])->name('CreatepageSources');
    Route::get('show/edit/Sources/{id}', [SourcesController::class, 'editshow'])->name('showEditepageSources');
    Route::post('edit/Sources/{id}', [SourcesController::class, 'edit'])->name('EditSources');
    Route::post('delete/Sources/{id}', [SourcesController::class, 'delete'])->name('DeleteSources');

    // crud user
    Route::get('/show/users', [usersController::class, 'index'])->name('showUsers');
    Route::get('show/create/users', [usersController::class, 'createshow'])->name('showCreatepageUsers');
    Route::post('create/users', [usersController::class, 'register'])->name('CreatepageUsers');
    Route::get('show/edit/users/{id}', [usersController::class, 'editshow'])->name('showEditepageUsers');
    Route::post('edit/users/{id}', [usersController::class, 'edit'])->name('EditUsers');
    Route::post('delete/users/{id}', [usersController::class, 'delete'])->name('DeleteUsers');
    Route::post('admin/users/{id}', [usersController::class, 'ActiveAdmin'])->name('ActiveAdmin');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
