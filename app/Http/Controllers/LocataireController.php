<?php

namespace App\Http\Controllers;

use App\Locataire;
use Illuminate\Http\Request;

class LocataireController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $locataires = Locataire::all();

        return view( 'locataire.index', compact( 'locataires' ) );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view( 'locataire.add' );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $locataire = Locataire::create( $request->all() );
        $locataire->save();

        return redirect( 'locataire' );

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Locataire  $locataire
     * @return \Illuminate\Http\Response
     */
    public function show(Locataire $locataire)
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
        $locataire = Locataire::find( $id );
        return view( 'locataire.add', compact( 'locataire' ) );
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
        $locataire = Locataire::findOrFail( $id );
        $validator = Validator::make( $request->all(), [
            'prenom' => 'required|min:2',
            'nom' => 'required|min:2'
        ] );

        if ( $validator->fails() ) {
            return Redirect::to( '/locataire/' . $locataire . '/edit' )->withErrors( $validator->errors() );
        } else {
            $locataire->update( $request->all() );

            return redirect( 'locataire' );
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
        Locataire::destroy($id);

        return '{"redirect":"locataire"}';
    }
}
