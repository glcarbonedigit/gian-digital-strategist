<?php

use App\Http\Controllers\Admin\ProjectAdminController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::view('/chi-sono', 'pages.about')->name('about');
Route::view('/servizi', 'pages.services')->name('services');
Route::get('/progetti', [ProjectController::class, 'index'])->name('projects.index');
Route::get('/progetti/{project:slug}', [ProjectController::class, 'show'])->name('projects.show');

Route::get('/contatti', [ContactController::class, 'show'])->name('contact');
Route::post('/contatti', [ContactController::class, 'send'])->name('contact.send');

// Sitemap
Route::get('/sitemap.xml', function () {
    $sitemap = Spatie\Sitemap\Sitemap::create()
        ->add(Spatie\Sitemap\Tags\Url::create('https://glcarbone.it')
            ->setChangeFrequency('weekly')
            ->setPriority(1.0))
        ->add(Spatie\Sitemap\Tags\Url::create('https://glcarbone.it/chi-sono')
            ->setChangeFrequency('monthly')
            ->setPriority(0.8))
        ->add(Spatie\Sitemap\Tags\Url::create('https://glcarbone.it/servizi')
            ->setChangeFrequency('monthly')
            ->setPriority(0.8))
        ->add(Spatie\Sitemap\Tags\Url::create('https://glcarbone.it/progetti')
            ->setChangeFrequency('weekly')
            ->setPriority(0.9))
        ->add(Spatie\Sitemap\Tags\Url::create('https://glcarbone.it/contatti')
            ->setChangeFrequency('monthly')
            ->setPriority(0.7));

    \App\Models\Project::all()->each(function ($project) use ($sitemap) {
        $sitemap->add(
            Spatie\Sitemap\Tags\Url::create("https://glcarbone.it/progetti/{$project->slug}")
                ->setLastModificationDate($project->updated_at)
                ->setChangeFrequency('monthly')
                ->setPriority(0.8)
        );
    });

    return response($sitemap->render(), 200)
        ->header('Content-Type', 'application/xml');
})->name('sitemap');

/*
|--------------------------------------------------------------------------
| Dashboard redirect
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    return redirect()->route('dashboard.projects.index');
})->middleware(['auth', 'verified'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Admin routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified'])
    ->prefix('dashboard')
    ->name('dashboard.')
    ->group(function () {
        Route::get('/projects', [ProjectAdminController::class, 'index'])->name('projects.index');
        Route::get('/projects/create', [ProjectAdminController::class, 'create'])->name('projects.create');
        Route::post('/projects', [ProjectAdminController::class, 'store'])->name('projects.store');

        Route::get('/projects/{project}/edit', [ProjectAdminController::class, 'edit'])->name('projects.edit');
        Route::put('/projects/{project}', [ProjectAdminController::class, 'update'])->name('projects.update');

        Route::delete('/projects/{project}/cover', [ProjectAdminController::class, 'destroyCover'])
            ->name('projects.cover.destroy');

        Route::delete('/projects/{project}/images/{image}', [ProjectAdminController::class, 'destroyImage'])
            ->name('projects.images.destroy');

        Route::post('/projects/{project}/images/reorder', [ProjectAdminController::class, 'reorderImages'])
            ->name('projects.images.reorder');

        Route::delete('/projects/{project}', [ProjectAdminController::class, 'destroy'])
            ->name('projects.destroy');
    });

require __DIR__.'/auth.php';