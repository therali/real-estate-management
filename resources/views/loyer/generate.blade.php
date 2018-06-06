@extends('page')

@section('htmlheader_title')
    {{ t('Historique des mandat') }}
@endsection

@section('main-content')
    <div class="container-fluid spark-screen">
        <div class="row">
            <div class="col-md-12">

                <div class="box box-primary">
                    <div class="box-header box-header-background with-border">
                        <div class="col-md-offset-3">
                            <h3 class="box-title ">Rapport des Ventes</h3>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-background">
                        <!-- form start -->
                        {!! BootForm::open()->action( route('loyer.generate') )->post()->enctype('multipart/form-data') !!}
                        <div class="row">
                            <div class="col-md-4 col-sm-12 col-xs-12 col-md-offset-3">
                                <div class="box-body">
                                    {!! BootForm::select(t('Année'), 'annee')->options([date('Y') => date('Y')])->required(); !!}
                                    {!! BootForm::select(t('Mois'), 'moi')->options(['' => t('-- Choisir --')]+get_months())->required(); !!}
                                    {!! BootForm::submit('Generer le Loyer','btn bg-navy btn-sm btn-flat') !!}
                                    <br/><br/>
                                </div>
                                <!-- /.box-body -->
                            </div>
                        </div>
                        {!! BootForm::close() !!}
                    </div>
                </div>
                <!--/.col end -->
            </div>
        </div>
    </div>
@endsection
