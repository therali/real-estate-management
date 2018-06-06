<table class="table table-bordered table-hover" id="dataTables-example">
    <thead><!-- Table head -->
    <tr>
        <th class="active col-sm-1" style="width: 1%">N°</th>
        <th class="active col-sm-5">Local</th>
        <th class="active col-sm-2">Période</th>
        <th class="active col-sm-2">Loyer nu</th>
        <th class="active col-sm-1">Etat</th>
        <th class="active col-sm-1">Action</th>
    </tr>
    </thead><!-- / Table head -->
    <tbody><!-- / Table body -->

    @php
        $check_proprietaire = session()->get( 'checkProprietaire' );
        $counter = 1;
        if ( session()->has( 'addCartMandat' ) ) {
            $locals_mandat = session()->get( 'addCartMandat' );
        }
    @endphp

    @php $counter = 1; @endphp
    @if (!empty($mandats))
        @foreach ($mandats as $mandat)

            <tr class="mandat-tr">
                <td class="vertical-td"> {{ $counter }}</td>
                <td class="vertical-td"> {{ $mandat->local->libelle }}</td>
                <td class="vertical-td"><input type="text" class="form-control" name="dd" data-format="yyyy/mm/dd"
                                               value="{{ $mandat->dd }}" disabled>
                    <input type="text" class="form-control" name="df" data-format="yyyy/mm/dd"
                           value="{{ $mandat->df }}" disabled></td>


                <td class="vertical-td">{{ $mandat->loyer_nu }}</td>
                <td class="vertical-td">{!! get_etat($mandat->etat) !!}</td>

                <td class="vertical-td">
                    <a type="button" class="jquery-postback btn btn-danger btn-xs" title="Supprimer"
                       href="javascript:checkDelete('{{ route('mandat.destroy', $mandat) }}', '{{ csrf_token() }}');">
                        <i class="fa fa-trash-o"></i></a>
                </td>
            </tr>
            @php $counter ++; @endphp
        @endforeach<!--get all sub category if not this empty-->
    @endif
    @if (!empty($locals_mandat))
        @foreach ($locals_mandat as $local)
            <tr class="mandat-tr">
                <td class="vertical-td">{{ $counter }}</td>
                <td class="vertical-td">{{ $local->libelle }}</td>
                <td class="vertical-td">- - -</td>

                <td class="vertical-td">- - -</td>
                <td class="vertical-td">
                    @if(!empty($check_proprietaire))
                        <a data-toggle="modal" class="btn btn-success btn-xs"
                           href="{{ route('mandat.view-mandat', [$local, $check_proprietaire]) }}"
                           data-target="#myModal">
                            <i class="fa fa-folder-open-o"></i>
                        </a>
                    @endif
                    <a type="button" class="jquery-postback btn btn-danger btn-xs" title="Supprimer"
                       href="javascript:checkDelete('{{ route('mandat.forget-local', $local) }}', '{{ csrf_token() }}');">
                        <i class="fa fa-trash-o" ></i></a>
                </td>
            </tr>
            @php $counter ++; @endphp
        @endforeach
    @endif
    <tr>
        <td colspan="3" class="text-right active">
            <strong>Grand Total: </strong>
        </td>
        <td colspan="3" class="text-left active">
            <strong> ---</strong>
        </td>
    </tr>
    <tr>
        <td colspan="3" class="text-right active">
        </td>
        <td colspan="3" class="text-left active">
            <button type="submit" id="btn_purchase" class="btn bg-navy btn-block " type="submit">Achat
            </button>
        </td>
    </tr>
    @if ($counter == 1) <!--get error message if this empty-->
    <td colspan="6">
        <strong>{{ t('no_data') }}</strong>
    </td><!--/ get error message if this empty-->
    @endif
    </tbody><!-- / Table body -->
</table> <!-- / Table -->
