<div class="modal-header box-header-background with-border">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title">Gérer le Mandat de: <b>{{ $proprietaire->prenom .' '.$proprietaire->nom }}</b></h4>
</div>
@if(!empty($mandat->id))
    {!! BootForm::openHorizontal(['sm'=>[4, 8]])->action( route('mandat.update', $ùandat) )->put() !!}
    {!! BootForm::bind($mandat) !!}
@else
    {!! BootForm::openHorizontal(['sm'=>[4, 8]])->action( route('mandat.store') )->post()->enctype('multipart/form-data') !!}
    {!! BootForm::hidden('code')->id('code')->value(time()) !!}
@endif
<div class="modal-body">
    <div class="box-body">
    @php
        $periodicite = [
        ''  => t( '-- Choisir --' ),
        '2' => t( 'Mensuel' ),
        '3' => t( 'Bimestriel' ),
        '4' => t( 'Trimestriel' ),
        '5' => t( 'Semestriel' ),
        '6' => t( 'Annuel' )];
        $mode = [
        '' => t( '-- Choisir --' ),
        '1' => t( 'En cours' ),
        '2' => t( 'Fermer' ),
        '3' => t( 'En attente' )];
    @endphp
    <!-- Table -->
        {!! BootForm::hidden('proprietaire_id')->id('proprietaire_id')->value($proprietaire->id) !!}
        {!! BootForm::hidden('local_id')->id('local_id')->value($local->id) !!}
        {!! BootForm::hidden('user_id')->id('user_id')->value(Auth::id()) !!}

        {!! BootForm::text(t('Local'), 'local_id')->value($local->libelle)->disabled() !!}
        {!! BootForm::date(t('Date debut'), 'dd')->placeholder(t('dd/mm/YYYY')) !!}
        {!! BootForm::checkbox(t('Date de fin connu'), 'cbx_out_date')->id('cbx_out_date') !!}
        <div id="date_out" style="display: none">
            {!! BootForm::date(t('Date Fin'), 'df')->placeholder(t('dd/mm/YYYY')) !!}
        </div>
        {!! BootForm::text(t('Loyer nu'), 'loyer_nu')->value(0) !!}
        {!! BootForm::select(t('Périodicité'), 'periodicite')->options($periodicite)->required() !!}
        {!! BootForm::select(t('Mode'), 'etat')->options($mode)->required() !!}
        {!! BootForm::checkbox(t('Charge'), 'charge_ded')->id('charge_ded') !!}
        {!! BootForm::textarea(t('Informations complémentaires'), 'note')->rows(5)->cols(80) !!}

    </div><!-- /.box-body -->

</div>
<div class="modal-footer">

    {!! BootForm::submit('Enregistrer','btn btn-sm btn-primary btn-flat pull-right') !!}
</div>
{!! BootForm::close() !!}
