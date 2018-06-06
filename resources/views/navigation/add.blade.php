@extends('page')

@section('htmlheader_title')
    {{ trans('Add new Menu') }}
@endsection


@section('main-content')
    <div class="container-fluid spark-screen">
        <div class="row">
            <div class="col-sm-12">
                <div class="wrap-fpanel">
                    <div class="panel panel-default" data-collapsed="0">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <strong>Ajouter Menu</strong>
                            </div>
                        </div>
                        <div class="panel-body">
                            @if($menu->id)
                                {!! BootForm::openHorizontal(['sm'=>[3, 5],'sm'=>[3, 6]])->action( route('navigation.update', $menu) )->put() !!}
                                {!! BootForm::bind($menu) !!}
                            @else
                                {!! BootForm::openHorizontal(['sm'=>[3, 5],'sm'=>[3, 6]])->action( route('navigation.store') )->post()->enctype('multipart/form-data') !!}
                            @endif
                            {!! BootForm::text('Label *', 'label')->placeholder('Menu label'); !!}
                            {!! BootForm::text('Slug *', 'link')->placeholder('Menu link'); !!}
                            {!! BootForm::text('Icon *', 'icon')->placeholder('Menu icon'); !!}
                            {!! BootForm::select('Parent', 'parent')->options([ '0' => 'Choisir etablissement' ] + $menus); !!}
                            {!! BootForm::text('Sort *', 'sort')->placeholder('Menu sort'); !!}
                            {!! BootForm::submit('Enregistrer','btn btn-sm btn-info btn-flat pull-right') !!}
                            {!! BootForm::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
