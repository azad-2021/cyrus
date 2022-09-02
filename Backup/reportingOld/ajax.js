

$(document).on('click', '.view_UNO', function(){
  //$('#dataModal').modal();
  var EmployeeID = $(this).attr("id");
  console.log(EmployeeID);
  $.ajax({
   url:"uno.php",
   method:"POST",
   data:{EmployeeID:EmployeeID},
   success:function(data){
    $('#UNOData').html(data);
    $('#ViewUNO').modal('show');
  }
});
});


$(document).on('click', '.view_UNC', function(){
  //$('#dataModal').modal();
  var EmployeeID = $(this).attr("id");

  console.log(EmployeeID);
  $.ajax({
   url:"unc.php",
   method:"POST",
   data:{EmployeeID:EmployeeID},
   success:function(data){
    $('#UNCData').html(data);
    $('#ViewUNC').modal('show');
  }
});
});

$(document).on('click', '.view_UAMC', function(){
  //$('#dataModal').modal();
  var EmployeeID = $(this).attr("id");
  console.log(EmployeeID);
  $.ajax({
   url:"unamc.php",
   method:"POST",
   data:{EmployeeID:EmployeeID},
   success:function(data){
    $('#UAMCData').html(data);
    $('#ViewUAMC').modal('show');
  }
});
});

//Assigned
$(document).on('click', '.view_AO', function(){
  //$('#dataModal').modal();
  var EmployeeID = $(this).attr("id");
  console.log(EmployeeID);
  $.ajax({
   url:"assignOrders.php",
   method:"POST",
   data:{EmployeeID:EmployeeID},
   success:function(data){
    $('#AOData').html(data);
    $('#ViewAO').modal('show');
  }
});
});

$(document).on('click', '.view_AC', function(){
  //$('#dataModal').modal();
  var EmployeeID = $(this).attr("id");
  console.log(EmployeeID);
  $.ajax({
   url:"complaints.php",
   method:"POST",
   data:{EmployeeID:EmployeeID},
   success:function(data){
    $('#ACData').html(data);
    $('#ViewAC').modal('show');
  }
});
});

$(document).on('click', '.view_AMC', function(){
  //$('#dataModal').modal();
  var EmployeeID = $(this).attr("id");
  console.log(EmployeeID);
  $.ajax({
   url:"amc.php",
   method:"POST",
   data:{EmployeeID:EmployeeID},
   success:function(data){
    $('#AMCData').html(data);
    $('#ViewAMC').modal('show');
  }
});
});

//Reassign

$(document).on('change','#amc', function(){
  var rawData = $(this).val();
  const obj = JSON.parse(rawData);
  EmployeeID=obj.EmployeeID;
  exEmployeeID=obj.exEmployeeID
  OrderID=obj.OrderID;
  Status=obj.Status;
  Count=obj.Count;
  Employee=obj.Employee;
  if(Count<5){
    var UnDate = document.getElementById(OrderID).value;
  //console.log(rawData);
  //console.log(UnDate);
  var dp = new Date();
  dp.setDate(dp.getDate() + 1);
  var dm = new Date();
  dm.setDate(dm.getDate() - 1);
  //console.log(dm);
  //console.log('dp===UnDate');
  //console.log('dm===UnDate')
  var inpDate = new Date(UnDate);
  var currDate = new Date();

  if(inpDate.setHours(0, 0, 0, 0) == currDate.setHours(0, 0, 0, 0) || inpDate.setHours(0, 0, 0, 0) == dm.setHours(0, 0, 0, 0) || inpDate.setHours(0, 0, 0, 0) == dp.setHours(0, 0, 0, 0))
  {  



    newObj={EmployeeID: EmployeeID, OrderID: OrderID, Date: UnDate, Status: Status, Count: Count};
    const Data = JSON.stringify(newObj);
    console.log(Data);
    if(Data){

      if (confirm("AMC ID: " + OrderID +" is reassigned by " + Count + " times. do you wish to continue?")) 
      {
        console.log("Confirm");

        $.ajax({
          type:'POST',
          url:'reassign.php',
          data:{'Data':Data},
          success:function(result){
            $("#assigned").load(location.href + " #assigned");
            $("#ahead").hide();
          }

        });
        $.ajax({
         url:"amc.php",
         method:"POST",
         data:{EmployeeID:exEmployeeID},
         success:function(data){
          $('#AMCData').html(data);
          $('#ViewAMC').modal('show');
        }
      });
      }else{

        $.ajax({
         url:"amc.php",
         method:"POST",
         data:{EmployeeID:exEmployeeID},
         success:function(data){
          $('#AMCData').html(data);
          $('#ViewAMC').modal('show');
        }
      });
      }
    }
  }else{
    $.ajax({
     url:"amc.php",
     method:"POST",
     data:{EmployeeID:exEmployeeID},
     success:function(data){
      alert("Assign Date must be Today's date or +- 1 day"); 
      $('#AMCData').html(data);
      $('#ViewAMC').modal('show');
    }
  }); 

  }
}else{
  $.ajax({
   url:"amc.php",
   method:"POST",
   data:{EmployeeID:exEmployeeID},
   success:function(data){
    alert("AMC ID: " + OrderID +" is reassigned by " + Count + " times. You cannot reassing it.");
    $('#AMCData').html(data);
    $('#ViewAMC').modal('show');
  }
}); 

}
});


$(document).on('change','#AO', function(){
  var rawData = $(this).val();
  const obj = JSON.parse(rawData);
  EmployeeID=obj.EmployeeID;
  exEmployeeID=obj.exEmployeeID
  OrderID=obj.OrderID;
  Status=obj.Status;
  Count=obj.Count;
  Employee=obj.Employee;
  if(Count<5){
    var UnDate = document.getElementById(OrderID).value;
  //console.log(rawData);
  //console.log(UnDate);
  var dp = new Date();
  dp.setDate(dp.getDate() + 1);
  var dm = new Date();
  dm.setDate(dm.getDate() - 1);
  //console.log(dm);
  //console.log('dp===UnDate');
  //console.log('dm===UnDate')
  var inpDate = new Date(UnDate);
  var currDate = new Date();

  if(inpDate.setHours(0, 0, 0, 0) == currDate.setHours(0, 0, 0, 0) || inpDate.setHours(0, 0, 0, 0) == dm.setHours(0, 0, 0, 0) || inpDate.setHours(0, 0, 0, 0) == dp.setHours(0, 0, 0, 0))
  {  



    newObj={EmployeeID: EmployeeID, OrderID: OrderID, Date: UnDate, Status: Status, Count: Count};
    const Data = JSON.stringify(newObj);
    console.log(Data);
    if(Data){

      if (confirm("Order ID: " + OrderID +" is reassigned by " + Count + " times. do you wish to continue?")) 
      {
        console.log("Confirm");

        $.ajax({
          type:'POST',
          url:'reassign.php',
          data:{'Data':Data},
          success:function(result){
            $("#assigned").load(location.href + " #assigned");
            $("#ahead").hide();
          }

        });
        $.ajax({
         url:"assignOrders.php",
         method:"POST",
         data:{EmployeeID:exEmployeeID},
         success:function(data){
          $('#AOData').html(data);
          $('#ViewAO').modal('show');
        }
      });
      }else{
        $.ajax({
         url:"assignOrders.php",
         method:"POST",
         data:{EmployeeID:exEmployeeID},
         success:function(data){
          $('#AOData').html(data);
          $('#ViewAO').modal('show');
        }
      });
      }
    }
  }else{ 
    $.ajax({
     url:"assignOrders.php",
     method:"POST",
     data:{EmployeeID:exEmployeeID},
     success:function(data){
      alert("Assign Date must be Today's date or +- 1 day"); 
      $('#AOData').html(data);
      $('#ViewAO').modal('show');
    }
  });

  }
}else{
  $.ajax({
   url:"assignOrders.php",
   method:"POST",
   data:{EmployeeID:exEmployeeID},
   success:function(data){
    alert("Order ID: " + OrderID +" is reassigned by " + Count + " times. You cannot reassing it."); 
    $('#AOData').html(data);
    $('#ViewAO').modal('show');
  }
});
  
}
});











$(document).on('change','#AC', function(){
  var rawData = $(this).val();
  const obj = JSON.parse(rawData);
  EmployeeID=obj.EmployeeID;
  exEmployeeID=obj.exEmployeeID
  ComplaintID=obj.ComplaintID;
  Status=obj.Status;
  Count=obj.Count;
  if(Count<5){
    var UnDate = document.getElementById(ComplaintID).value;
  //console.log(rawData);
  //console.log(UnDate);
  var dp = new Date();
  dp.setDate(dp.getDate() + 1);
  var dm = new Date();
  dm.setDate(dm.getDate() - 1);
  //console.log(dm);
  //console.log('dp===UnDate');
  //console.log('dm===UnDate')
  var inpDate = new Date(UnDate);
  var currDate = new Date();

  if(inpDate.setHours(0, 0, 0, 0) == currDate.setHours(0, 0, 0, 0) || inpDate.setHours(0, 0, 0, 0) == dm.setHours(0, 0, 0, 0) || inpDate.setHours(0, 0, 0, 0) == dp.setHours(0, 0, 0, 0))
  {  



    newObj={EmployeeID: EmployeeID, ComplaintID: ComplaintID, Date: UnDate, Status: Status, Count: Count};
    const Data = JSON.stringify(newObj);
    console.log(Data);
    if(Data){

      if (confirm("Complaint ID: " + ComplaintID +" is reassigned by " + Count + " times. do you wish to continue?")) 
      {
        console.log("Confirm");

        $.ajax({
          type:'POST',
          url:'reassign.php',
          data:{'Data':Data},
          success:function(result){
            $("#assigned").load(location.href + " #assigned");
            $("#ahead").hide();
          }

        });

        $.ajax({
         url:"complaints.php",
         method:"POST",
         data:{EmployeeID:exEmployeeID},
         success:function(data){
          $('#ACData').html(data);
          $('#ViewAC').modal('show');
        }
      });
      }else{
        $.ajax({
         url:"complaints.php",
         method:"POST",
         data:{EmployeeID:exEmployeeID},
         success:function(data){
          $('#ACData').html(data);
          $('#ViewAC').modal('show');
        }
      });
      }
    }
  }else{
    $.ajax({
     url:"complaints.php",
     method:"POST",
     data:{EmployeeID:exEmployeeID},
     success:function(data){
      alert("Assign Date must be Today's date or +- 1 day");
      $('#ACData').html(data);
      $('#ViewAC').modal('show');
    }
  }); 

  }
}else{
  $.ajax({
   url:"complaints.php",
   method:"POST",
   data:{EmployeeID:exEmployeeID},
   success:function(data){
    alert("Complaint ID: " + ComplaintID +" is reassigned by " + Count + " times. You cannot reassing it.");
    $('#ACData').html(data);
    $('#ViewAC').modal('show');
  }
});
  
}
});


//Unassign

$(document).on('change','#uno', function(){
  var rawData = $(this).val();
  const obj = JSON.parse(rawData);
  EmployeeID=obj.EmployeeID;
  exEmployeeID=obj.exEmployeeID;
  OrderID=obj.OrderID;
  Status=obj.Status;
  var UnDate = document.getElementById(OrderID).value;
  //console.log(rawData);
  //console.log(UnDate);
  var dp = new Date();
  dp.setDate(dp.getDate() + 1);
  var dm = new Date();
  dm.setDate(dm.getDate() - 1);
  //console.log(dm);
  //console.log('dp===UnDate');
  //console.log('dm===UnDate')
  var inpDate = new Date(UnDate);
  var currDate = new Date();

  if(inpDate.setHours(0, 0, 0, 0) == currDate.setHours(0, 0, 0, 0) || inpDate.setHours(0, 0, 0, 0) == dm.setHours(0, 0, 0, 0) || inpDate.setHours(0, 0, 0, 0) == dp.setHours(0, 0, 0, 0))
  {

   //console.log("The input date is today's date");

   newObj={EmployeeID: EmployeeID, OrderID: OrderID, Date: UnDate, Status: Status};
   const Data = JSON.stringify(newObj);

   console.log(Data);
   if(Data){

    if (confirm("You want to assign Order ID: " + OrderID +". Do you wish to continue?")) 
    {
      $.ajax({
        type:'POST',
        cache: false,
        url:'reassign.php',
        data:{'Data':Data},
        success:function(result){
          $("#assigned").load(location.href + " #assigned");
          $("#ahead").hide();
          var delayInMilliseconds = 1000; 

          setTimeout(function() {
            $("#unassigned").load(location.href + " #unassigned");
          }, delayInMilliseconds);

          $("#unhead").hide();
        }
      });
      $.ajax({
       url:"uno.php",
       method:"POST",
       data:{EmployeeID:exEmployeeID},
       success:function(data){
        $('#UNOData').html(data);
        $('#ViewUNO').modal('show');
      }
    });
    }else{
      $.ajax({
       url:"uno.php",
       method:"POST",
       data:{EmployeeID:exEmployeeID},
       success:function(data){
        $('#UNOData').html(data);
        $('#ViewUNO').modal('show');
      }
    });
    }
  }
}else{
  $.ajax({
   url:"uno.php",
   method:"POST",
   data:{EmployeeID:exEmployeeID},
   success:function(data){
    $('#UNOData').html(data);
    $('#ViewUNO').modal('show');
    alert("Assign Date must be Today's date or +- 1 day");
  }
});

}

});



$(document).on('change','#unamc', function(){
  var rawData = $(this).val();
  const obj = JSON.parse(rawData);
  EmployeeID=obj.EmployeeID;
  exEmployeeID=obj.exEmployeeID;
  OrderID=obj.OrderID;
  Status=obj.Status;
  var UnDate = document.getElementById(OrderID).value;
  //console.log(rawData);
  //console.log(UnDate);
  var dp = new Date();
  dp.setDate(dp.getDate() + 1);
  var dm = new Date();
  dm.setDate(dm.getDate() - 1);
  //console.log(dm);
  //console.log('dp===UnDate');
  //console.log('dm===UnDate')
  var inpDate = new Date(UnDate);
  var currDate = new Date();

  if(inpDate.setHours(0, 0, 0, 0) == currDate.setHours(0, 0, 0, 0) || inpDate.setHours(0, 0, 0, 0) == dm.setHours(0, 0, 0, 0) || inpDate.setHours(0, 0, 0, 0) == dp.setHours(0, 0, 0, 0))
  {

   //console.log("The input date is today's date");

   newObj={EmployeeID: EmployeeID, OrderID: OrderID, Date: UnDate, Status: Status};
   const Data = JSON.stringify(newObj);

   console.log(Data);
   if(Data){
    if (confirm("You want to assign AMC ID: " + OrderID + ". Do you wish to continue?")) 
    {
      $.ajax({
        type:'POST',
        cache: false,
        url:'reassign.php',
        data:{'Data':Data},
        success:function(result){
          $("#assigned").load(location.href + " #assigned");
          $("#ahead").hide();
          var delayInMilliseconds = 1000; 

          setTimeout(function() {
            $("#unassigned").load(location.href + " #unassigned");
          }, delayInMilliseconds);

          $("#unhead").hide();
        }
      });
      $.ajax({
       url:"unamc.php",
       method:"POST",
       data:{EmployeeID:exEmployeeID},
       success:function(data){
        $('#UAMCData').html(data);
        $('#ViewUAMC').modal('show');
      }
    }); 
    }else{
      $.ajax({
       url:"unamc.php",
       method:"POST",
       data:{EmployeeID:exEmployeeID},
       success:function(data){
        $('#UAMCData').html(data);
        $('#ViewUAMC').modal('show');
      }
    }); 
    }
  }
}else{ 

  $.ajax({
   url:"unamc.php",
   method:"POST",
   data:{EmployeeID:exEmployeeID},
   success:function(data){
    $('#UAMCData').html(data);
    $('#ViewUAMC').modal('show');
    alert("Assign Date must be Today's date or +- 1 day");
  }
}); 
} 
});


$(document).on('change','#unc', function(){
  var rawData = $(this).val();
  const obj = JSON.parse(rawData);
  EmployeeID=obj.EmployeeID;
  exEmployeeID=obj.exEmployeeID
  ComplaintID=obj.ComplaintID;
  Status=obj.Status;
  Count=obj.Count;
  var UnDate = document.getElementById(ComplaintID).value;
  //console.log(rawData);
  //console.log(UnDate);
  var dp = new Date();
  dp.setDate(dp.getDate() + 1);
  var dm = new Date();
  dm.setDate(dm.getDate() - 1);
  //console.log(dm);
  //console.log('dp===UnDate');
  //console.log('dm===UnDate')
  var inpDate = new Date(UnDate);
  var currDate = new Date();

  if(inpDate.setHours(0, 0, 0, 0) == currDate.setHours(0, 0, 0, 0) || inpDate.setHours(0, 0, 0, 0) == dm.setHours(0, 0, 0, 0) || inpDate.setHours(0, 0, 0, 0) == dp.setHours(0, 0, 0, 0))
  {  



    newObj={EmployeeID: EmployeeID, ComplaintID: ComplaintID, Date: UnDate, Status: Status, Count: Count};
    const Data = JSON.stringify(newObj);
    console.log(Data);
    if(Data){

      if (confirm("You want to assign Complaint ID: " + ComplaintID + ". Do you wish to continue?")) 
      {
        console.log("Confirm");

        $.ajax({
          type:'POST',
          url:'reassign.php',
          data:{'Data':Data},
          success:function(result){
            $("#assigned").load(location.href + " #assigned");
            $("#ahead").hide();
            var delayInMilliseconds = 1000; 

            setTimeout(function() {
              $("#unassigned").load(location.href + " #unassigned");
            }, delayInMilliseconds);

            $("#unhead").hide();
          }

        });

        $.ajax({
         url:"unc.php",
         method:"POST",
         data:{EmployeeID:exEmployeeID},
         success:function(data){
          $('#UNCData').html(data);
          $('#ViewUNC').modal('show');
        }
      });
      }else{
        $.ajax({
         url:"unc.php",
         method:"POST",
         data:{EmployeeID:exEmployeeID},
         success:function(data){
          $('#UNCData').html(data);
          $('#ViewUNC').modal('show');
        }
      });
      }
    }
  }else{ 
    $.ajax({
     url:"unc.php",
     method:"POST",
     data:{EmployeeID:exEmployeeID},
     success:function(data){
      $('#UNCData').html(data);
      $('#ViewUNC').modal('show');
      alert("Assign Date must be Today's date or +- 1 day"); 
    }
  });

  }
});



