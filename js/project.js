$( document ).ready(function() {
    var lang = {};
    lang['SW'] = 'Swahili';

    var status ={};
    status['SUCCESS'] = '<span class="label label-sm label-success">Success</span>';
    status['FAILED'] = '<span class="label label-sm label-danger">Failed</span>';



    //groupid

    $.ajax({
        type: 'get',
        url: 'ajax/getGroup.php',
        dataType: 'json',

        success: function (response) {

            var str = "<option value=-1>ALL Groups</option>";
            $.each(response, function(index, element) {

                str += "<option value='"+element.groupid+"'>"+element.name+"</option>";

            });

            document.getElementById("groupname").innerHTML=str+"</select>";
            $('#groupname').html(str);


        }
    });
    // main content
    $.ajax({
        type: 'get',
        url: 'ajax/getItem.php',
        dataType: 'json',
        error: function(jqXHR, textStatus, errorThrown) {
            console.log(JSON.stringify(jqXHR));
            console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
        },
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
                "<td>"+status[element.tstatus]+"</td>"+
                "<td>"+lang[element.lang]+"</td>"+
                "<td>"+element.groupid+"</td>"+
                "</tr>";

                //console.log(JSON.stringify(str));
            });
            document.getElementById("transaction_table").innerHTML=str;
        }
    });
    $('#daterange').daterangepicker();
    $('#daterange').on('apply.daterangepicker', function(ev, picker) {
        console.log(picker.startDate.format('YYYY-MM-DD'));
        console.log(picker.endDate.format('YYYY-MM-DD'));
    });
    $("form").submit(function(event){
        event.preventDefault();
        var phone = document.getElementById('phone').value;
        var ref = document.getElementById('ref').value;
        var groupid = document.getElementById('groupname').value;
        var startDate='';
        var endDate='';
        if($('#calshow').is(":checked")) {

            startDate = $('#reportrange').data('daterangepicker').startDate.format('YYYY-MM-DD');
            endDate = $('#reportrange').data('daterangepicker').endDate.format('YYYY-MM-DD');
            console.log('daterange '+startDate,endDate);
        }

        console.log(groupid+' '+phone+' '+ref);

        document.getElementById("current").innerHTML=groupid;
        $.ajax({
            type: 'get',
            url: 'ajax/getItem.php',
            dataType: 'json',
            //data: $("#theform").serialize(),
            data: {id: groupid, phone: phone, ref: ref, startDate: startDate, endDate: endDate},
            error: function(response){console.log(response)},
            success: function (response) {
                //console.log(response);
                var str='';
                $.each(response, function(index, element) {

                    str += "<tr><td>"+element.id+"</td>"+
                    "<td>"+element.fulltimestamp+
                    "<td>"+element.msisdn+"</td>"+
                    "<td>"+element.account+"</td>"+
                    "<td>"+element.service+"</td>"+
                    "<td>"+element.reference+"</td>"+
                    "<td>"+element.amount+"</td>"+
                    "<td>"+status[element.tstatus]+"</td>"+
                    "<td>"+lang[element.lang]+"</td>"+
                    "<td>"+element.groupid+"</td>"+
                    "</tr>";

                    //console.log(str);
                });
                document.getElementById("transaction_table").innerHTML=str;
            }
        });
    });



});



