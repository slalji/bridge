$( document ).ready(function() {
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



});



