<!DOCTYPE html>

<head>
    <?php require_once __DIR__ . '/../Sections/Header.php'; ?>
    <script type="text/javascript" src="/js/libs/datatables.js"></script>
    <script type="text/javascript" src="/js/libs/datatables.altEditor.js"></script>
    <script type="text/javascript" src="/js/admin.users.js"></script>
    <link rel="stylesheet" href="/css/libs/datatables.css">
    <link rel="stylesheet" href="/css/table.css">
</head>

<body class="bg-black pb-4">
    <?php require_once __DIR__ . '/../Sections/Nav.php'; ?>
  <div id="content" class="container-fluid w100 text-white p-4">
    <table id="table" cellpadding="0" cellspacing="0" border="0" class="dataTable">
    </table>
  </div>
</body>

</HTML>