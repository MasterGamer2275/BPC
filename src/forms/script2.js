$(document).ready(function(){
  $('#dpSave').click(function(){
    alert("dpsave");
    var dpDate = $('#dp-Date').val();
    var dpDiD = $('#dp-DiD').val();
    var dpPOnum = $('#dp-pOnum').val();
    var dpCuName = $('#dp-CuName').val();
    var dptableData = $('#dptableData').val();
    $.ajax({
      type: 'POST',
      enctype: 'multipart/form-data',
      url: 'dp-saverecord.php',
      data: { dpDate: dpDate, dpDiD: dpDiD, dpPOnum: dpPOnum, dpCuName: dpCuName, dptableData: dptableData },
      success: function(response) {
        alert("Records saved!");
      }
    });
  });
});
