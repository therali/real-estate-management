@extends('page')

@section('htmlheader_title')
    {{ t('Locaux en Location') }}
@endsection

@section('main-content')
    <section class="content">
        <div class="row">
            <div class="col-md-12">

                <div class="box box-primary ">
                    <div class="box-header box-header-background with-border">
                        <h3 class="box-title ">{{ t('Locaux en Location') }}</h3>
                    </div>

                    <div class="box-body">
                        <!-- Table -->
                        <table id="tab_local" class="table table-bordered table-striped dataTable" role="grid">
                            <thead><!-- Table head -->
                            <tr>
                                <th class="col-sm-1">N°</th>
                                <th class="col-sm-2">{{ t('Identification du Local') }}</th>
                                <th class="col-sm-3">{{ t('Adresse') }}</th>
                                <th class="col-sm-1">{{ t('Nombre de pièces') }}</th>
                                <th class="col-sm-1">{{ t('Occupation') }}</th>
                                <th class="col-sm-2">{{ t('Action') }}</th>

                            </tr>
                            </thead><!-- / Table head -->
                            <tbody>
                            <?php $key = 1 ?>
                            @if (count( $locals ))
                                @foreach ($locals as $local)
                                    <tr>
                                        <td>{{ $key }}</td>
                                        <td>{{ $local->libelle }}</td>
                                        <td>{{ $local->adresse }}</td>
                                        <td>{{ $local->nbpiece }}</td>
                                        <td><span class="label label-warning">Vacant</span></td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="...">
                                                <a type="button" class="btn btn-success btn-xs"
                                                   href="{{ route('local.edit', $local) }}">
                                                    <i class="fa fa-pencil-square-o"></i> Edit</a>
                                                <a type="button" class="jquery-postback btn btn-danger btn-xs"
                                                   href="javascript:checkDelete('{{ route('local.destroy', $local) }}', '{{ csrf_token() }}');">
                                                    <i class="fa fa-times"></i> Delete</a>
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
            $('#tab_local').DataTable({
                'paging': true,
                'lengthChange': false,
                'searching': false,
                'ordering': true,
                'info': true,
                'autoWidth': false
            })
        });
    </script>
@endsection