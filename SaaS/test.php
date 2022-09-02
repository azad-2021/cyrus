<?php
$ID = $_GET['id'];
if(isset($_POST["submit"])){

$Mobile=$_POST['Mobile'];
echo $Mobile;

}

 ?>


<!DOCTYPE html>
<html>
  <head>
    <title>Dynamic Dependent Searchable Select Box with PHP Ajax jQuery</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>
  </head>
  <body>
    <br />
    <div class="container">
      <h3 align="center">Dynamic Dependent Searchable Select Box with PHP Ajax jQuery</h3>
      <br />
      <div class="panel panel-default">
        <div class="panel-heading">Select Data</div>
        <div class="panel-body">
            <form method="POST" action="">
          <div class="form-group">
            <label>Select Category</label>
            <select name="Mobile" id="category_item" class="form-control input-lg" data-live-search="true" title="Select Category">

            </select>
          </div>
          <input type="submit"  class=" btn btn-success" value="submit" name="submit"></input>
        </div>
        </form>
      </div>
    </div>
  </body>
</html>

<script>
$(document).ready(function(){

  $('#category_item').selectpicker();

  $('#sub_category_item').selectpicker();

  load_data('category_data');

  function load_data(type, category_id = '')
  {
    $.ajax({
      url:"load_data.php",
      method:"POST",
      data:{type:type, category_id:category_id},
      dataType:"json",
      success:function(data)
      {
        var html = '';
        for(var count = 0; count < data.length; count++)
        {
          html += '<option value="'+data[count].id+'">'+data[count].name+'</option>';
        }
        if(type == 'category_data')
        {
          $('#category_item').html(html);
          $('#category_item').selectpicker('refresh');
        }
        else
        {
          $('#sub_category_item').html(html);
          $('#sub_category_item').selectpicker('refresh');
        }
      }
    })
  }

  $(document).on('change', '#category_item', function(){
    var category_id = $('#category_item').val();
    load_data('sub_category_data', category_id);
  });
  
});
</script>