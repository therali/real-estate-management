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
                                <strong>{{ trans('Add Category') }}</strong>
                            </div>
                        </div>
                        <div class="panel-body">
                            @if(!empty($category->id))
                                {!! BootForm::openHorizontal(['sm'=>[3, 5],'sm'=>[3, 6]])->action( route('category.update', $category) )->put() !!}
                                {!! BootForm::bind($category) !!}
                            @else
                                {!! BootForm::openHorizontal(['sm'=>[3, 5],'sm'=>[3, 6]])->action( route('category.store') )->post()->enctype('multipart/form-data') !!}
                            @endif
                            {!! BootForm::text(t('Immeuble Name'), 'namecat')->placeholder(t('Immeuble name')); !!}
                            {!! BootForm::text(t('Immeuble Adress'), 'adresse')->placeholder(t('Immeuble Adress')); !!}
                            {!! BootForm::text(t('Immeuble City *'), 'ville')->placeholder(t('Immeuble City')); !!}
                            {!! BootForm::textarea(t('Info'), 'note')->rows(5)->cols(80) !!}

                            {!! BootForm::submit('Enregistrer','btn btn-sm btn-info btn-flat pull-right') !!}
                            {!! BootForm::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
