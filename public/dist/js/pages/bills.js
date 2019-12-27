$(document).ready(function(){
    var dataTable = $('#loadMerchants').DataTable({
        "processing":true,
        "serverSide":true,
        "order":[],
        "ajax":{
            url: base_url+"api/organizations/fetch.php",
            type:"POST",
        },
        "columnDefs":[
            {
                "targets":[0, 3, 4],
                "orderable":false,
            },
        ],
    });
});