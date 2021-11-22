<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Employee;
use App\Models\Product;

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
        /*
         * In case of database changes you need to comment out the whole function in order for artisan to work.
         */
        //Birthdays
        $birthdays = array();
        $employees = Employee::all();
        foreach ($employees as $employee) {
            $month = $employee->date_of_birth->month;
            $day = $employee->date_of_birth->day;
            if( $month == date('m') &&  $day == date('d')){
                array_push($birthdays, $employee);
            }
        }

        //dd($birthdays);
        $shortages = Product::where('stock_level' ,'<=', 'min_level')->get();

        View::share('shortages', $shortages);
        View::share('birthdays', $birthdays);
       
    }
    
}
