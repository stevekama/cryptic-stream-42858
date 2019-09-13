$(document).ready(function(){
    function fetch_transactions(){
        var dataTable = $('#paypalTransactionsData').DataTable({
            'processing'  : true,
            'serverSide'  : true,
            'ajax'        : {
              url  : base_url+'api/paypal_api/fetch.php',
              type : 'POST'
            },
            'autoWidth':false
        });
    }
    fetch_transactions();
});