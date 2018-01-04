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
                            <h3 class="panel-title alert alert-primary" role="alert">Transactions

                                Group: <span id="current" class="badge">All<span>
                             </h3>
                        </div>
                        <div class="col col-xs-6 text-right">
                            <div class="pull-right">
                                <div class="row">

                                    <!-- Our Special dropdown has class show-on-hover -->

                                    <div>
                                        <form id="theform" action="">
                                            <table>
                                                <tr>
                                                    <td><input type="text" class="form-control" id="phone" placeholder="phone#"></td>
                                                    <td><input type="text" class="form-control" id="ref" placeholder="reference#"></td>
                                                    <td><select class="form-control" id="groupname">

                                                            <option value=-"">All Groups</option>
                                                        </select>
                                                    </td>
                                                    <td>   </td>
                                                    <td><button class="btn btn-primary" id="start">Submit</button> </td>
                                                </tr>
                                            </table>


                                        </form>
                                    </div>


                                </div>

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
                            <th class="col-text">Group Id</th>
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
        margin-right: -30px !important;
        margin-left: -35px !important; ;
    }
</style>
<script>
    $(document).ready(function(){
        $("form").submit(function(event){
            event.preventDefault();
           var phone = document.getElementById('phone').value;
            var ref = document.getElementById('ref').value;
            var groupid = document.getElementById('groupname').value;
            alert(groupid+' '+phone+' '+ref);
            document.getElementById("current").innerHTML=groupid;
            $.get({
                type: 'get',
                url: 'ajax/getItem.php',
                dataType: 'json',
                //data: $("#theform").serialize(),
               data: {id: groupid, phone: phone, ref: ref},
                error: function(response){console.log(response)},
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
                        "<td>"+element.groupid+"</td>"+
                        "</tr>";

                        //console.log(str);
                    });
                    document.getElementById("tbody").innerHTML=str;
                }
            });
        });


    });
</script>
</html>