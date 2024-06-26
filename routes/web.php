<?php

use App\Http\Controllers\Admin\AjaxController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactFormController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\PortfolioSectionController;
use App\Http\Controllers\UserController;
use EdSDK\FlmngrServer\FlmngrServer;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/', App\Http\Controllers\Admin\HomeController::class)->name('home');

    Route::get('/pages', [App\Http\Controllers\Admin\PageController::class, 'index'])->name('pages.index');
    Route::get('/pages/create', [App\Http\Controllers\Admin\PageController::class, 'create'])->name('pages.create');
    Route::post('/pages', [App\Http\Controllers\Admin\PageController::class, 'store'])->name('pages.store');
    Route::get('/pages/{id}/edit', [App\Http\Controllers\Admin\PageController::class, 'edit'])->name('pages.edit');
    Route::put('/pages/{id}', [App\Http\Controllers\Admin\PageController::class, 'update'])->name('pages.update');
    Route::get('/pages/{id}/delete', [App\Http\Controllers\Admin\PageController::class, 'destroy'])->name('pages.destroy');
    Route::get('/pages/{id}/publish', [App\Http\Controllers\Admin\PageController::class, 'publish'])->name('pages.publish');

    Route::get('/portfolio', [App\Http\Controllers\Admin\PortfolioController::class, 'index'])->name('portfolio.index');
    Route::get('/portfolio/create', [App\Http\Controllers\Admin\PortfolioController::class, 'create'])->name('portfolio.create');
    Route::post('/portfolio', [App\Http\Controllers\Admin\PortfolioController::class, 'store'])->name('portfolio.store');
    Route::get('/portfolio/{id}/edit', [App\Http\Controllers\Admin\PortfolioController::class, 'edit'])->name('portfolio.edit');
    Route::put('/portfolio/{id}', [App\Http\Controllers\Admin\PortfolioController::class, 'update'])->name('portfolio.update');
    Route::get('/portfolio/{id}/delete', [App\Http\Controllers\Admin\PortfolioController::class, 'destroy'])->name('portfolio.destroy');
    Route::get('/portfolio/{id}/publish', [App\Http\Controllers\Admin\PortfolioController::class, 'publish'])->name('portfolio.publish');

    Route::get('/portfolioSections', [App\Http\Controllers\Admin\PortfolioSectionController::class, 'index'])->name('portfolioSections.index');
    Route::get('/portfolioSections/create', [App\Http\Controllers\Admin\PortfolioSectionController::class, 'create'])->name('portfolioSections.create');
    Route::post('/portfolioSections', [App\Http\Controllers\Admin\PortfolioSectionController::class, 'store'])->name('portfolioSections.store');
    Route::get('/portfolioSections/{id}/edit', [App\Http\Controllers\Admin\PortfolioSectionController::class, 'edit'])->name('portfolioSections.edit');
    Route::put('/portfolioSections/{id}', [App\Http\Controllers\Admin\PortfolioSectionController::class, 'update'])->name('portfolioSections.update');
    Route::get('/portfolioSections/{id}/delete', [App\Http\Controllers\Admin\PortfolioSectionController::class, 'destroy'])->name('portfolioSections.destroy');
    Route::get('/portfolioSections/{id}/publish', [App\Http\Controllers\Admin\PortfolioSectionController::class, 'publish'])->name('portfolioSections.publish');

    Route::get('/faq', [App\Http\Controllers\Admin\FaqController::class, 'index'])->name('faq.index');
    Route::get('/faq/create', [App\Http\Controllers\Admin\FaqController::class, 'create'])->name('faq.create');
    Route::post('/faq', [App\Http\Controllers\Admin\FaqController::class, 'store'])->name('faq.store');
    Route::get('/faq/{id}/edit', [App\Http\Controllers\Admin\FaqController::class, 'edit'])->name('faq.edit');
    Route::put('/faq/{id}', [App\Http\Controllers\Admin\FaqController::class, 'update'])->name('faq.update');
    Route::get('/faq/{id}/delete', [App\Http\Controllers\Admin\FaqController::class, 'destroy'])->name('faq.destroy');
    Route::get('/faq/{id}/publish', [App\Http\Controllers\Admin\FaqController::class, 'publish'])->name('faq.publish');

    Route::get('/galleries', [App\Http\Controllers\Admin\GalleryController::class, 'index'])->name('galleries.index');
    Route::get('/galleries/create', [App\Http\Controllers\Admin\GalleryController::class, 'create'])->name('galleries.create');
    Route::post('/galleries', [App\Http\Controllers\Admin\GalleryController::class, 'store'])->name('galleries.store');
    Route::get('/galleries/{id}/edit', [App\Http\Controllers\Admin\GalleryController::class, 'edit'])->name('galleries.edit');
    Route::put('/galleries/{id}', [App\Http\Controllers\Admin\GalleryController::class, 'update'])->name('galleries.update');
    Route::get('/galleries/{id}/delete', [App\Http\Controllers\Admin\GalleryController::class, 'destroy'])->name('galleries.destroy');
    Route::get('/galleries/{id}/publish', [App\Http\Controllers\Admin\GalleryController::class, 'publish'])->name('galleries.publish');

    Route::get('/users', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [App\Http\Controllers\Admin\UserController::class, 'create'])->name('users.create');
    Route::post('/users', [App\Http\Controllers\Admin\UserController::class, 'store'])->name('users.store');
    Route::get('/users/{id}/edit', [App\Http\Controllers\Admin\UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}', [App\Http\Controllers\Admin\UserController::class, 'update'])->name('users.update');
    Route::get('/users/{id}/delete', [App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('users.destroy');
    Route::get('/users/{id}/publish', [App\Http\Controllers\Admin\UserController::class, 'publish'])->name('users.publish');

    Route::prefix('ajax')->group(function () {
        Route::post('/updateAvatar', [App\Http\Controllers\Admin\AjaxController::class, 'updateAvatar'])->name('ajax.updateAvatar');
        Route::post('/destroyImage', [App\Http\Controllers\Admin\AjaxController::class, 'destroyImage'])->name('ajax.destroyImage');
        Route::post('/saveGallerySort', [App\Http\Controllers\Admin\AjaxController::class, 'saveGallerySort'])->name('ajax.saveGallerySort');
        Route::post('/addImagesToPortfolio', [App\Http\Controllers\Admin\AjaxController::class, 'addImagesToPortfolio'])->name('ajax.addImagesToPortfolio');
        Route::post('/saveQuestion', [App\Http\Controllers\Admin\AjaxController::class, 'saveQuestion'])->name('ajax.saveQuestion');
        Route::post('/removeQuestion', [App\Http\Controllers\Admin\AjaxController::class, 'removeQuestion'])->name('ajax.removeQuestion');
        Route::post('/removeGalleryItem', [App\Http\Controllers\Admin\AjaxController::class, 'removeGalleryItem'])->name('ajax.removeGalleryItem');
        Route::post('/updateGalleryItem', [App\Http\Controllers\Admin\AjaxController::class, 'updateGalleryItem'])->name('ajax.updateGalleryItem');
        Route::post('/addImagesToGallery', [App\Http\Controllers\Admin\AjaxController::class, 'addImagesToGallery'])->name('ajax.addImagesToGallery');
    });

    Route::get('/linkStorage', function () {
        Artisan::call('storage:link');
    });

    Route::get('/clearCache', function () {
        Artisan::call('cache:clear');
    });
});

Route::post('/flmngr', function () {
    FlmngrServer::flmngrRequest(
        array(
            'dirFiles' => base_path() . '/storage/app/public/upload/files',
        )
    );
});

Route::name('user.')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'auth'])->name('auth');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::get('/', HomeController::class)->name('home');
Route::redirect('/index', '/', 301);

Route::get('/portfolio', [PortfolioController::class, 'index'])->name('portfolio.index');
Route::get('/portfolio/{page}', [PortfolioController::class, 'show'])->where('page', '.+')->name('portfolio.show');

Route::get('/faq', [FaqController::class, 'index'])->name('faq.index');
Route::get('/faq/{page}', [FaqController::class, 'show'])->where('page', '.+')->name('faq.show');

Route::get('/contact-form', [ContactFormController::class, 'show'])->name('contactForm.show');
Route::post('/contact-form', [ContactFormController::class, 'send'])->name('contactForm.send');

Route::get('/{page}', [PageController::class, 'show'])->where('page', '.+')->name('pages.show');

