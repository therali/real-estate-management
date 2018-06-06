<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get( '/', function () {
    return view( 'welcome' );
} );

Route::group( [
    'middleware' => 'auth'
], function () {

    //UTILISATEUR
//    Route::get('employee/{id}', 'UserController@show');
//    Route::resource('user', 'UserController');

    Route::get( 'loyer/generate', 'LoyerController@generate' )->name( 'loyer.generate' );
    Route::post( 'loyer/generate', 'LoyerController@generateLoyer' )->name( 'loyer.generate' );
    Route::get( 'loyer/add_paiement/{id}', 'LoyerController@addPaiement' )->name( 'loyer.add_paiement' );

    // VILLE
    Route::resources( [
        'users'        => 'UserController',
        'loyer'        => 'LoyerController',
        'navigation'   => 'MenuController',
        'category'     => 'CategoryController',
        'local'        => 'LocalController',
        'contrat'      => 'ContratController',
        'locataire'    => 'LocataireController',
        'proprietaire' => 'ProprietaireController',
        'mandat'       => 'MandatController',
        'paiement'     => 'PaiementController',
    ] );



    Route::get( 'contrat/{id}/add_cart', 'ContratController@addCart' )->name( 'contrat.addCart' );
    Route::get( 'contrat/{id}/check_locataire', 'ContratController@checkLocataire' )->name( 'contrat.check_locataire' );
    Route::get( 'contrat/create/add', 'ContratController@add' )->name( 'contrat.create.add' );
    Route::get( 'contrat/create/view_contrat/{idLocal}/{idLocataire}', 'ContratController@viewContrat' )->where( [ 'idLocal'     => '[0-9]+',
                                                                                                                   'idLocataire' => '[0-9]+'
    ] )->name( 'contrat.view_contrat' );

    Route::delete( 'contrat/{id}/forget-local', 'ContratController@forgetLocal' )->name( 'contrat.forget-local' );

    Route::get( 'mandat/{id}/check_proprietaire', 'MandatController@checkProprietaire' )->name( 'mandat.check_proprietaire' );
    Route::get( 'mandat/create/add', 'MandatController@add' )->name( 'mandat.create.add' );
    Route::get( 'mandat/create/view-mandat/{idLocal}/{idProprietaire}', 'MandatController@viewMandat' )->where( [ 'idLocal'        => '[0-9]+',
                                                                                                                  'idProprietaire' => '[0-9]+'
    ] )->name( 'mandat.view-mandat' );
    Route::get( 'mandat/{id}/add_cart', 'MandatController@addCart' )->name( 'mandat.addCart' );

    Route::delete( 'mandat/{id}/forget-local', 'MandatController@forgetLocal' )->name( 'mandat.forget-local' );

    Route::post( 'local/store-for-mandat', 'LocalController@storeForMandat' )->name( 'local.store-for-mandat' );

} );

