@extends('page')

@section('htmlheader_title')
    {{ t('Ajout Locataire') }}
@endsection


@section('main-content')
    <div class="container-fluid spark-screen">
        <div class="row">
            <div class="col-sm-12">
                <div class="wrap-fpanel">
                    <div class="panel panel-default" data-collapsed="0">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <strong>{{ t('Ajout Locataire') }}</strong>
                            </div>
                        </div>
                        <div class="panel-body">
                            @if(!empty($locataire->id))
                                {!! BootForm::openHorizontal(['sm'=>[3, 5],'sm'=>[3, 6]])->action( route('locataire.update', $locataire) )->put() !!}
                                {!! BootForm::bind($locataire) !!}
                            @else
                                {!! BootForm::openHorizontal(['sm'=>[3, 5],'sm'=>[3, 6]])->action( route('locataire.store') )->post()->enctype('multipart/form-data') !!}
                            @endif
                                {!! BootForm::text(t('Prénom'), 'prenom')->placeholder(t('Prénom')); !!}
                                {!! BootForm::text(t('Nom'), 'nom')->placeholder(t('Nom')); !!}
                                {!! BootForm::text(t('Téléphone 1'), 'tel1')->placeholder(t('Téléphone 1')); !!}
                                {!! BootForm::text(t('Téléphone 2'), 'tel2')->placeholder(t('Téléphone 2')); !!}
                                {!! BootForm::email(t('Email'), 'email')->placeholder(t('Email')); !!}
                                {!! BootForm::textarea(t('Adresse'), 'adresse')->rows(5)->cols(80) !!}
                                {!! BootForm::textarea(t('Informations complémentaires'), 'note')->rows(5)->cols(80) !!}

                                {!! BootForm::submit('Enregistrer','btn btn-sm btn-info btn-flat pull-right') !!}
                                {!! BootForm::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
