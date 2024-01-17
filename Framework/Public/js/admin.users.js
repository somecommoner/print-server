$(document).ready(function() {

  var columnDefs = [
    {
      data: "user_id",
      title: "User ID",
      type: "readonly"
    },
    {
      data: "permissions",
      title: "Permissions"
    },
    {
      data: "active",
      title: "Active"
    },
    {
      data: "username",
      title: "Username"
    },
    {
      data: "email",
      title: "Email"
    },
    {
      data: "acct_created",
      title: "Created",
      type: "hidden"
    },
    {
      data: "last_login",
      title: "Last Logged In",
      type: "hidden"
    },
    {
      data: "invited_by_user",
      title: "Invited By",
      type: "hidden"
    }
  ];

  var table = $('#table').DataTable({
    "sPaginationType": "full_numbers",
    ajax: {
      url: "/api/users",
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
        text: 'Edit',
        name: 'edit',
      },
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
    onEditRow: function(datatable, rowdata, success, error) {
      $.ajax({
        url: `/api/users/${rowdata.user_id}`,
        type: 'POST',
        data: rowdata,
        success: success,
        error: error
      });
    },
    onDeleteRow: function(datatable, rowdata, success, error) {

      $.ajax({
        url: `/api/users/${rowdata.user_id}`,
        type: 'DELETE',
        data: rowdata,
        success: success,
        error: error
      });
    }
  });

}) 
