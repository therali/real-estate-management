
<div class="modal-header box-header-background with-border">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title">Gérer le contrat de: <b></b></h4>
</div>
    {!! BootForm::openHorizontal(['sm'=>[4, 8]])->action( route('contrat.update', $contrat) )->put() !!}
<div class="modal-body">

        <div class="box-body">
            <!-- Table -->
            {!! BootForm::bind($contrat) !!}
            {!! BootForm::hidden('code')->id('code') !!}

            {!! BootForm::hidden('locataire_id')->id('locataire_id') !!}
            {!! BootForm::hidden('local_id')->id('local_id') !!}
            {!! BootForm::hidden('user_id')->id('user_id') !!}

            {!! BootForm::text(t('N° Contrat'), 'code_contrat')->value($contrat->code)->disabled() !!}
            {!! BootForm::text(t('Local'), 'local.libelle')->disabled() !!}
            {!! BootForm::date(t('Date d\'entrée'), 'date_in')->placeholder(t('dd/mm/YYYY')) !!}
            {!! BootForm::checkbox(t('Date de sorti connu'), 'cbx_out_date')->id('cbx_out_date') !!}
            <div id="date_out" style="display: none">
                {!! BootForm::date(t('Date Sorti'), 'date_out')->placeholder(t('dd/mm/YYYY')) !!}
            </div>
            {!! BootForm::text(t('Loyer nu'), 'loyer_nu') !!}
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
            {!! BootForm::text(t('Dépôt de garantie'), 'depot_gar') !!}
            {!! BootForm::date(t('Versé le'), 'date_pay')->placeholder(t('dd/mm/YYYY')) !!}
            @php
                $mode = [
                '' => t( '-- Choisir --' ),
                '1' => t( 'Espèces' ),
                '2' => t( 'Chèque' ),
                '3' => t( 'Virement' ),
                '4' => t( 'Prélèvement' ),
                '5' => t( 'Carte bancaire' ),
                '6' => t( 'Aucun règlement' )
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
