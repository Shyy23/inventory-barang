<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\ClassModel;
use App\Models\Item;
use App\Models\ItemUnit;
use App\Models\Loan;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use App\Observers\DataChangeObserver;
use App\Observers\ItemObserver;
use App\Observers\ItemUnitObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        User::observe(DataChangeObserver::class);
        Item::observe(DataChangeObserver::class);
        ClassModel::observe(DataChangeObserver::class);
        Student::observe(DataChangeObserver::class);
        Teacher::observe(DataChangeObserver::class);
        ItemUnit::observe(DataChangeObserver::class);
        Category::observe(DataChangeObserver::class);
        Item::observe(ItemObserver::class);
        ItemUnit::observe(ItemUnitObserver::class);
    }
}
