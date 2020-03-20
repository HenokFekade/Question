<?php

namespace App\Providers;

use App\Grade;
use App\Subject;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $grades = Grade::all();
        $subjects = Subject::orderBy('name', 'asc')->get();
        View::composer(['advisor.question.create', 'advisor.question.edit'], function ($view) use ($grades, $subjects) {
            $view->with('grades', $grades)->with('subjects', $subjects);
        });
    }
}
