@extends('page')

@section('htmlheader_title')
    {{ t('Historique des mandat') }}
@endsection

@section('main-content')
    <section class="content">
        <div class="row">
            <div class="col-md-12">

                <div class="box box-primary ">
                    <div class="box-header box-header-background with-border">
                        <h3 class="box-title ">{{ t('Historique des mandat') }}</h3>
                    </div>

                    <div class="box-body">
                        <!-- Table -->
                        <table id="tab_loyer" class="table table-bordered table-striped dataTable" role="grid">
                            <thead><!-- Table head -->
                            <tr>
                                <th class="col-sm-1" style="width: 1%">N°</th>
                                <th class="col-sm-1">{{ t('Code') }}</th>
                                <th class="col-sm-2">{{ t('Identification du Local') }}</th>
                                <th class="col-sm-2">{{ t('Nom du Locataire') }}</th>
                                <th class="col-sm-1">{{ t('Loyer') }}</th>
                                <th class="col-sm-1">{{ t('Etat') }}</th>
                                <th class="col-sm-1">{{ t('Montant') }}</th>
                                <th class="col-sm-1">{{ t('Echéance') }}</th>
                                <th class="col-sm-1">{{ t('Ajouté Par') }}</th>
                                <th class="col-sm-1">{{ t('Action') }}</th>

                            </tr>
                            </thead><!-- / Table head -->
                            <tbody>
                            @php $key = 1; @endphp
                            @if (count( $loyers ))
                                @foreach ($loyers as $loyer)
                                    <tr>
                                        <td class="vertical-td">{{ $key }}</td>
                                        <td class="vertical-td">{{ $loyer->code }}</td>
                                        <td class="vertical-td">{{ $loyer->contrat->local->libelle }}</td>
                                        <td class="vertical-td"><b>{{ $loyer->contrat->locataire->prenom.' '.$loyer->contrat->locataire->nom }}</b><br/>{{ 'Tel: '.$loyer->contrat->locataire->tel1 }}</td>
                                        <td class="vertical-td">{{ $loyer->libelle }}</td>
                                        <td class="vertical-td">
                                            @if($loyer->getEtatLoyer() == 0)
                                                <span class="label label-danger">Non Payé</span>
                                            @elseif($loyer->getEtatLoyer() == 1)
                                                <span class="label label-success">Payé</span>
                                            @elseif($loyer->getEtatLoyer() == 3)
                                                <span class="label label-primary">Payé+</span>
                                            @else
                                                <span class="label label-warning">En cours</span>
                                            @endif
                                        </td>
                                        <td class="vertical-td">{{ nb_format($loyer->montant) }} F</td>
                                        <td class="vertical-td">{{ form_date($loyer->echeance) }}</td>
                                        <td class="vertical-td">{{ $loyer->user->name }}</td>
                                        <td class="vertical-td">
                                            <a href="{{ route('loyer.add_paiement', $loyer) }}"
                                               class="btn bg-blue btn-xs" title="" data-target="#myModal"
                                               data-toggle="modal"
                                               data-placement="top" data-original-title="Payer">
                                                <i class="glyphicon glyphicon-euro"></i>
                                            </a>
                                            <a href="#"
                                               class="btn bg-aqua btn-xs" title="" data-target="#myModal"
                                               data-toggle="modal"
                                               data-placement="top" data-original-title="Payer">
                                                <i class="fa fa-envelope-o"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @php $key ++; @endphp
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
    @include('layouts.modal.modal')
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
            $('#tab_loyer').DataTable();
        });
    </script>
@endsection