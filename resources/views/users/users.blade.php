@extends('page')

@section('htmlheader_title')
    {{ trans('Manage users') }}
@endsection

@section('main-content')
    <section class="content">
        <div class="row">
            <div class="col-md-12">

                <div class="box box-primary ">
                    <div class="box-header box-header-background with-border">
                        <h3 class="box-title ">{{ trans('Manage users') }}</h3>
                    </div>

                    <div class="box-body">
                        <!-- Table -->
                        <table id="tab_users" class="table table-bordered table-striped dataTable" role="grid">
                            <thead><!-- Table head -->
                            <tr>
                                <th class="col-sm-1">N°</th>
                                <th>{{ trans('message.name') }}</th>
                                <th class="col-sm-2">Nom d'utilisateur</th>
                                <th class="col-sm-2">Type d'utilisateur</th>
                                <th class="col-sm-2">Action</th>

                            </tr>
                            </thead><!-- / Table head -->
                            <tbody>
                            <?php $key = 1 ?>
                            @if (count( $users ))
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $key }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->username }}</td>
                                        <td><?php echo $user->flag == 1 ? 'Administrateur' : 'Utilisateur' ?></td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="...">
                                                <a type="button" class="btn btn-success btn-xs"
                                                   href="{{ route('users.edit', $user) }}"><i
                                                            class="fa fa-pencil-square-o"></i> Edit</a>
                                                <a type="button" class="jquery-postback btn btn-danger btn-xs"
                                                   href="javascript:checkDelete('{{ route('users.destroy', $user) }}', '{{ csrf_token() }}');">
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
            $('#tab1').DataTable()
            $('#tab_users').DataTable({
                'paging': true,
                'lengthChange': false,
                'searching': false,
                'ordering': true,
                'info': true,
                'autoWidth': false
            })
        })
    </script>
@endsection