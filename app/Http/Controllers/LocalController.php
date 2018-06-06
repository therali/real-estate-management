<?php

namespace App\Http\Controllers;

use App\Category;
use App\Consistance;
use App\Local;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class LocalController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $locals = Local::get();

        return view( 'local.index', compact( 'locals' ) );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $categories   = Category::pluck( 'namecat', 'id' )->toArray();
        $consistances = Consistance::pluck( 'name', 'id' )->toArray();
        $local        = new Local();

        return view( 'local.add', compact( 'categories', 'local', 'consistances' ) );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store( Request $request ) {
        //
//        $l = new Local( $request->all() );
        $local = Local::create( $request->all() );
//        $local                 = new Local;
//        $local->libelle        = html_entity_decode( $request->libelle );
//        $local->adress         = html_entity_decode( $request->adress );
//        $local->meuble         = html_entity_decode( $request->meuble );
//        $local->note           = html_entity_decode( $request->note );
//        $local->surface        = html_entity_decode( $request->surface );
//        $local->nbpiece        = html_entity_decode( $request->nbpiece );
//        $local->category_id    = html_entity_decode( $request->category_id );
//        $local->consistance_id = html_entity_decode( $request->consistance_id );
//        $local->save();
        Session::flash('success', 'The Local was successfully saved!');
        return redirect( 'local' );
    }

    public function storeForMandat( Request $request ) {
        $local = Local::create( $request->all() );
        if ( $local ) {
            session()->put( 'addCartMandat.' . $local->id, $local );
        }
        return redirect( route( 'mandat.create.add' ) );
    }

    public function store2( Request $request ) {
        $local = Local::create( $request->all() );
        Session::flash('success', 'The Local was successfully saved!');
        $locals = Local::get();
        return view( 'local.index', compact( 'locals', 'local' ) );
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Local $local
     *
     * @return void
     */
    public function show( Local $local ) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     *
     * @return void
     */
    public function edit( $id ) {
        $local        = Local::findOrFail( $id );
        $categories   = Category::pluck( 'namecat', 'id' )->toArray();
        $consistances = Consistance::pluck( 'name', 'id' )->toArray();

        return view( 'local.add', compact( 'categories', 'local', 'consistances' ) );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param $id
     *
     * @return void
     */
    public function update( Request $request, $id ) {
        //
        $local     = Local::findOrFail( $id );
        $validator = Validator::make( $request->all(), [
            'libelle' => 'required|min:2'
        ] );

        if ( $validator->fails() ) {
            return redirect( '/local/' . $local . '/edit' )->withErrors( $validator->errors() );
        } else {
            $local->update( $request->all() );

            return redirect( 'local' );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id ) {
        //
        Local::destroy( $id );

        return '{"redirect":"local"}';
    }
}
