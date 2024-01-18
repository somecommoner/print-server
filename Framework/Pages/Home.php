<!DOCTYPE html>

<head>
  <?php require_once __DIR__ . '/Sections/Header.php'; ?>
</head>

<body class="bg-black ">
  <?php require_once __DIR__ . '/Sections/Nav.php'; ?>
  <div id="content" class="container-fluid w100">
    <div class="row pt-0 p-2">
      <div class="col-4 p-2">
        <div class="bg-black border border-white text-white rounded">
          <div class="p-4">
          <h2>Settings</h2>
          </div>

          <div class="p-0 px-4">Print</div>
          <div class="px-3 pt-0 pb-3">
            <div class="bg-black border border-white text-white rounded w100 p-2">
              <div class="p-3">
                <small class="">Model:</small>
                  <select class="form-select form-select-sm" aria-label="Default select example">
                    <?php foreach (\App\Controllers\API\Models\getFiles() as $file) {
                       echo '<option value="'.$file['model_name'].'">'.$file['model_name'].'</option>';
                    }?>
                  </select>
                </div>
              <div class="row px-4">
                <div class="col-3 p-1 pb-3">
                  <button type="button" class="btn btn-success">Start Print</button>
                </div>
              </div>
            </div>
          </div>

          <div class="p-0 px-4">Status</div>
          <div class="px-3 pt-0 pb-3">
            <div class="bg-black border border-white text-white rounded w100 p-2">
              <div class="row px-3 p-3">
                <div class="row col-6">
                  <small class="col-8">Current Task: </small>
                  <small class="col-4">-</small>
                </div>
                <div class="row col-6">
                  <small class="col-8">Current Layer: </small>
                  <small class="col-4">-</small>
                </div>
                <div class="row col-6">
                  <small class="col-8">Current Height: </small>
                  <small class="col-4">-</small>
                </div>
                <div class="row col-6">
                  <small class="col-8">Time Remaining: </small>
                  <small class="col-4">-</small>
                </div>
                <div class="row col-6">
                  <small class="col-8">Nozzle Temp: </small>
                  <small class="col-4">-</small>
                </div>
                <div class="row col-6">
                  <small class="col-8">Nozzle Height:</small>
                  <small class="col-4">-</small>
                </div>
                
                <div class="col-12 p-2 pt-3 pb-0">
                <button type="button" class="btn btn-danger">Stop Printer</button>
                </div>

              </div>
            </div>
          </div>


          <div class="p-0 px-4">Modifiers</div>
          <div class="px-3 pt-0 pb-3">
            <div class="bg-black border border-white text-white rounded w100 p-2">
              <div class="row px-3">
                <small class="p-1 px-2 col-4">Acceleration: </small>
                <input type="range" class="form-range col-7" min="0" max="5" step="0.5" id="customRange3">
                <small class="col-1">20%</small>
              </div>
              <div class="row px-3">
                <small class="p-1 px-2 col-4">V Max: </small>
                <input type="range" class="form-range col-7" min="0" max="5" step="0.5" id="customRange3">
                <small class="col-1">150</small>
              </div>
              <div class="row px-3">
                <small class="p-1 px-2 col-4">Junction Deviation: </small>
                <input type="range" class="form-range col-7" min="0" max="5" step="0.5" id="customRange3">
                <small class="col-1">0.05</small>
              </div>
              <div class="row px-3 p-3">
                <div class="p-1 px-2 col-3 align-middle">Nozzle Height: </div>
                <input type="number" step=".01" class="form-control form-control-sm col-4" placeholder="200" id="nozzleHeightVal">
              </div>
            </div>
          </div>

          
          <div class="p-0 px-4">Maintenance</div>
          <div class="px-3 pt-0 pb-3">
            <div class="bg-black border border-white text-white rounded w100">
              <div class="row p-2 px-4">
                <div class="col-3 p-2">
                  <button type="button" class="btn btn-light col-12">Extrude</button>
                </div>
                <div class="col-3 p-2">
                  <button type="button" class="btn btn-light col-12">Withdraw</button>
                </div>
                <div class="col-3 p-2">
                  <button type="button" class="btn btn-light col-12">Stop</button>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>

      <div class="col-8 p-2">
        <div class="card bg-black border border-white text-white rounded">

          <div class="row">
            <div class="card-body col-6">
              <h4 class="card-text px-4">Camera</h4>
            </div>
            <div class="card-body col-6 mr-auto">
              <div class="form-check form-switch pr-4">
                <input class="form-check-input" type="checkbox" id="SwitchLight">
                <label class="form-check-label" for="SwitchLight">Light</label>
              </div>
            </div>
          </div>
          <svg class="bd-placeholder-img card-img-top" width="1280" height="720" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Image cap" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#868e96"></rect><text x="50%" y="50%" fill="#dee2e6" dy=".3em">Camera Feed</text></svg>
          
        </div>
      </div>
    </div>
  </div>
</body>

</html>