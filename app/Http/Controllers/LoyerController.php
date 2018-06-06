<?php

namespace App\Http\Controllers;

use App\Contrat;
use App\Loyer;
use App\Paiement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoyerController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $loyers = Loyer::all();

        return view( 'loyer.index', compact( 'loyers' ) );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $loyer = new Loyer();

        return view( 'loyer.add', compact( 'loyer' ) );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return void
     */
    public function store( Request $request ) {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     *
     * @return void
     */
    public function show( $id ) {
        //
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit( $id ) {
        $loyer = Loyer::findOrFail( $id );

        return view( 'loyer.add', compact( 'loyer' ) );
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
    }

    public function addPaiement($id)
    {
        $loyer = Loyer::findOrFail( $id );

        return view( 'loyer.paiement._modal_paiement', compact( 'loyer' ) );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     *
     * @return void
     */
    public function destroy( $id ) {
        Loyer::destroy( $id );

        return '{"redirect":"' . route( 'loyer' ) . '"}';
    }

    public function generate() {
        return view( 'loyer.generate' );
    }

    /*
     'code',
            'loyer',
            'dd',
            'df',
            'montant',
            'echeance',
            'msg_quittance',
            'note',
            'contrat_id',
            'user_id',
     */
    public function generateLoyer( Request $request ) {
        $mois       = get_months();
        $nbjour     = days_in_month( $request->moi, $request->annee );
        $loyer_name = $mois[ $request->moi ] . ' ' .  $request->annee;

        // TODO: Filtrer les contrats pour ne pas générer les contrats qui sont fermés...
        $contrats = Contrat::all();
        foreach ( $contrats as $contrat ) {
            $loy           = new Loyer;
            $loy->code     = time() . random_int( 10, 99 );
            $loy->libelle  = $loyer_name;
            $loy->dd       = $request->annee . '-' . $request->moi . '-1';
            $loy->df       = $request->annee . '-' . $request->moi . '-' . $nbjour;
            $loy->echeance = $request->annee . '-' . $request->moi . '-5';
            $loy->montant  = $contrat->loyer_nu;
            $loy->user_id  = Auth::id();

            $is = true;
            foreach ( $contrat->loyers as $loyer ) {
                if ( strcmp($loyer->libelle, $loyer_name) === 0  ) {
                    $is = false;
                }
            }
            if ( $is ) {
                $loy->contrat_id = $contrat->id;
                $loy->save();
            }
        }

        return redirect( route( 'loyer.index' ) );

    }

}
