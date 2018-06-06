@extends('page')

@section('htmlheader_title')
    {{ trans('Add new Menu') }}
@endsection

@section('main-content')
    <div class='container'>
        <div class='hero-unit'>
            <h3>
                <a data-placement="top" data-toggle="tooltip" title="Add Menu" href="{{ route('navigation.create') }}"
                   data-original-title="Add Menu">
                    <i class="fa fa-plus"></i> Add Menu
                </a>
            </h3>
        </div>
    </div>
    <hr/>
    <div class="row">
        <div class="col-sm-12 std_print" data-spy="scroll" data-offset="0">
            <div class="panel panel-default">
                <!-- Default panel contents -->
                <div class="panel-heading">
                    <div class="panel-title">
                        <strong>Manage Navigation</strong>
                    </div>
                </div>
                <table class="table table-bordered table-hover" id="dataTables-example">
                    @if(!empty($menus))
                        <thead>
                        <tr class="active">
                            <th class="col-sm-1">SL</th>
                            <th>Label</th>
                            <th>Slug</th>
                            <th>Icon</th>
                            <th>Parent</th>
                            <th>Sort</th>
                            <th class="">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($menus as $menu)
                            <tr>
                                <td>{{ $menu->id }}</td>
                                <td>{{ $menu->label }}</td>
                                <td>{{ $menu->link }}</td>
                                <td><i class="{{ $menu->icon }}"></i></td>
                                <td>{{ $menu->parent }}</td>
                                <td>{{ $menu->sort }}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="...">
                                        <a type="button" class="btn btn-success btn-xs"
                                           href="{{ route('navigation.edit', $menu) }}"><i
                                                    class="fa fa-pencil-square-o"></i> Edit</a>

                                        <a type="button" class="jquery-postback btn btn-danger btn-xs"
                                           href="javascript:checkDelete('{{ route('navigation.destroy', $menu) }}', '{{ csrf_token() }}');">
                                            <i class="fa fa-times"></i> Delete</a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        @else
                            <td colspan="3">
                                <strong>no_data!</strong>
                            </td>
                        @endif
                        </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('scriptjs')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).on('click', 'a.jquery-postback', function (e) {
            e.preventDefault();
            var $this = $(this);
            jQuery.ajax({
                type: "DELETE",
                url: $this.attr('href'),
                dataType: "json",
                success: function (menus) {
                    $("tbody").empty();
                    menus.forEach(function (m) {
                        $("tbody").append("<tr><td>" + m.id + "</td><td>" + m.label + "</td><td>" + m.link + "</td><td><i class=" + m.icon + "></i></td><td>" + m.parent + "</td><td>" + m.sort + "</td><td><div class=\"btn-group\" role=\"group\" aria-label=\"...\"><a type=\"button\" class=\"btn btn-success btn-xs\" href=\"navigation/" + m.id + "/edit\"> <i class=\"fa fa-pencil-square-o\"></i> Edit</a><a type=\"button\" class=\"jquery-postback btn btn-danger btn-xs\" href=\"navigation/" + m.id + "\" data-method=\"delete\"><i class=\"fa fa-times\"></i> Delete</a></div></td></tr>");
                    });
                }
            });
        });

    </script>
@endsection

