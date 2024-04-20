$(document).ready(function(){
  $('#filterBtn').click(function(){
    var fromDate = $('#fromDate').val();
    var toDate = $('#toDate').val();
    var repnum = $('#repnum').val();
    $.ajax({
      type: 'POST',
      url: 'forms/filter.php',
      data: { fromDate: fromDate, toDate: toDate, repnum: repnum },
      success: function(response) {
        $('#myTable').html(response);
        alert(response);
      }
    });
  });
});