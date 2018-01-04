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
                                                    <td><label>Date Range</label></td>
                                                    <td >
                                                        <div id="reportrange" class="pull-left" style="border-radus:5px ;background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                                                            <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
                                                            <span></span> <b class="caret"></b>
                                                        </div>
                                                    </td>
                                                    </tr>
                                                <tr><td><input type="text" class="form-control" id="phone" placeholder="phone#"></td></tr>
                                                <tr><td><input type="text" class="form-control" id="ref" placeholder="reference#"></td></tr>
                                                <tr><td><select class="form-control" id="groupname">

                                                            <option value=-"">All Groups</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                    <td></td><td><button class="btn btn-primary" id="start">Submit</button> </td>
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

<script type="text/javascript">
    //$("#reportrange").on('click',function(){
    $(function() {

        var start = moment().subtract(29, 'days');
        var end = moment();

        function cb(start, end) {
            $('#reportrange span').html(start.format('MMM D, YYYY') + ' - ' + end.format('MMM D, YYYY'));
        }

        $('#reportrange').daterangepicker({
            autoApply: false,
            autoUpdateInput:false,
            startDate: start,
            endDate: end,
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        }, cb);

        cb(start, end);

    });
</script>
</html>