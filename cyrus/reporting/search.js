$(document).on('click', '.search_order', function(){
  //$('#dataModal').modal();
  var OrderID = document.getElementById("forder").value;
  $.ajax({
   url:"ordersView.php",
   method:"POST",
   data:{OrderID:OrderID},
   success:function(data){
    $('#ViewOrderData').html(data);
    $('#ViewOrder').modal('show');
  }
});
});

$(document).on('click', '.search_complaint', function(){
  //$('#dataModal').modal();
  var ComplaintID = document.getElementById("fcomplaint").value;
  $.ajax({
   url:"complaintsView.php",
   method:"POST",
   data:{ComplaintID:ComplaintID},
   success:function(data){
    $('#ViewComplaintData').html(data);
    $('#ViewComplaint').modal('show');
  }
});
});


$(document).on('click', '.search_jobcard', function(){
  //$('#dataModal').modal();
  var ID = document.getElementById("fjobcard").value;
  $.ajax({
   url:"jobcardView.php",
   method:"POST",
   data:{ID:ID},
   success:function(data){
    $('#ViewJobcardData').html(data);
    $('#ViewJobcard').modal('show');
  }
});
});

$(document).on('click', '.search_branch', function(){
  //$('#dataModal').modal();
  var Search = document.getElementById("fbranch").value;
  var Type = document.getElementById("type").value;

  var dataString = 'type=' + Type + '&Search=' + Search;

  if (Type == '') {
    alert("Please Select Search Type");
  }else{
    $.ajax({
     url:"branchView.php",
     method:"POST",
     data:dataString,
     success:function(data){
      $('#ViewBranchData').html(data);
      $('#ViewBranch').modal('show');
    }
  });
  }
});

$(document).on('change','#EmployeeCode', function(){
  var EmployeeCode = $(this).val();
  if(EmployeeCode){
    $.ajax({
      type:'POST',
      url:'dataget.php',
      data:{'EmployeeCode':EmployeeCode},
      success:function(result){
        $('#EmployeeData').html(result);
        
      }
    }); 
  }
});

$(document).on('change','#Edate', function(){
  var EndDate = $(this).val();
  var StartDate = document.getElementById("Sdate").value;
  var EmployeeCode = document.getElementById("EmployeeCodeW").value;
  newObj={EmployeeCode: EmployeeCode, StartDate: StartDate, EndDate: EndDate};
  const Data = JSON.stringify(newObj);
  console.log(Data);
  console.log(EndDate)
  if(Data){
    $.ajax({
      type:'POST',
      url:'dataget.php',
      data:{'Data':Data},
      success:function(result){
        $('#EmployeeWorkData').html(result);
        
      }
    }); 
  }
});

$(document).on('click', '.inventory', function(){
  //$('#dataModal').modal();
  var OrderID = $(this).attr("id");

  var ZoneCode = document.getElementById(OrderID).value;

  console.log(ZoneCode);

  console.log(OrderID);

  newObj={OrderID: OrderID,ZoneCode: ZoneCode};
  const Data = JSON.stringify(newObj);

  $.ajax({
   url:"inventoryPending.php",
   method:"POST",
   data:{Data:Data},
   success:function(data){
    $('#InventoryData').html(data);
    $('#InventoryPending').modal('show');
  }
});
});