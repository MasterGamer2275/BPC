 $(document).ready(function(){
  $('#fG_cName').change(function(){
    var cName = $('#fG_cName').val();
    //$('#fGSave').css('display', 'block');
    $.ajax({
      type: 'POST',
      url: 'filtertype2.php',
      data: { cName: cName },
      success: function(response) {
        $('#myTable').html(response);
      }
    });
  });
});