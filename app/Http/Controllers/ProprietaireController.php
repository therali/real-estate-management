<?php

namespace App\Http\Controllers;

use App\Proprietaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProprietaireController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $proprietaires = Proprietaire::all();

        return view( 'proprietaire.index', compact( 'proprietaires' ) );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view( 'proprietaire.add' );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $proprietaire = Proprietaire::create( $request->all() );
        $proprietaire->save();

        return redirect( 'proprietaire' );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Proprietaire  $proprietaire
     * @return \Illuminate\Http\Response
     */
    public function show(Proprietaire $proprietaire)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $proprietaire = Proprietaire::find( $id );
        return view( 'proprietaire.add', compact( 'proprietaire' ) );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $proprietaire = Proprietaire::findOrFail( $id );
        $validator = Validator::make( $request->all(), [
            'prenom' => 'required|min:2',
            'nom' => 'required|min:2'
        ] );

        if ( $validator->fails() ) {
            return Redirect::to( '/proprietaire/' . $proprietaire . '/edit' )->withErrors( $validator->errors() );
        } else {
            $proprietaire->update( $request->all() );

            return redirect( 'proprietaire' );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Proprietaire::destroy($id);

        return '{"redirect":"proprietaire"}';
    }
}
