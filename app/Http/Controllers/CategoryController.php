<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $categories = Category::get();

        return view( 'categories.index', compact( 'categories' ) );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $category = new Category();

        return view( 'categories.add', compact( 'category' ) );

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store( Request $request ) {
        $categ = Category::create( $request->all() );
        $categ->save();

        return redirect( 'category' );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category $category
     *
     * @return \Illuminate\Http\Response
     */
    public function show( Category $category ) {
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
        $category = Category::find( $id );
        return view( 'categories.add', compact( 'category' ) );
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
        $category  = Category::findOrFail( $id );
        $validator = Validator::make( $request->all(), [
            'namecat' => 'required|min:2'
        ] );

        if ( $validator->fails() ) {
            return Redirect::to( '/category/' . $category . '/edit' )->withErrors( $validator->errors() );
        } else {
            $category->update( $request->all() );

            return redirect( 'category' );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     *
     * @return void
     */
    public function destroy( $id ) {
        Category::destroy( $id );

        return '{"redirect":"category"}';
    }
}
