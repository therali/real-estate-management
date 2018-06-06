<?php

namespace App\Http\Controllers;

use App\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $menus = Menu::get()->sortBy('id');
        return view( 'navigation.list', compact('menus') );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menu = new Menu();
        $menus = Menu::pluck( 'label', 'id' )->toArray();
        return view( 'navigation.add', compact('menus', 'menu') );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $menu = Menu::create($request->all());
        $menu->save();
        $request->session()->flash('flash_message', 'Le Menu est ajoutée avec succes');
        $request->session()->flash('flash_type', 'alert-success');
        return Redirect::to('navigation');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
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
        $menu = Menu::find($id);
        $menus = Menu::pluck('label','id')->toArray();
        return view('navigation.add', compact('menus','menu'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request,  $id)
    {

        $menu = Menu::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'label'=>'required|min:2'
        ]);

        if ($validator->fails()) {
//             redirect(route('villes', $id))->withErrors($validator->errors());
            return Redirect::to('/navigation/'.$menu.'/edit')->withErrors($validator->errors());
        } else {
            $menu->update($request->all());
            return Redirect::to('navigation');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        Menu::destroy($id);
//        return Menu::get()->sortBy('id');
        return '{"redirect":"' . route( 'navigation.index' ) . '"}';
//        return Redirect::to('navigation');
    }
}
