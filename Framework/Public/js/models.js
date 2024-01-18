$(document).ready(function() {

    var columnDefs = [
      {
        data: "model_name",
        title: "Model"
      }
    ];
  
    var table = $('#table').DataTable({
      "bPaginate": false,
      ajax: {
        url: "/api/models",
        dataSrc: ''
      },
      columns: columnDefs,
      dom: 'Bfrtip',
      select: 'single',
      responsive: true,
      altEditor: true,
      buttons: [
        {
          extend: 'selected',
          text: 'Delete',
          name: 'delete'
        },
        {
          text: 'Refresh',
          name: 'refresh'
        }
      ],
      onDeleteRow: function(datatable, rowdata, success, error) {
  
        $.ajax({
          url: `/api/models/${rowdata.model_name}`,
          type: 'DELETE',
          data: rowdata,
          success: success,
          error: error
        });
      }
    });

    columns.adjust()
  
  }) 
  