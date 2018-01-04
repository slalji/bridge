<?php
include "layout/header.html";
?>
<body>
<div class="container">
    <div class="row">
<?php include "layout/navbar.html";?>
    </div>
    <div class="row" style="margin-top: 10%">
        <div class="col-md-12 col-md-offset-2">
            <div class="panel panel-default panel-table">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col col-xs-6">
                            <h3 class="panel-title alert alert-primary" role="alert">Boresha Maisha Admin

                                Group ID: <span id="current" class="badge badge-primary">All<span>
                             </h3>
                        </div>
                        <div class="col col-xs-6 text-right">
                            <div class="pull-right">
                                <div class="row">

                                    <!-- Our Special dropdown has class show-on-hover -->
                                    <div class="btn-group show-on-hover">
                                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                            Group Id <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu"  id="groups2">
                                           <!-- <li><a href="#">Action</a></li>
                                            <li><a href="#">Another action</a></li>
                                            <li><a href="#">Something else here</a></li>
                                            <li class="divider"></li>
                                            <li><a href="#">Separated link</a></li>
                                            -->
                                        </ul>
                                    </div>
                                    <div>
                                        <select class="selectpicker" id="group">
                                            <option>Mustard</option>
                                            <option>Ketchup</option>
                                            <option>Relish</option>
                                        </select>
                                    </div>


                                </div>
                                >
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <table id="mytable" class="table table-striped table-bordered table-list table-condensed">
                        <thead>
                        <tr>

                            <th class="hidden-xs">ID</th>
                            <th class="col-text">Date</th>
                            <th class="col-text">Phone#</th>
                            <th class="col-text">Account</th>
                            <th class="col-text">Service</th>
                            <th class="col-text">References</th>
                            <th class="col-text">Amount</th>
                            <th class="col-text">Status</th>
                            <th class="col-text">Language</th>
                        </tr>
                        </thead>
                        <tbody id="tbody">


                        </tbody>
                    </table>

                </div>

            </div>
        </div>
    </div>
    <div class="row">

    </div>
</div>
</body>
<style>
    .show-on-hover:hover > ul.dropdown-menu {
        display: block;
    }
    body{
        padding-left: 5px !important;
        font-size: 12px !important;

    }
    th td{
        font-size:12px;
        wrap-option: no-warp;
    }
    .container{
        margin-left: 5px !important;
    }
    .panel {
        margin-right: -35px !important;
        margin-left: -35px !important; ;
    }
</style>
<script>
    $( document ).ready(function() {



        //groupid
        console.log( "ready!" );
        $.ajax({
            type: 'post',
            url: 'ajax/getGroup.php',
            dataType: 'json',

            success: function (response) {

                var str = "<option value="">All</>";
                $.each(response, function(index, element) {
                    /*$('groups').append($('<option value=>', {
                        text: element.groupid
                    }));
                    */
                    str += "<option value='"+element.groupid+"'>"+element.name+"</option>";

                    //console.log(JSON.stringify(str));
                });
                document.getElementById("groups").innerHTML=str+"</select>";


            }
        });
        // main content
        $.ajax({
            type: 'post',
            url: 'ajax/getItem.php',
            dataType: 'json',

            success: function (response) {
                var str='';
                $.each(response, function(index, element) {

                    str += "<tr><td>"+element.id+"</td>"+
                    "<td>"+element.fulltimestamp+
                    "<td>"+element.msisdn+"</td>"+
                    "<td>"+element.account+"</td>"+
                    "<td>"+element.service+"</td>"+
                    "<td>"+element.reference+"</td>"+
                    "<td>"+element.amount+"</td>"+
                    "<td>"+element.tstatus+"</td>"+
                        "<td>"+element.lang+"</td>"+
                    "</tr>";

                   // console.log(JSON.stringify(str));
                });
                document.getElementById("tbody").innerHTML=str;
            }
        });



    });
    $(document).on('click', '#groupid', function() {
        var groupid = this.text;
        document.getElementById("current").innerHTML=groupid;
        $.ajax({
            type: 'get',
            url: 'ajax/getItem.php',
            dataType: 'json',
            data: {id: groupid},
            success: function (response) {

                var str='';
                $.each(response, function(index, element) {

                    str += "<tr><td>"+element.id+"</td>"+
                    "<td>"+element.fulltimestamp+
                    "<td>"+element.msisdn+"</td>"+
                    "<td>"+element.account+"</td>"+
                    "<td>"+element.service+"</td>"+
                    "<td>"+element.reference+"</td>"+
                    "<td>"+element.amount+"</td>"+
                    "<td>"+element.tstatus+"</td>"+
                    "<td>"+element.lang+"</td>"+
                    "</tr>";

                     console.log(JSON.stringify(str));
                });
                document.getElementById("tbody").innerHTML=str;
            }
        });
    });

    $('.selectpicker').selectpicker({
        style: 'btn-primary',
        size: 4
    });


</script>
</html>