<?php

namespace App\Http\Controllers;

use App\Contrat;
use App\Local;
use App\Locataire;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ContratController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $contrats = Contrat::all();

        return view( 'contrat.index', compact( 'contrats' ) );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $locals     = Local::all();
        $locataires = Locataire::all();
        session()->put( 'num_contrat', time() );
        session()->forget( [ 'checkLocataire', 'addCart' ] );

        return view( 'contrat.add', compact( 'locals', 'locataires' ) );

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store( Request $request ) {
//        dd( $request->all() );
//        $contrat               = new Contrat;
//        $contrat->code         = html_entity_decode( $request->code );
//        $contrat->date_in      = html_entity_decode( $request->date_in );
//        $contrat->date_out     = html_entity_decode( $request->date_out );
//        $contrat->depot_gar    = html_entity_decode( $request->depot_gar );
//        $contrat->date_pay     = html_entity_decode( $request->date_pay );
//        $contrat->mode_pay     = html_entity_decode( $request->mode_pay );
//        $contrat->loyer_nu     = html_entity_decode( $request->loyer_nu );
//        $contrat->periodicite  = html_entity_decode( $request->periodicite );
//        $contrat->etat         = html_entity_decode( $request->etat );
//        $contrat->note         = html_entity_decode( $request->note );
//        $contrat->locataire_id = html_entity_decode( $request->locataire_id );
//        $contrat->local_id     = html_entity_decode( $request->local_id );
//        $contrat->user_id      = Auth::id();
//        $contrat->save();

        $contrat = Contrat::create( $request->all() );
        session()->forget( [ 'addCart.' . $contrat->local_id ] );

        return redirect( route( 'contrat.create.add' ) );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contrat $contrat
     *
     * @return \Illuminate\Http\Response
     */
    public function show( Contrat $contrat ) {
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
        $contrat = Contrat::find( $id );

        return view( 'contrat.cart._modal_contrat_edit', compact( 'contrat' ) );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update( Request $request, $id ) {
        $contrat     = Contrat::findOrFail( $id );
        $validator = Validator::make( $request->all(), [
            'code' => 'required|min:6'
        ] );

        if ( $validator->fails() ) {
            return redirect( '/contrat/' . $contrat . '/edit' )->withErrors( $validator->errors() );
        } else {
            $contrat->update( $request->all() );
            session()->forget( [ 'addCart.' . $contrat->local_id ] );
            return redirect( route( 'contrat.create.add' ) );
        }
//        $contrat = Contrat::create( $request->all() );


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contrat $contrat
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy( Contrat $contrat ) {
        //
    }

    public function addCart( Request $request, $id ) {
        $local = Local::find( $id );

        if ( $local ) {
            session()->put( 'addCart.' . $local->id, $local );
        }

//        return view('contrat.cart.');
        return redirect( route( 'contrat.create.add' ) );
    }

    public function forgetLocal( $id ) {
        session()->forget( [ 'addCart.' . $id ] );

        return '{"redirect":"' . route( 'contrat.create.add' ) . '"}';

    }

    public function viewContrat( $idLocal, $idLocataire ) {
        $local     = Local::find( $idLocal );
        $locataire = Locataire::find( $idLocataire );

        return view( 'contrat.cart._modal_contrat', compact( 'local', 'locataire' ) );
    }

    public function add() {
        $locals     = Local::all();
        $locataires = Locataire::all();
//        $locals = DB::table('locals')
//                  ->join('contrats', 'locals.id', '=', 'contacts.local_id')
//                  ->where('contacts.etat', '=', 2)
//                  ->get();

        if ( session()->has( 'checkLocataire' ) ) {
            $locataire = session()->get( 'checkLocataire' );
            $contrats  = Contrat::with( [
                'locataire',
                'local',
                'user'
            ] )->where( 'locataire_id', $locataire->id )->get();

            return view( 'contrat.add', compact( 'locals', 'locataires', 'contrats' ) );
        }

        return view( 'contrat.add', compact( 'locals', 'locataires' ) );
    }

    public function checkLocataire( $id ) {
        $check_locataire = Locataire::find( $id );
        if ( $check_locataire ) {
            session()->put( 'checkLocataire', $check_locataire );
        }

        return redirect( route( 'contrat.create.add' ) );
    }

}
