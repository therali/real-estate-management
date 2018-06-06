<table class="table table-bordered table-hover">
    <thead><!-- Table head -->
    <tr>
        <th class="active col-sm-1">N°</th>
        <th class="active col-sm-3">{{ t('Identification du Local') }}</th>
        <th class="active col-sm-2">{{ t('Loyer') }}</th>
        <th class="active col-sm-1">{{ t('Occupation') }}</th>
        <th class="active col-sm-3">{{ t('Action') }}</th>

    </tr>
    </thead><!-- / Table head -->
    <tbody><!-- / Table body -->
    @php
        $check_locataire = session()->get( 'checkLocataire' );
        $counter = 1;
        if ( session()->has( 'addCart' ) ) {
            $cart = session()->get( 'addCart' );
        }
    @endphp
    @if (!empty($contrats))
        @foreach ($contrats as $contrat)
            <tr class="custom-tr">
                <td class="vertical-td">{{ $counter }}</td>
                <td class="vertical-td">{{ $contrat->local->libelle }}<br>{{ $contrat->local->adress }}</td>
                <td class="vertical-td">{{ $contrat->loyer_nu }}</td>
                <td class="vertical-td"><span class="label label-success">{{ $contrat->etat }}</span></td>
                <td class="vertical-td">
                    <input type="hidden" name="local_id" value="{{ $contrat->local_id }}">


                    <a data-toggle="modal" class="btn btn-primary btn-xs"
                       href="{{ route('contrat.edit', $contrat) }}"
                       data-target="#myModal">
                        <i class="fa fa-edit"></i>
                    </a>

                    <a type="button" title="Supprimer" class="btn btn-danger btn-xs" href="#"><i
                                class="fa fa-remove"></i></a>
                    <a type="button" title="Sortie du lacataire" class="btn btn-adn btn-xs" href="#"><i
                                class="fa fa-desktop"></i></a>
                    <a type="button" title="Payement du location" class="btn btn-primary btn-xs" href="#"><i
                                class="fa fa-euro"></i></a>
                </td>
            </tr>
            @php $counter ++; @endphp
        @endforeach <!--get all sub category if not this empty-->
    @endif
    @if(!empty($cart))
        @foreach($cart as $local)
            <tr class="custom-tr">
                <td class="vertical-td">{{ $counter }}</td>
                <td class="vertical-td">{{ $local->libelle }}</td>
                <td class="vertical-td"></td>
                <td class="vertical-td"></td>
                <td class="vertical-td">
                    <div class="btn-group" role="group" aria-label="...">
                        @if(!empty($check_locataire))
                            <a data-toggle="modal" class="btn btn-success btn-xs"
                               href="{{ route('contrat.view_contrat', [$local, $check_locataire]) }}"
                               data-target="#myModal">
                                <i class="fa fa-folder-open-o"></i>
                            </a>
                        @endif
                        <a type="button" class="jquery-postback btn btn-danger btn-xs"
                           href="javascript:checkDelete('{{ route('contrat.forget-local', $local) }}', '{{ csrf_token() }}');">
                            <i class="fa fa-times"></i></a>
                    </div>
                </td>
            </tr>
            @php $counter ++; @endphp
        @endforeach
        <!--get all sub category if not this empty-->
    @else <!--get error message if this empty-->
    <td colspan="6">
        <strong>{{ t( 'no_data' ) }}</strong>
    </td><!--/ get error message if this empty-->
    @endif
    </tbody><!-- / Table body -->
</table> <!-- / Table -->



