<?php

namespace App\Http\Controllers;

use App\Menu;
use App\User;
use App\UserRole;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Redirect;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;

class UserController extends Controller {

    use RegistersUsers;
    protected $redirectTo = '/users';

    public function __construct() {
        $this->middleware( 'auth' );
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $users = User::get();

        return view( 'users.users', compact( 'users' ) );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $user_edit = new User();

        return view( 'users.add_users', compact( 'user_edit' ) );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store( Request $request ) {
        $user = User::create( $request->all() );
        $user->save();
        $request->session()->flash( 'flash_message', 'Le User est ajoutée avec succes' );
        $request->session()->flash( 'flash_type', 'alert-success' );

        return $this->index();
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show( $id ) {
        $user_edit = User::findOrFail( $id );

        return view( 'users.add_users', compact( 'user_edit' ) );
    }

    protected function validator( array $data ) {
        return Validator::make( $data, [
            'name'     => 'required|max:255',
            'phone'    => 'required|max:255',
            'username' => 'sometimes|required|max:255|unique:users',
            'email'    => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'terms'    => 'required',
        ] );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit( $id ) {
        $menu_info = Menu::get();
        foreach ( $menu_info as $items ) {
            $menu['parents'][ $items->parent ][] = $items;
        }
        $data['result']    = $this->buildChild( 0, $menu );
        $data['user_edit'] = User::find( $id );
        $role              = UserRole::with( 'menu' )->where( 'user_id', $id )->get()->toArray();
        if ( $role ) {
            foreach ( $role as $value ) {
                $result[ $value['menu_id'] ] = $value['menu_id'];
            }

            $data['roll'] = $result;
        }

        return view( 'users.add_users', compact( 'data' ) );
    }

    public function buildChild( $parent, $menu ) {
        if ( isset( $menu['parents'][ $parent ] ) ) {
            foreach ( $menu['parents'][ $parent ] as $ItemID ) {
                if ( ! isset( $menu['parents'][ $ItemID->id ] ) ) {
                    $result[ $ItemID->label ] = $ItemID->id;
                }
                if ( isset( $menu['parents'][ $ItemID->id ] ) ) {
                    $result[ $ItemID->label ][ $ItemID->id ] = self::buildChild( $ItemID->id, $menu );
                }
            }
        }

        return $result;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update( Request $request, $id ) {
        $user           = User::find( $id );
        $validator      = Validator::make( $request->all(), [
            'name' => 'required|min:2'
        ] );
        $user->name     = html_entity_decode( $request->input( 'name' ) );
        $user->username = html_entity_decode( $request->input( 'username' ) );
        $user->phone    = html_entity_decode( $request->input( 'phone' ) );
        $user->email    = html_entity_decode( $request->input( 'email' ) );
        $user->sort     = html_entity_decode( $request->input( 'sort' ) );
        if ( ! empty( $request->input( 'password' ) ) ) {
            $user->password = bcrypt( $request->input( 'password' ) );
        }
        if ( $validator->fails() ) {
            return Redirect::to( '/users/' . $user . '/edit' )->withErrors( $validator->errors() );
        } else {
            $user->update();
            $roll = UserRole::where( 'user_id', $id )->get();
            foreach ( $roll as $v_roll ) {
                UserRole::destroy( $v_roll->id );
            }

            $menu_rolle = $request->input( 'menu' );
            if ( ! empty( $menu_rolle ) ) {
                foreach ( $menu_rolle as $menu_id ) {
                    $userRole          = new UserRole();
                    $userRole->user_id = $id;
                    $userRole->menu_id = $menu_id;
                    $userRole->save();
                }
            }
        }

        $request->session()->flash( 'flash_message', 'Information de l\'utilisateur sont mis à jour avec succès!' );
        $request->session()->flash( 'flash_type', 'alert-success' );

        return $this->index();
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id ) {
        User::destroy( $id );

        return '{"redirect":"users"}';
    }
}
