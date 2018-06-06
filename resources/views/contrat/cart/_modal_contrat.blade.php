
<div class="modal-header box-header-background with-border">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title">Gérer le contrat de: <b></b></h4>
</div>
@if(!empty($contrat->id))
    {!! BootForm::openHorizontal(['sm'=>[4, 8]])->action( route('contrat.update', $contrat) )->put() !!}
    {!! BootForm::bind($contrat) !!}
    {!! BootForm::hidden('code')->id('code') !!}
    <?php $code = $contrat->code; ?>
    {!! BootForm::hidden('locataire_id')->id('locataire_id')->value($contrat->locataire->id) !!}
    {!! BootForm::hidden('local_id')->id('local_id')->value($contrat->local->id) !!}
@else
    {!! BootForm::openHorizontal(['sm'=>[4, 8]])->action( route('contrat.store') )->post()->enctype('multipart/form-data') !!}
    {!! BootForm::hidden('code')->id('code')->value(time()) !!}
    <?php $code = time(); ?>
    {!! BootForm::hidden('locataire_id')->id('locataire_id')->value($locataire->id) !!}
    {!! BootForm::hidden('local_id')->id('local_id')->value($local->id) !!}
@endif
<div class="modal-body">

        <div class="box-body">
            <!-- Table -->

            {!! BootForm::hidden('user_id')->id('user_id')->value(Auth::id()) !!}

            {!! BootForm::text(t('N° Contrat'), 'code_contrat')->value($code)->disabled() !!}
            {!! BootForm::text(t('Local'), 'local_id')->value($local->libelle)->disabled() !!}
            {!! BootForm::date(t('Date d\'entrée'), 'date_in')->placeholder(t('dd/mm/YYYY')) !!}
            {!! BootForm::checkbox(t('Date de sorti connu'), 'cbx_out_date')->id('cbx_out_date') !!}
            <div id="date_out" style="display: none">
                {!! BootForm::date(t('Date Sorti'), 'date_out')->placeholder(t('dd/mm/YYYY')) !!}
            </div>
            {!! BootForm::text(t('Loyer nu'), 'loyer_nu')->value(0) !!}
            @php
                $periodicite = [
                ''  => t( '-- Choisir --' ),
                '2' => t( 'Mensuel' ),
                '3' => t( 'Bimestriel' ),
                '4' => t( 'Trimestriel' ),
                '5' => t( 'Semestriel' ),
                '6' => t( 'Annuel' )
            ];
            @endphp
            {!! BootForm::select(t('Périodicité'), 'periodicite')->options($periodicite)->required() !!}
            {!! BootForm::text(t('Dépôt de garantie'), 'depot_gar')->value(0) !!}
            {!! BootForm::date(t('Versé le'), 'date_pay')->placeholder(t('dd/mm/YYYY')) !!}
            @php
                $mode = [
                '1' => t( '-- Choisir --' ),
                '2' => t( 'Chèque' ),
                '3' => t( 'Virement' ),
                '4' => t( 'Prélèvement' ),
                '5' => t( 'Espèces' ),
                '6' => t( 'Carte bancaire' ),
                '7' => t( 'Aucun règlement' )
            ];
            @endphp
            {!! BootForm::select(t('Mode'), 'mode_pay')->options($mode)->required() !!}
            {!! BootForm::select(t('Etat'), 'etat')->options([ '' => t('-- Choisir --'), '1' => t('En Cours'), '2' => t('En Attente'), '3' => t('Fermer')])->required() !!}
            {!! BootForm::textarea(t('Informations complémentaires'), 'note')->rows(5)->cols(80) !!}

        </div><!-- /.box-body -->

</div>
<div class="modal-footer">

    {!! BootForm::submit('Enregistrer','btn btn-sm btn-primary btn-flat pull-right') !!}
</div>
{!! BootForm::close() !!}
