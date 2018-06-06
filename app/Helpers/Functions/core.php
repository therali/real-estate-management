<?php
/**
 * Created by PhpStorm.
 * User: THERALI
 * Date: 20/05/2018
 * Time: 04:10
 */

/**
 * Default translator (e.g. en/global.php)
 *
 * @param $string
 * @param array $replace
 * @param string $file
 * @param null $locale
 *
 * @return string|\Symfony\Component\Translation\TranslatorInterface
 */
if ( ! function_exists( 't' ) ) {
    function t( $string, $replace = [], $file = 'global', $locale = null ) {
        if ( is_null( $locale ) ) {
            $locale = config( 'app.locale' );
        }

        return trans( $file . '.' . $string, $replace, $locale );
    }
}

if ( ! function_exists( 'get_etat' ) ) {
    function get_etat( $id = 0 ) {
        switch ( $id ) {
            case 1:
                return '<span class="label label-success">En cours</span>';
                break;
            case 2:
                return '<span class="label label-danger">Fermer</span>';
                break;
            case 3:
                return '<span class="label label-warning">En Attante</span>';
                break;
            default:
                return $id;
        }
    }
}
if ( ! function_exists( 'get_months' ) ) {
    function get_months() {
        return [
            '1'  => t( 'Janvier' ),
            '2'  => t( 'Février' ),
            '3'  => t( 'Mars' ),
            '4'  => t( 'Avril' ),
            '5'  => t( 'Mai' ),
            '6'  => t( 'Juin' ),
            '7'  => t( 'Juillet' ),
            '8'  => t( 'Août' ),
            '9'  => t( 'Septembre' ),
            '10' => t( 'Octobre' ),
            '11' => t( 'Novembre' ),
            '12' => t( 'Décembre' )
        ];
    }
}

if ( ! function_exists( 'days_in_month' ) ) {
    function days_in_month( $month, $year ) {
// calculate number of days in a month
        return $month == 2 ? ( $year % 4 ? 28 : ( $year % 100 ? 29 : ( $year % 400 ? 28 : 29 ) ) ) : ( ( $month - 1 ) % 7 % 2 ? 30 : 31 );
    }
}
if ( ! function_exists( 'form_date' ) ) {
    function form_date( $date = NULL, $format = 'd/m/Y' ) {
        if ( empty( $date ) ) {
            $date = date( 'd/m/Y' );
        }
        return \Carbon\Carbon::parse( $date )->format( $format );
    }
}

if ( ! function_exists( 'nb_format' ) ) {
    function nb_format( $somme = NULL ) {
        if (!empty( $somme ) ) {
            $somme = number_format($somme, 0, ',', ' ');
        }
        return $somme;
    }
}

/*
 Route::resource('line-items', 'LineItemsController');
Route::resource('users', 'UsersController');

<a href="{{ show_route($lineItem) }}">
    {{ $lineItem->name }}
</a>
 */
if ( ! function_exists( 'show_route' ) ) {
    function show_route( $model, $resource = null ) {
        $resource = $resource ?? plural_from_model( $model );

        return route( "{$resource}.show", $model );
    }
}
/*
 $model = new App\LineItem;
plural_from_model($model);
=> line-items

plural_from_model(new App\User);
=> users
 */
if ( ! function_exists( 'plural_from_model' ) ) {
    function plural_from_model( $model ) {
        $plural = Str::plural( class_basename( $model ) );

        return Str::kebab( $plural );
    }
}

if ( ! function_exists( 'dynamicMenu' ) ) {

    function dynamicMenu() {
//        $CI = &get_instance();

//        $employee_login = Auth::user();

        $user = Auth::user();


        if ( $user->sort != 1 ) {
            // query for employee employee role

            $user_menu = Auth::user()->user_roles();

        } else { // get all menu for admin
            $user_menu = \App\Menu::get()->sortBy( 'sort' )->toArray();
        }

        // Create a multidimensional array to conatin a list of items and parents
        $menu = array(
            'items'   => array(),
            'parents' => array(),
        );

        // Builds the array lists with data from the menu table
        foreach ( $user_menu as $items ) {

            // Creates entry into items array with current menu item id ie. $menu['items'][1]
            $menu['items'][ $items['id'] ] = $items;

            // Creates entry into parents array. Parents array contains a list of all items with children
            $menu['parents'][ $items['parent'] ][] = $items['id'];
        }


        return $output = buildMenu( 0, $menu );
    }
}


if ( ! function_exists( 'buildMenu' ) ) {
    function buildMenu( $parent, $menu, $flag = null ) {
        $html = '';

        if ( isset( $menu['parents'][ $parent ] ) ) {

            if ( $flag != null ) {
                $html .= "<ul  class='treeview-menu'>\n";
            } else {
                $html .= "<ul data-widget=\"tree\" class='sidebar-menu'>\n";
            }

            foreach ( $menu['parents'][ $parent ] as $itemId ) {
                $result = active_menu_id( $menu['items'][ $itemId ]['link'] );

                if ( $result ) {
                    $active = 'active';
                    $opened = 'opened';
                } else {
                    $active = '';
                    $opened = '';
                }

                if ( ! isset( $menu['parents'][ $itemId ] ) ) { //if condition is false
                    $html .= "<li class='" . $active . "' >\n   <a href='" . url( $menu['items'][ $itemId ]['link'] ) . "'> <i class='" . $menu['items'][ $itemId ]['icon'] . "'></i><span>" . $menu['items'][ $itemId ]['label'] . "</span></a>\n</li> \n";
                }

                if ( isset( $menu['parents'][ $itemId ] ) ) { //if condition is true
                    $html .= "<li class='" . $active . ' treeview ' . "'> <a href='" . url( $menu['items'][ $itemId ]['link'] ) . "'> <i class='" . $menu['items'][ $itemId ]['icon'] . "'></i><span>" . $menu['items'][ $itemId ]['label'] . "</span> <i class='fa fa-angle-left pull-right'></i> </a>\n";
                    $html .= buildMenu( $itemId, $menu, $flag = 1 );
                    $html .= "</li> \n";
                }
            }
            $html .= "</ul> \n";
        }

        return $html;
    }
}
if ( ! function_exists( 'routeToURI' ) ) {
    function routeToURI( Router $router ) {
        return str_replace( '.', '/', $router->currentRouteName() );
    }
}

if ( ! function_exists( 'active_menu_id' ) ) {
    function active_menu_id( $menu_lick ) {
        $router = app()->make( 'router' )->getCurrentRoute()->uri;
        if ( ! empty( $router ) ) {
            if ( $router === $menu_lick ) {
                return true;
            }
        }
        return false;
    }
}