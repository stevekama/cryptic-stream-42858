$(document).ready(function(){

    // load merchants
    var loadMerchants = $('#loadMerchants').DataTable({
        "processing":true,
        "serverSide":true,
        "order":[],
        "ajax":{
            url: base_url+"api/organizations/fetch.php",
            type:"POST",
        },
        "columnDefs":[
            {
                "targets":[0, 4],
                "orderable":false,
            },  
        ],
        "autoWidth":false
    });

    // bring in utilities
    var loadUtilities = $('#loadUtilities').DataTable({
        "processing":true,
        "serverSide":true,
        "order":[],
        "ajax":{
            url: base_url+"api/utilities/fetch.php",
            type:"POST",
        },
        "columnDefs":[
            {
                "targets":[1],
                "orderable":false,
            },  
        ],
        "autoWidth":false
    });
});