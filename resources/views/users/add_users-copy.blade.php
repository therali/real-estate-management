@extends('page')

@section('htmlheader_title')
    {{ trans('Add new User') }}
@endsection


@section('main-content')


    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header box-header-background with-border">
                        <div class="col-md-offset-1">
                            <h3 class="box-title">Créer Utilisateur</h3>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    @if($user_edit->id)
                        {!! BootForm::open(['sm'=>[3, 5],'sm'=>[3, 6]])->action( route('users.update', $user_edit) )->put() !!}
                        {!! BootForm::bind($user_edit) !!}
                    @else
                        {!! BootForm::open(['sm'=>[3, 5],'sm'=>[3, 6]])->action( route('users.store') )->post()->enctype('multipart/form-data') !!}
                    @endif
                    <div class="row">
                        <div class="col-md-5 col-md-offset-1 border-right">
                            <div class="box-body">
                                {!! BootForm::text('Nom *', 'name')->placeholder(trans('message.fullname')); !!}
                                @if (config('auth.providers.users.field','email') === 'username')
                                    {!! BootForm::text(trans('message.username').' *', 'username')->placeholder(trans('message.username')); !!}
                                @endif
                                {!! BootForm::email(trans('message.email').' *', 'email')->placeholder(trans('message.email')); !!}
                                {!! BootForm::text(trans('message.phone').' *', 'phone')->placeholder(trans('message.phone')); !!}
                                <div id="password_div" style="{!! (!empty($user_edit->id) ? 'display: none' : '') !!}">
                                    {!! BootForm::password(trans('message.password'), 'password')->placeholder(trans('message.password')); !!}
                                    {!! BootForm::password(trans('message.retypepassword'), 'password_confirmation')->placeholder(trans('message.retypepassword')); !!}
                                </div>
                                {!! BootForm::hidden('password_flag')->id('password_flag')->value('no'); !!}
                                @if (!empty($user_edit->id))
                                    <div class="form-group">
                                        <div class="col-sm-offset-3 col-sm-6">
                                            <input type=button id="change_password" class="btn bg-purple"
                                                   value='Change Password' onclick="setVisibility();">
                                        </div>
                                    </div>
                                @endif
                                {!! BootForm::select("Type d'utilisateur", 'sort')->options([ "3" => "Selectionner le Type d'Utilisateur", "1" => "Administrateur", "0" => "Utilisateur",  ]); !!}
                            </div>
                            <div class="box-footer">
                                {!! BootForm::submit('Enregistrer','btn btn-primary btn-flat pull-right') !!}
                            </div>
                        </div>
                        <div class="col-md-5 col-md-offset-1">
                            <div id="roll">
                                <div class="box-body">
                                    <h4>Accès utilisateur :</h4>
                                    <div class="k-header">
                                        <div class="box-col">
                                            <div id="treeview"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <script>
                                $("#treeview").kendoTreeView({
                                    checkboxes: {
                                        checkChildren: true,
                                        template: "<input type='checkbox' #= item.check# name='menu[]' value='#= item.value #'/>"

                                    },
                                    check: onCheck,
                                    dataSource: [
                                        {
                                            id: "", text: "Tableau de bord", value: "1"
                                        },
                                        {
                                            id: "", text: "Paramètres", value: "2", expanded: false, items: [
                                                {
                                                    id: "", text: "Profil de l'entreprise", value: "3",
                                                },
                                                {
                                                    id: "", text: "Gérer les Taxes fiscales", value: "17",
                                                },
                                            ]
                                        },

                                        {
                                            id: "", text: "Produit", value: "7", expanded: false, items: [
                                                {
                                                    id: "", text: "Catégorie", value: "8", expanded: false, items: [
                                                        {
                                                            id: "", text: "Catégorie de Produit", value: "9",
                                                        },
                                                        {
                                                            id: "", text: "Sous Catégorie", value: "10",
                                                        },
                                                    ]
                                                },
                                                {
                                                    id: "", text: "Ajouter Produit", value: "13",
                                                },
                                                {
                                                    id: "", text: "Gérer Produit", value: "14",
                                                },
                                                {
                                                    id: "", text: "Produit Endommagé", value: "28",
                                                },
                                                {
                                                    id: "", text: "Imprimer CodeBare", value: "29",
                                                },
                                            ]
                                        },
                                        {
                                            id: "", text: "Vente Journalier", value: "41"
                                        },
                                    ]
                                });


                                // function that gathers IDs of checked nodes
                                function checkedNodeIds(nodes, checkedNodes) {
                                    for (var i = 0; i < nodes.length; i++) {
                                        if (nodes[i].checked) {
                                            checkedNodes.push(nodes[i].id);
                                        }

                                        if (nodes[i].hasChildren) {
                                            checkedNodeIds(nodes[i].children.view(), checkedNodes);
                                        }
                                    }
                                }

                                // show checked node IDs on datasource change
                                function onCheck() {
                                    var checkedNodes = [],
                                        treeView = $("#treeview").data("kendoTreeView"),
                                        message;

                                    checkedNodeIds(treeView.dataSource.view(), checkedNodes);

                                    if (checkedNodes.length > 0) {
                                        message = "IDs of checked nodes: " + checkedNodes.join(",");
                                    } else {
                                        message = "No nodes checked.";
                                    }

                                    $("#result").html(message);
                                }
                            </script>

                            <script type="text/javascript">

                                $(function () {
                                    $("#treeview .k-checkbox input").eq(0).hide();
                                    $('form').submit(function () {
                                        $("#treeview :checkbox").each(function () {
                                            if (this.indeterminate) {
                                                this.checked = true;
                                            }
                                        });
                                    })
                                });
                            </script>
                            <script>
                                $(document).ready(function () {

                                    var user_flag = document.getElementById("user_type").value;
                                    if (user_flag == '' || user_flag == '0') {
                                        $("#roll").show();
                                    }
                                    else {
                                        $("#roll").hide();
                                    }

                                    // on change user type select action
                                    $('#user_type').on('change', function () {
                                        if (this.value == '0' || this.value == '')
                                        //.....................^.......
                                        {
                                            $("#roll").show();
                                        }
                                        else {
                                            $("#roll").hide();
                                        }
                                    });
                                });

                            </script>

                        </div>
                        <!-- /.box-body -->
                    </div>
                    {!! BootForm::hidden('user_id')->id('user_id')->value($user_edit->id); !!}
                    {!! BootForm::close() !!}

                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
@endsection

@section('stylecss')
    <script type="text/javascript" src="{{ url('/js/jquery.min.js') }}"></script>
    <link rel="stylesheet" href="{{ url('/css/kendo.default.min.css') }}">
    <link rel="stylesheet" href="{{ url('/css/kendo.common.min.css') }}">
    <script type="text/javascript" src="{{ url('/js/kendo.all.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('/js/ajax.js') }}"></script>
@endsection
