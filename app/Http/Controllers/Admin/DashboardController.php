<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Location;
use App\Models\Plantation;
use App\Models\Specie;
use App\Models\Location as Plant;
use Spatie\Activitylog\Models\Activity;

class DashboardController extends Controller
{
    public function __construct()
    {
        DB::statement("SET SQL_MODE=''"); // set the strict to false
    }

    public function __invoke()
    {
        $species = Specie::orderBy('id', 'desc')->take(10)->get();
        $plants = Plant::with('specie')->orderBy('id', 'desc')->take(10)->get();

        return view('admin.dashboard.index', [
            'activities' => Activity::latest()->take(5)->get(),
            'total_active_user' => User::notAdmin()->active()->count(),
            'total_inactive_user' => User::notAdmin()->inactive()->count(),
            'total_species' => Specie::count(),
            'total_plantation' => Plantation::count(),
            'total_plants' => Plant::count(),
            'locations' => Location::latest()->paginate(5),
            'users' => User::notAdmin()->latest()->paginate(5),
            'plantations' => Plantation::paginate(5),

            // charts   
            'chart_total_species_by_category' => $this->get_total_species_by_category(),
            'chart_monthly_user' => $this->get_monthly_user(),

            // map
            'map_plantations' => Plantation::with('specie', 'location')->get(),
            'species' => $species,
            'plants' => $plants
        ]);
    }

    private function get_total_species_by_category()
    {
        $categories = [];
        $total_species = [];

        foreach (Category::withCount('species')->get() as $category) {
            $categories[] = $category->name;
            $total_species[] = $category->species_count;
        }

        return [$categories, $total_species];
    }

    /**
     * get montly user
     *
     * @return void
     */
    private function get_monthly_user()
    {
        $monthly_users = User::selectRaw("
        count(id) AS total_users, 
        month(created_at) as month_no, 
        DATE_FORMAT(created_at, '%M-%Y') AS new_date,
        YEAR(created_at) AS year,
        monthname(created_at) AS month"
        )
        ->notAdmin()
        ->groupBy('new_date')
        ->orderByRaw('month_no')
        ->get();

        $months = array();
        
        $total_monthly_users = array();

        $months = $monthly_users->pluck('month')->all();
        $total_monthly_users = $monthly_users->pluck('total_users')->all();

        return [$months, $total_monthly_users];
    }
}