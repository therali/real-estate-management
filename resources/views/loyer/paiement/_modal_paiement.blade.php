<div class="modal-header box-header box-header-background with-border">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title">{!!  t('Paiement de loyer').' : <b>'.$loyer->libelle.'</b>' !!}</h4>
</div>
<div class="modal-body">
    {!! BootForm::openHorizontal(['sm'=>[4, 8]])->action( route('paiement.store') )->post()->enctype('multipart/form-data') !!}
    {{--{!! BootForm::hidden('code')->id('code')->value(time()) !!}--}}
    {!! BootForm::hidden('loyer_id')->id('loyer_id')->value($loyer->id) !!}
    <div class="row">
        <div class="col-sm-4">
            @php
                $locataire = $loyer->contrat->locataire;
            @endphp

            {!! BootForm::text('Loyer', 'libelle')->class('form-control unite')->value($loyer->libelle)->disabled() !!}
            {!! BootForm::text('Locataire', 'prenom')->class('form-control unite')->value($locataire->prenom . " " . $locataire->nom)->disabled() !!}
            {!! BootForm::text('Téléphone', 'tel1')->class('form-control unite')->value($locataire->tel1)->disabled() !!}
            {!! BootForm::text('Local', 'loyer_nu')->class('form-control unite')->value($loyer->contrat->local->libelle)->disabled() !!}

        </div>
        <div class="col-sm-4">

            {!! BootForm::text('Loyer Nu', 'loyer_nu')->class('form-control unite')->value(nb_format($loyer->contrat->loyer_nu) .' F' )->disabled() !!}
            {!! BootForm::text('De', 'dd')->class('form-control unite')->value(form_date($loyer->dd))->disabled() !!}
            {!! BootForm::text('Au', 'df')->class('form-control unite')->value(form_date($loyer->df))->disabled() !!}
            {!! BootForm::text('Avant', 'echeance')->class('form-control unite')->value(form_date($loyer->echeance))->disabled() !!}

        </div>
        <div class="col-sm-4">
            {!! BootForm::text(t('Montant'), 'montant')->required() !!}
            {!! BootForm::date(t('Date'), 'date_pay')->required() !!}
            @php
                $mode = [ '' => t( '-- Choisir --' ), '2' => t( 'Chèque' ), '3' => t( 'Virement' ), '4' => t( 'Prélèvement' ), '5' => t( 'Espèces' ), '6' => t( 'Carte bancaire' ), '7' => t( 'Aucun règlement' )];
            @endphp
            {!! BootForm::select(t('Mode'), 'mode_pay')->options($mode)->required() !!}
            {!! BootForm::select(t('Payé par'), 'payer_par')->options(['lui-même'=>'Payé par lui-même', 'Par autre personne' => 'Par autre personne'])->required() !!}

            {!! BootForm::submit('Enregistrer','btn btn-sm btn-primary btn-flat pull-right') !!}
        </div>
    </div>
{!! BootForm::close() !!}
<!-- Table -->
    <table id="tab_locataire" class="table table-bordered table-striped dataTable" role="grid">
        <thead><!-- Table head -->
        <tr>
            <th style="width:1%">N°</th>
            <th>{{ t('Montant') }}</th>
            <th>{{ t('Date') }}</th>
            <th>{{ t('Mode') }}</th>
            <th>{{ t('Payé par') }}</th>
            <th style="width:2%">{{ t('Action') }}</th>
        </tr>
        </thead><!-- / Table head -->
        <tbody>
        <?php $key = 1 ?>
        @if (count( $loyer->paiements ))
            @foreach ($loyer->paiements as $paiement)
                <tr>
                    <td>{{ $key }}</td>
                    <td>{{ $paiement->montant }}</td>
                    <td>{{ $paiement->date_pay }}</td>
                    <td>{{ $paiement->mode_pay }}</td>
                    <td>{{ $paiement->payer_par }}</td>
                    <td>
                        <div class="btn-group" role="group" aria-label="...">
                            <a type="button" class="jquery-postback btn btn-danger btn-xs"
                               href="#"><i class="fa fa-search"></i></a>
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



