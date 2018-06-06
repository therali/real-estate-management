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

    <div class="container-fluid spark-screen">
        <div class="row">
            <div class="col-sm-12">
                <div class="box box-primary">
                    <div class="box-header box-header-background with-border">
                        <h3 class="box-title ">{{ t('Ajouter un contrat de location') }}</h3>
                    </div>
                    <div class="box-body">

                        <div class="row">
                            <div class="col-md-8 col-sm-12">

                                <div class="box  box-warning">
                                    <div class="box-header box-header-background-light with-border">
                                        <h3 class="box-title ">{{ t('Sélectionner un Local') }}</h3>
                                    </div>
                                    <div class="box-body tab-panel">
                                        <ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
                                            <li class="active"><a href="#local-list" data-toggle="tab">Location</a>
                                            </li>
                                            <li><a href="#search-local" data-toggle="tab">Recherche de Local</a></li>
                                        </ul>

                                        <div id="my-tab-content" class="tab-content">
                                            <!-- ***************  Cart Tab Start ****************** -->
                                            <div class="tab-pane active" id="local-list">
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        <form method="post" action="">
                                                            <div class="input-group">
                                                          <span class="input-group-btn">
                                                            <button type="submit" class="btn bg-blue" type="button">CodeBare</button>
                                                          </span>
                                                                <input type="text" name="barcode" class="form-control"
                                                                       placeholder="Scanner CodeBare du Local">
                                                            </div>
                                                        </form>
                                                        <!-- /input-group -->
                                                    </div>
                                                    <!-- /.col-lg-6 -->
                                                </div>
                                                <br/>
                                                <div id="cart_content">
                                                    @include('contrat.cart.cart')
                                                </div>
                                            </div>

                                            <!-- ***************  Add Local Tab Start ****************** -->
                                            <div class="tab-pane" id="search-local">
                                                <form method="post" action="">
                                                    <!-- Table -->
                                                    <table class="table table-bordered table-hover order"
                                                           id="dataTables-local">
                                                        <thead><!-- Table head -->
                                                        <tr>
                                                            <th class="col-sm-1 active" style="width: 5%">N°</th>
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
                                                                           href="{{ route('contrat.addCart', $local) }}">
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
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.box-body -->
                                </div>
                                <!-- /.box -->
                            </div>
                            <!--/.col end -->

                            <!-- *********************** Locataire ************************** -->
                            <div class="col-md-4 col-sm-12">

                                <div class="box">
                                    <div class="box-header with-border box-header-background">
                                        <h3 class="box-title ">Information de Locataire</h3>
                                    </div>

                                    <div id="cart_summary">
                                        @include('contrat.cart.infolocataire')
                                    </div>
                                </div>
                                <!-- /.box -->
                            </div>
                            <!--/.col end -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.box-body -->
                </div>

            </div>
        </div>
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
@endsection

