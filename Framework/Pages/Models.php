<!DOCTYPE html>

<head>
  <?php require_once __DIR__ . '/Sections/Header.php'; ?>
    <script type="text/javascript" src="/js/models.js"></script>
    <script type="text/javascript" src="/js/libs/datatables.js"></script>
    <script type="text/javascript" src="/js/libs/datatables.altEditor.js"></script>
    <link rel="stylesheet" href="/css/libs/datatables.css">
    <link rel="stylesheet" href="/css/models.css">
    <link rel="stylesheet" href="/css/table.css">
</head>

<body class="bg-black ">
  <?php require_once __DIR__ . '/Sections/Nav.php'; ?>
  <div id="content" class="container">
    <div class="w100 border border-white rounded p-4">
        <h3 class="text-white">Models</h3>


        <form action="/api/models/upload" method="post" enctype="multipart/form-data" >
          <div method="post">
            <label for="formFile" class="form-label text-white">Select model (.gcode)</label>
            <input class="form-control" type="file" id="formFile" name="model_file" accept=".gcode" required/>
          </div>
          <button class="btn btn-success mt-3" id="uploadModel" type="submit" value="upload">Upload</button>
        </form>


        <h3 class="text-white pt-4">Uploaded models</h3>
        <div class="text-white row px-4 pt-2">
            <div class="bg-black col-12 align-list row border border-white rounded pt-4 pb-3">
            <table id="table" cellpadding="0" cellspacing="0" border="0" class="dataTable pt-4">
            </table>
            </div>
        </div>
    </div>
  </div>
</body>

</html>
