@extends('page')

@section('htmlheader_title')
    {{ t('Add new Local') }}
@endsection

@section('main-content')
    <div class="container-fluid spark-screen">
        <div class="row">
            <div class="col-sm-12">
                <div class="wrap-fpanel">
                    <div class="panel panel-default" data-collapsed="0">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <strong>{{ t('Add Local') }}</strong>
                            </div>
                        </div>
                        <div class="panel-body">
                            @if(!empty($local->id))
                                {!! BootForm::openHorizontal(['sm'=>[2, 5]])->action( route('local.update', $local) )->put() !!}
                                {!! BootForm::bind($local) !!}
                            @else
                                {!! BootForm::openHorizontal(['sm'=>[2, 5]])->action( route('local.store') )->post()->enctype('multipart/form-data') !!}
                            @endif
                            {!! BootForm::text(t('Identification du Local'), 'libelle')->placeholder(t('Identification du Local')); !!}
                            {!! BootForm::textarea(t('Adresse'), 'adress')->rows(3)->cols(80)->placeholder(t('Adresse')) !!}
                            {!! BootForm::checkbox(t('Meublé'), 'meuble'); !!}
                            {!! BootForm::textarea(t('Informations complémentaires'), 'note')->rows(3)->cols(80)->placeholder(t('Informations complémentaires')) !!}
                            {!! BootForm::text(t('Surface (m²)'), 'surface')->placeholder(t('Surface (m²)')); !!}
                            {!! BootForm::text(t('Nombre de pièces principales'), 'nbpiece')->placeholder(t('Nombre de pièces principales')); !!}
                            {!! BootForm::select(t('Consistance'), 'consistance_id')->options([ '' => t('-- Choisir --')]+$consistances)->required(); !!}
                            {!! BootForm::select(t('Immeuble'), 'category_id')->options([ '' => t('Choisir Immeuble') ] + $categories); !!}

                            {!! BootForm::submit(t('Enregistrer'),'btn btn-sm btn-info btn-flat pull-right') !!}
                            {!! BootForm::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
