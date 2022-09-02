$(document).on('click', '.add', function(){
  //$('#dataModal').modal();
  var ZoneCode = $(this).attr("id");
  var OrderID=document.getElementById("orderid").value;
  console.log(ZoneCode);
  console.log(OrderID);
  if (ZoneCode) {
    newObj={OrderID: OrderID, ZoneCode: ZoneCode};
    const Data = JSON.stringify(newObj);
    $.ajax({
      type:'POST',
      url:'material.php',
      data:{Data:Data},
      success:function(result){
        $('#material').html(result);
        
      }
    }); 
  }
});



$(document).on('click', '.confirm', function(){
  //$('#dataModal').modal();
  var ZoneCode = $(this).attr("id");
  var OrderID=document.getElementById("orderid").value;
  //console.log(ZoneCode);
  console.log(OrderID);
  if (OrderID) {
    newObj={OrderID: OrderID, Type: "Confirm"};
    const Data = JSON.stringify(newObj);
    if (confirm("You want to Confirm all items. do you wish to continue?")) {
      $.ajax({
        type:'POST',
        url:'confirm.php',
        data:{Data:Data},
        success:function(result){

          if (ZoneCode) {
            newObj={OrderID: OrderID, ZoneCode: ZoneCode};
            const Data = JSON.stringify(newObj);
            $.ajax({
              type:'POST',
              url:'material.php',
              data:{Data:Data},
              success:function(result){
                $('#material').html(result);

              }
            }); 
          }

        }
      });
    } 
  }
});




$(document).on('change','#alt', function(){
  var Data = $(this).val();
  if(Data){
    console.log(Data);
    if (confirm("You want to give alternative item. Do you wish to continue?")) {
      $.ajax({
       url:"ConfirmDemand.php",
       method:"POST",
       data:{Data:Data},
       success:function(data){
        console.log("success");
      }
    });
    }else{
      var OrderID=document.getElementById("orderid").value;
      var ZoneCode=document.getElementById("ZoneCode").value;
      newObj={OrderID: OrderID, ZoneCode: ZoneCode};
      const Data = JSON.stringify(newObj);
      $.ajax({
        type:'POST',
        url:'material.php',
        data:{Data:Data},
        success:function(result){
          $('#material').html(result);

        }
      }); 
    }
  }
});

$(document).on('click', '.Release', function(){
  //$('#dataModal').modal();
  var OrderID = $(this).attr("id");

  var EmployeeCode = document.getElementById("Employee").value;


  console.log(EmployeeCode);

  console.log(OrderID);
  if (confirm("You want to Release Order ID " + OrderID +". Do you wish to continue?")) {
    $.ajax({
     url:"confirm.php",
     method:"POST",
     data:{OrderID:OrderID},
     success:function(data){
      $.ajax({
       url:"employeeData.php",
       method:"POST",
       data:{EmployeeCode:EmployeeCode},
       success:function(data){
        $('#PendingInventoryData').html(data);
        $('#PendingOrders').modal('show');
      }
    });

    }
  });
  }
});


$(document).on('click', '.showEmployeeData', function(){
  //$('#dataModal').modal();
  var EmployeeCode = $(this).attr("id");
  console.log(EmployeeCode);
  $.ajax({
   url:"employeeData.php",
   method:"POST",
   data:{EmployeeCode:EmployeeCode},
   success:function(data){
    $('#PendingInventoryData').html(data);
    $('#PendingOrders').modal('show');
  }
});
});

$(document).on('click', '.showEmployeeReleaseData', function(){
  //$('#dataModal').modal();
  var OrderID = $(this).attr("id");
  console.log(OrderID);
  $.ajax({
   url:"employeeData.php",
   method:"POST",
   data:{OrderID:OrderID},
   success:function(data){
    $('#PendingInventoryData').html(data);
    $('#PendingOrders').modal('show');
  }
});
});


$(document).on('click', '.showReleaseView', function(){
  //$('#dataModal').modal();
  var OrderID = $(this).attr("id");
  var ZoneCode = document.getElementById("ZoneCode").value;
  newObj={OrderID: OrderID, ZoneCode: ZoneCode};
  const Data = JSON.stringify(newObj);
  console.log(Data);
  $.ajax({
   url:"releaseView.php",
   method:"POST",
   data:{Data:Data},
   success:function(data){
    $('#ReleaseData').html(data);
    $('#ReleaseOrders').modal('show');
  }
});
});