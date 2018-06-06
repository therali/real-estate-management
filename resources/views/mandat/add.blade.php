@extends('page')
@section('contentheader_description')
    {{ t('Nouvelle contrat') }}
@endsection
@section('contentheader_title')
    {{ t('Processuce de contrat') }}
@endsection
@section('htmlheader_title')
    {{ t('Add new Local') }}
@endsection

@section('main-content')
    @if ( session()->has( 'checkProprietaire' ) )
        <?php $check_proprietaire = session()->get( 'checkProprietaire' );?>
    @endif
    <section class="content">
    <div class="row">
        <div class="col-sm-12">

            <div class="box box-primary">
                <div class="box-header box-header-background with-border">
                    <h3 class="box-title ">Nouveau Mandat</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-5 col-sm-12">
                            <div class="box box-warning">
                                <div class="box-header box-header-background-light with-border">
                                    <h3 class="box-title ">Sélectionner un Local</h3>
                                </div>
                                <div class="box-body tab-panel">
                                    <ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
                                        <li class="active"><a href="#local-list" data-toggle="tab">Liste des Locals</a>
                                        </li>
                                        <li><a href="#add-local" data-toggle="tab">Ajouter Local</a></li>
                                    </ul>

                                    <div id="my-tab-content" class="tab-content">
                                        <!-- ***************  General Tab Start ****************** -->
                                        <div class="tab-pane active" id="local-list">

                                            <!-- Table -->
                                            <table class="table table-bordered table-hover order"
                                                   id="dataTables-local">
                                                <thead><!-- Table head -->
                                                <tr>
                                                    <th class="col-sm-1 active" style="width: 21px">N°</th>
                                                    <th class="active">{{ t('Local') }}</th>
                                                    <th class="active">{{ t('Adresse') }}</th>
                                                    <th class="active">{{ t('Nb. pièces') }}</th>
                                                    <th class="active col-md-1">{{ t('Ajout') }}</th>
                                                </tr>
                                                </thead>

                                                <!-- / Table head -->
                                                <tbody><!-- / Table body -->
                                                <?php $counter = 1; ?>
                                                @if (!empty($locals))
                                                    @foreach ($locals as $local)
                                                        <tr class="custom-tr">
                                                            <td class="vertical-td col-sm-1 ">{{ $counter }}</td>
                                                            <td class="vertical-td col-md-1 ">{{ $local->libelle }}</td>
                                                            <td class="vertical-td">{{ $local->adress }}</td>
                                                            <td class="vertical-td col-md-1 ">
                                                                <span class="label label-warning">{{ $local->nbpiece }}</span>
                                                            </td>
                                                            <td class="vertical-td col-md-1 ">
                                                                <input type="hidden" name="local_id"
                                                                       value="{{ $local->id }}">
                                                                <a type="button" class="btn btn-primary btn-xs"
                                                                   href="{{ route('mandat.addCart', $local) }}">
                                                                    <i class="fa fa-plus"></i></a>
                                                            </td>
                                                        </tr>
                                                        <?php $counter ++; ?>
                                                    @endforeach <!--get all sub category if not this empty-->
                                                @else <!--get error message if this empty-->
                                                <td colspan="6">
                                                    <strong>{{ t('no_data') }}</strong>
                                                </td><!--/ get error message if this empty-->
                                                @endif
                                                </tbody>
                                                <!-- / Table body -->
                                            </table>
                                            <!-- / Table -->

                                        </div>

                                        <!-- ***************  Ajouter Local - Tab Start ****************** -->
                                        <div class="tab-pane" id="add-local">
                                            {!! BootForm::openHorizontal(['sm'=>[4, 8]])->action( route('local.store-for-mandat') )->post()->enctype('multipart/form-data') !!}
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
                                </div><!-- /.box-body -->
                            </div>
                            <!-- /.box -->
                        </div><!--/.col end -->

                        <!-- *********************** Purchase ************************** -->
                        <div class="col-md-7 col-sm-12">
                            <form method="post" action="#">
                                <div class="box box-info">
                                    <div class="box-header box-header-background-light with-border">
                                        <h3 class="box-title">Gérer Mandat</h3>
                                    </div>
                                    <div class="box-background" id="order">
                                        <div class="box-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <button type="button" class=" btn btn btn-info" data-toggle="modal" data-target="#modal-default">
                                                        <i class="fa fa-user-circle-o"></i> Choisir Proprietaire
                                                    </button>
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Proprietaire</label>
                                                    <div class="input-group">
                                                        <input type="text" value="{{ (!empty($check_proprietaire)) ? ($check_proprietaire->prenom . " " . $check_proprietaire->nom) :"" }}"
                                                               disabled class="form-control unite">
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- /.box-body -->
                                    </div>
                                    <div class="box-footer">
                                    </div>
                                    <!-- Table -->
                                    <div id="cart_content">
                                        @include('mandat.cart.cart')
                                    </div>
                                </div>
                                <!-- /.box -->
                            </form>
                        </div>
                        <!--/.col end -->
                    </div>
                    <!-- /.row -->
                </div><!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div><!--/.col end -->
    </div>
    <!-- /.row -->
</section>
    <div class="modal fade modal-wide in" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header box-header box-header-background with-border">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">{{ t('Gérer les locataires') }}</h4>
                </div>
                <div class="modal-body">
                    <!-- Table -->
                    <table id="tab_locataire" class="table table-bordered table-striped dataTable" role="grid">
                        <thead><!-- Table head -->
                        <tr>
                            <th style="width:1%">N°</th>
                            <th>{{ t('Prénom') }} & {{ t('Nom') }}</th>
                            <th>{{ t('Téléphone') }}</th>
                            <th style="width:2%">{{ t('Action') }}</th>

                        </tr>
                        </thead><!-- / Table head -->
                        <tbody>
                        <?php $key = 1 ?>
                        @if (count( $proprietaires ))
                            @foreach ($proprietaires as $proprietaire)
                                <tr>
                                    <td>{{ $key }}</td>
                                    <td>{{ $proprietaire->prenom }} {{ $proprietaire->nom }}</td>
                                    <td>{{ $proprietaire->tel1 }} <br> {{ $proprietaire->tel2 }}</td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="...">
                                            <a type="button" class="jquery-postback btn btn-danger btn-xs"
                                               href="{{ route('mandat.check_proprietaire', $proprietaire) }}">
                                                <i class="fa fa-search"></i></a>
                                        </div>
                                    </td>

                                </tr>
                                <?php $key ++; ?>
                            @endforeach
                        @else
                            <td colspan="3">
                                <strong>{{ t( 'no_data' ) }}</strong>
                            </td>
                        @endif
                        </tbody><!-- / Table body -->
                    </table> <!-- / Table -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    @include('layouts.modal.modal')
@endsection

@section('stylecss')

    <link rel="stylesheet" href="{{ url('/plugins/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection
@section('scriptjs')
    <!-- DataTables -->
    <script type="text/javascript" src="{{ url('plugins/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('plugins/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('/js/ajax.js') }}"></script>
    <script>
        $(function () {
            $('#dataTables-local').DataTable()
        })
        $('#tab_locataire').DataTable()
    </script>

    <script>

        $().ready(function () {
            // validate signup form on keyup and submit
            $("#newform").validate({
                rules: {
                    local_name: "required",
                    qty: "required",

                    local_name: {
                        required: true
                    },
                    qty: {
                        required: true,
                        number: true
                    },

                    price: {
                        required: true,
                        number: true
                    }
                },
                highlight: function (element) {
                    $(element).closest('.form-group').addClass('has-error');
                },
                unhighlight: function (element) {
                    $(element).closest('.form-group').removeClass('has-error');
                },
                errorElement: 'span',
                errorClass: 'help-block',
                errorPlacement: function (error, element) {
                    if (element.parent('.input-group').length) {
                        error.insertAfter(element.parent());
                    } else {
                        error.insertAfter(element);
                    }
                },
                messages: {
                    local_name: {
                        required: "S'il vous plaît entrer le Nom du produit"
                    }
                }
            });
        });
    </script>
@endsection



