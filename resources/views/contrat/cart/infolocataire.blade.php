<div class="box-body">

    <div class="row">

        <div class="col-md-6">
            <button type="button" class="btn btn btn-info" data-toggle="modal" data-target="#modal-default">
                <i class="fa fa-user-circle-o"></i> Choisir Locataire
            </button>
        </div>
    </div>
</div>

@if ( session()->has( 'checkLocataire' ) )
<?php $check_locataire = session()->get( 'checkLocataire' );?>
@endif
@if(!empty($check_locataire))
    <div class="box-background">
        <div class="box-background" id="order">
            <div class="box-body">
                <div class="row">

                    <div class="form-group">
                        <label class="col-sm-4 control-label">Nom</label>

                        <div class="col-sm-8">
                            <input type="text" value="{{ $check_locataire->prenom . " " . $check_locataire->nom }}"
                                   disabled class="form-control unite">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Téléphone</label>

                        <div class="col-sm-8">
                            <input type="text" value="{{ $check_locataire->tel1 }}" disabled class="form-control unite">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Adresse</label>

                        <div class="col-sm-8">
                            <input type="text" value="{{ $check_locataire->adresse }}" disabled
                                   class="form-control unite">
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endif
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
                    @if (count( $locataires ))
                        @foreach ($locataires as $locataire)
                            <tr>
                                <td>{{ $key }}</td>
                                <td>{{ $locataire->prenom }} {{ $locataire->nom }}</td>
                                <td>{{ $locataire->tel1 }} <br> {{ $locataire->tel2 }}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="...">
                                        <a type="button" class="jquery-postback btn btn-danger btn-xs"
                                           href="{{ route('contrat.check_locataire', $locataire) }}">
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
<!-- /.modal -->

