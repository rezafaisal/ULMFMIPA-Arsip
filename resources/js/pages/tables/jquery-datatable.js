$(document).ready(function () {
    
    $('.js-basic-example').DataTable({
        responsive: true,
        ordering:  false
    });

    $('#my-table').DataTable({
        responsive: true
    });

    $('#task-table').DataTable({
        ordering:  false
    });

    //Exportable table
    $('.js-exportable').DataTable({
        dom: 'Bfrtip',
        responsive: true,
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
});