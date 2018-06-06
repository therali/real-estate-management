<?php

/*
 * Taken from
 * https://github.com/laravel/framework/blob/5.3/src/Illuminate/Auth/Console/stubs/make/controllers/HomeController.stub
 */

namespace App\Http\Controllers;

use App\Contrat;
use App\Http\Requests;
use App\Local;
use App\Locataire;
use App\Mandat;
use Illuminate\Http\Request;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index()
    {
        $count_local = Local::count();
        $count_contrat = Contrat::count();
        $count_mandat = Mandat::count();
        $count_locataire = Locataire::count();

        return view('home', compact('count_local', 'count_contrat', 'count_mandat', 'count_locataire'));
    }
}
