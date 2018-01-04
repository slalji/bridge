$( document ).ready(function() {
    //$('input[name="daterange"]').daterangepicker();
    //groupid
    console.log( "ready!" );
    $.ajax({
        type: 'post',
        url: 'ajax/getGroup.php',
        dataType: 'json',

        success: function (response) {

            var str = "<option value=''>ALL Groups</option>";
            $.each(response, function(index, element) {

                str += "<option value='"+element.groupid+"'>"+element.name+"</option>";

            });

            document.getElementById("groupname").innerHTML=str+"</select>";
            $('#groupname').html(str);


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
                "<td>"+element.groupid+"</td>"+
                "</tr>";

                // console.log(JSON.stringify(str));
            });
            document.getElementById("tbody").innerHTML=str;
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
        var startDate = $('#reportrange').data('daterangepicker').startDate.format('YYYY-MM-DD');
        var endDate = $('#reportrange').data('daterangepicker').endDate.format('YYYY-MM-DD');

        console.log(groupid+' '+phone+' '+ref);
        console.log(startDate,endDate);
        document.getElementById("current").innerHTML=groupid;
        $.get({
            type: 'get',
            url: 'ajax/getItem.php',
            dataType: 'json',
            //data: $("#theform").serialize(),
            data: {id: groupid, phone: phone, ref: ref, startDate: startDate, endDate: endDate},
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



