$(document).ready(function() {
    
    updateStatus();
    setInterval(updateStatus,500);
  
  }) 
  
function updateStatus() {

    $.ajax({
        url: `/api/printer/status`,
        type: 'GET',
        success: function(response) {
            $('#status-machine-value').text(response.machine);
            $('#status-program-value').text(response.program);
            $('#status-system-value').text(response.system);
            $('#status-temp-value').text(response.temp);
            $('#status-layer-value').text(response.layer);
            $('#status-height-value').text(response.height);
            $('#status-percent-value').text(response.percent);
            $('#status-time-value').text(response.time);
        },
        error: function(response) {
            $('#username-result').addClass('text-danger');
            $('#username-result').text("An error occured.");
        }
    });

}