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
                    @if(!empty($data['user_edit']->id))
                        {!! BootForm::open(['sm'=>[3, 5],'sm'=>[3, 6]])->action( route('users.update', $data['user_edit']) )->put() !!}
                        {!! BootForm::bind($data['user_edit']) !!}
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
                                <div id="password_div"
                                     style="{!! (!empty($data['user_edit']->id) ? 'display: none' : '') !!}">
                                    {!! BootForm::password(trans('message.password'), 'password')->placeholder(trans('message.password')); !!}
                                    {!! BootForm::password(trans('message.retypepassword'), 'password_confirmation')->placeholder(trans('message.retypepassword')); !!}
                                </div>
                                {!! BootForm::hidden('password_flag')->id('password_flag')->value('no'); !!}
                                @if (!empty($data['user_edit']->id))
                                    {!! BootForm::text('','change_password','Change Password')->type("button")->class("btn bg-purple btn-flat")->onclick("setVisibility();")->hideLabel() !!}

                                @endif
                                @if(!empty($data['user_edit']->sort) && $data['user_edit']->sort == 1)
                                    {!! BootForm::select("Type d'utilisateur", 'sort')->options([ "0" => "Utilisateur", "1" => "Administrateur" ])->disabled(); !!}
                                @else
                                    {!! BootForm::select("Type d'utilisateur", 'sort')->options([ "0" => "Utilisateur", "1" => "Administrateur" ])->required(); !!}
                                @endif
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

                            @if(!empty($data['user_edit']->id))
                                <script>
                                    $("#treeview").kendoTreeView({
                                        checkboxes: {
                                            checkChildren: true,
                                            template: "<input type='checkbox' #= item.check# name='menu[]' value='#= item.value #'/>"

                                        },
                                        check: onCheck,
                                        dataSource: [
                                                <?php foreach ($data['result'] as $parent => $v_parent): ?>
                                                <?php if (is_array( $v_parent )): ?>
                                                <?php foreach ($v_parent as $parent_id => $v_child): ?>
                                            {
                                                id: "", text: "<?php echo $parent; ?>", value: "<?php
                                                    if ( ! empty( $parent_id ) ) {
                                                        echo $parent_id;
                                                    }
                                                    ?>", expanded: false, items: [
                                                        <?php foreach ($v_child as $child => $v_sub_child) : ?>
                                                        <?php if (is_array( $v_sub_child )): ?>
                                                        <?php foreach ($v_sub_child as $sub_chld => $v_sub_chld): ?>
                                                    {
                                                        id: "", text: "<?php echo $child; ?>", value: "<?php
                                                            if ( ! empty( $sub_chld ) ) {
                                                                echo $sub_chld;
                                                            }
                                                            ?>", expanded: false, items: [
                                                                <?php foreach ($v_sub_chld as $sub_chld_name => $sub_chld_id): ?>
                                                            {
                                                                id: "", text: "<?php echo $sub_chld_name; ?>", <?php
                                                                    if ( ! empty( $data['roll'][ $sub_chld_id ] ) ) {
                                                                        echo $data['roll'][ $sub_chld_id ] ? 'check: "checked",' : '';
                                                                    }
                                                                    ?> value: "<?php
                                                                    if ( ! empty( $sub_chld_id ) ) {
                                                                        echo $sub_chld_id;
                                                                    }
                                                                    ?>",
                                                            },
                                                            <?php endforeach; ?>
                                                        ]
                                                    },
                                                        <?php endforeach; ?>
                                                        <?php else: ?>
                                                    {
                                                        id: "", text: "<?php echo $child; ?>", <?php
                                                            if ( ! is_array( $v_sub_child ) ) {
                                                                if ( ! empty( $data['roll'][ $v_sub_child ] ) ) {
                                                                    echo $data['roll'][ $v_sub_child ] ? 'check: "checked",' : '';
                                                                }
                                                            }
                                                            ?> value: "<?php
                                                            if ( ! empty( $v_sub_child ) ) {
                                                                echo $v_sub_child;
                                                            }
                                                            ?>",
                                                    },
                                                    <?php endif; ?>
                                                    <?php endforeach; ?>
                                                ]
                                            },
                                                <?php endforeach; ?>
                                                <?php else: ?>
                                            {
                                                <?php if ($parent == 'Dashboard') {
                                                    ?>
                                                id: "", text: "<?php echo $parent ?>", <?php echo 'check: "checked",';
                                                    ?>  value: "<?php
                                                    if ( ! is_array( $v_parent ) ) {
                                                        echo $v_parent;
                                                    }
                                                    ?>"
                                                <?php
                                                    } else {
                                                    ?>
                                                id: "", text: "<?php echo $parent ?>", <?php
                                                    if ( ! is_array( $v_parent ) ) {
                                                        if ( ! empty( $data['roll'][ $v_parent ] ) ) {
                                                            echo $data['roll'][ $v_parent ] ? 'check: "checked",' : '';
                                                        }
                                                    }
                                                    ?> value: "<?php
                                                    if ( ! is_array( $v_parent ) ) {
                                                        echo $v_parent;
                                                    }
                                                    ?>"
                                                <?php }
                                                ?>
                                            },
                                            <?php endif; ?>
                                            <?php endforeach; ?>
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
                            @endif
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


                        </div>
                        <!-- /.box-body -->
                    </div>
                    @if(!empty($data['user_edit']->id))
                        {!! BootForm::hidden('user_id')->id('user_id')->value($data['user_edit']->id); !!}
                    @endif
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

    <script>
        $(document).ready(function () {
            var user_flag = document.getElementById("sort").value;
            if (user_flag == '' || user_flag == '0') {
                $("#roll").show();
            }
            else {
                $("#roll").hide();
            }

            // on change user type select action
            $('#sort').on('change', function () {
                if (this.value == '0' || this.value == '') {
                    $("#roll").show();
                }
                else {
                    $("#roll").hide();
                }
            });
        });

    </script>


@endsection
