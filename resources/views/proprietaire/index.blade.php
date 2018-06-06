@extends('page')

@section('htmlheader_title')
    {{ t('Gérer les proprietaires') }}
@endsection

@section('main-content')
    <section class="content">
        <div class="row">
            <div class="col-md-12">

                <div class="box box-primary ">
                    <div class="box-header box-header-background with-border">
                        <h3 class="box-title ">{{ t('Gérer les Propriétaires') }}</h3>
                    </div>

                    <div class="box-body">
                        <!-- Table -->
                        <table id="tab-proprietaire" class="table table-bordered table-striped dataTable" role="grid">
                            <thead><!-- Table head -->
                            <tr>
                                <th style="width:1%">N°</th>
                                <th class="col-sm-3">{{ t('Nom complet') }}</th>
                                <th class="col-sm-2">{{ t('Téléphone') }}</th>
                                <th class="col-sm-1">{{ t('Mail') }}</th>
                                <th class="col-sm-1">{{ t('Ville') }}</th>
                                <th class="col-sm-2">{{ t('Action') }}</th>
                            </tr>
                            </thead><!-- / Table head -->
                            <tbody>
                            <?php $key = 1 ?>
                            @if (!empty( $proprietaires ))
                                @foreach ($proprietaires as $proprietaire)
                                    <tr>
                                        <td>{{ $key }}</td>
                                        <td>{{ $proprietaire->prenom .' '.$proprietaire->nom }}</td>
                                        <td>{{ $proprietaire->tel1 }} <br> {{ $proprietaire->tel1 }}</td>
                                        <td>{{ $proprietaire->email }}</td>
                                        <td>{{ $proprietaire->ville }}</td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="...">
                                                <a type="button" class="btn btn-success btn-xs"
                                                   href="{{ route('proprietaire.edit', $proprietaire) }}"><i
                                                            class="fa fa-pencil-square-o"></i></a>
                                                <a type="button" class="jquery-postback btn btn-danger btn-xs"
                                                   href="javascript:checkDelete('{{ route('proprietaire.destroy', $proprietaire) }}', '{{ csrf_token() }}');">
                                                    <i class="fa fa-times"></i></a>
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
            $('#tab-proprietaire').DataTable()
        });
    </script>
@endsection