@extends('page')

@section('htmlheader_title')
    {{ t('Historique des mandat') }}
@endsection

@section('main-content')
    <section class="content">
        <div class="row">
            <div class="col-md-12">

                <div class="box box-primary ">
                    <div class="box-header box-header-background with-border">
                        <h3 class="box-title ">{{ t('Historique des mandat') }}</h3>
                    </div>

                    <div class="box-body">
                        <!-- Table -->
                        <table id="tab_local" class="table table-bordered table-striped dataTable" role="grid">
                            <thead><!-- Table head -->
                            <tr>
                                <th class="col-sm-1" style="width: 1%">N°</th>
                                <th class="col-sm-3">{{ t('Identification du Local') }}</th>
                                <th class="col-sm-3">{{ t('Nom du Propriétaire') }}</th>
                                <th class="col-sm-2">{{ t('Période') }}</th>
                                <th class="col-sm-1">{{ t('Loyer') }}</th>
                                <th class="col-sm-1">{{ t('Ajouté Par') }}</th>
                                <th class="col-sm-1">{{ t('Action') }}</th>

                            </tr>
                            </thead><!-- / Table head -->
                            <tbody>
                            @php $key = 1; @endphp
                            @if (count( $mandats ))
                                @foreach ($mandats as $mandat)
                                    <tr>
                                        <td class="vertical-td">{{ $key }}</td>
                                        <td class="vertical-td">{{ $mandat->local->libelle }}</td>
                                        <td class="vertical-td"><b>{{ $mandat->proprietaire->prenom.' '.$mandat->proprietaire->nom }}</b><br/>{{ 'Tel: '.$mandat->proprietaire->tel1 }}</td>
                                        <td class="vertical-td">{{ $mandat->dd.' - '.$mandat->df }}</td>
                                        <td class="vertical-td">{{ $mandat->loyer_nu }}</td>
                                        <td class="vertical-td">{{ $mandat->user->name }}</td>
                                        <td class="vertical-td">
                                                <a href="{{ route('mandat.show', $mandat) }}" class="btn bg-olive btn-xs" data-toggle="tooltip" data-placement="top" title="" data-original-title="Afficher">
                                                    <span class="glyphicon glyphicon-search"></span></a>
                                        </td>
                                    </tr>
                                    @php $key ++; @endphp
                                @endforeach
                            @else
                                <td colspan="3">
                                    <strong>{{ t( 'no_data' ) }}</strong>
                                </td>
                            @endif
                            </tbody><!-- / Table body -->
                        </table> <!-- / Table -->

                    </div><!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!--/.col end -->
        </div>
        <!-- /.row -->
    </section>
@endsection


@section('stylecss')
    <link rel="stylesheet" href="{{ url('/plugins/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection
@section('scriptjs')
    <script src="{{ url('/plugins/datatables.net/js/jquery.dataTables.min.js') }}" type="text/javascript"></script>
    <script src="{{ url('/plugins/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"
            type="text/javascript"></script>
    <script>
        $(function () {
            $('#tab_mandat').DataTable()
        });
    </script>
@endsection