<?php

namespace App\Http\Controllers;

use App\Category;
use App\Consistance;
use App\Local;
use App\Mandat;
use App\Proprietaire;
use Illuminate\Http\Request;

class MandatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mandats = Mandat::all();

        return view( 'mandat.index', compact( 'mandats' ) );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        session()->forget( [ 'checkProprietaire', 'addCartMandat' ] );
        $proprietaires = Proprietaire::all();
        $locals = Local::all();
        $categories   = Category::pluck( 'namecat', 'id' )->toArray();
        $consistances = Consistance::pluck( 'name', 'id' )->toArray();
        return view( 'mandat.add', compact( 'proprietaires', 'locals', 'categories', 'consistances' ) );

    }

    public function forgetLocal( $id ) {
        session()->forget( [ 'addCartMandat.' . $id ] );

        return '{"redirect":"' . route( 'mandat.create.add' ) . '"}';

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Mandat::create( $request->all() );
        session()->forget( [ 'addCartMandat.' . $request->local_id ] );

        return redirect( route( 'mandat.create.add' ) );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Mandat  $mandat
     * @return \Illuminate\Http\Response
     */
    public function show(Mandat $mandat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Mandat  $mandat
     * @return \Illuminate\Http\Response
     */
    public function edit(Mandat $mandat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Mandat  $mandat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mandat $mandat)
    {
        //
    }

    public function checkProprietaire( $id ) {
        $check_proprietaire = Proprietaire::find( $id );
        if ( $check_proprietaire ) {
            session()->put( 'checkProprietaire', $check_proprietaire );
        }

        return redirect( route( 'mandat.create.add' ) );
    }

    public function add() {
        $proprietaires = Proprietaire::all();
        $locals = Local::all();
        $categories   = Category::pluck( 'namecat', 'id' )->toArray();
        $consistances = Consistance::pluck( 'name', 'id' )->toArray();
        if ( session()->has( 'checkProprietaire' ) ) {
            $proprietaire = session()->get( 'checkProprietaire' );
            $mandats  = Mandat::with( [
                'proprietaire',
                'local',
                'user'
            ] )->where( 'proprietaire_id', $proprietaire->id )->get();
            return view( 'mandat.add', compact( 'proprietaires', 'locals', 'categories', 'consistances', 'mandats' ) );
        }

        return view( 'mandat.add', compact( 'proprietaires', 'locals', 'categories', 'consistances' ) );

    }

    public function addCart( Request $request, $id ) {
        $local = Local::find( $id );
        if ( $local ) {
            session()->put( 'addCartMandat.' . $local->id, $local );
        }

        return redirect( route( 'mandat.create.add' ) );
    }

    public function viewMandat( $idLocal, $idProprietaire ) {
        $local     = Local::find( $idLocal );
        $proprietaire = Proprietaire::find( $idProprietaire );

        return view( 'mandat.cart._modal_mandat', compact( 'local', 'proprietaire' ) );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Mandat  $mandat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mandat $mandat)
    {
        //
    }
}
