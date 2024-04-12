$(document).ready(function(){
  $('#filterBtn').click(function(){
    var fromDate = $('#fromDate').val();
    var toDate = $('#toDate').val();
    $.ajax({
      type: 'POST',
      url: 'filter.php',
      data: { fromDate: fromDate, toDate: toDate },
      success: function(response) {
        $('#myTable').html(response);
      }
    });
  });
});