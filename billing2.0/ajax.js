 $(document).on('change','#Bank', function(){
  var BankCode = $(this).val();
  if(BankCode){
    $.ajax({
      type:'POST',
      url:'dataget.php',
      data:{'BankCode':BankCode},
      success:function(result){
        $('#Zone').html(result);
        
      }
    }); 
  }else{
    $('#Zone').html('<option value="">Zone</option>');
    $('#Branch').html('<option value="">Branch</option>'); 
  }
});
 
 $(document).on('change','#Zone', function(){
  var ZoneCode = $(this).val();
  if(ZoneCode){
    $.ajax({
      type:'POST',
      url:'dataget.php',
      data:{'ZoneCode':ZoneCode},
      success:function(result){
        $('#Branch').html(result);
        
      }
    }); 
  }else{

    $('#Branch').html('<option value=""> Branch </option>'); 
  }
});



 $(document).on('click', '.view', function(){
  //$('#dataModal').modal();
  var OrderID=document.getElementById("orderidv").value;
  console.log(OrderID);
  if (OrderID) {

    $.ajax({
      type:'POST',
      url:'materialView.php',
      data:{OrderID:OrderID},
      success:function(result){
        $('#materialview').html(result);
        
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
  document.getElementById("order_id").value = OrderID;
  document.getElementById("zone_code").value = ZoneCode;
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



 $(document).on('click', '.search_order', function(){
  //$('#dataModal').modal();
  var OrderID = document.getElementById("forder").value;
  console.log(OrderID);
  $.ajax({
   url:"/cyrus/reporting/ordersView.php",
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
   url:"/cyrus/reporting/complaintsView.php",
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
   url:"/cyrus/reporting/jobcardView.php",
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
     url:"/cyrus/reporting/branchView.php",
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





 $(document).on('change','#Branch', function(){
  var BranchCode = $(this).val();
  if(BranchCode){
    $.ajax({
      type:'POST',
      url:'/cyrus/reporting/estView.php',
      data:{'Branch':BranchCode},
      success:function(result){
        $('#estimateView').html(result);

      }
    }); 
  }
});



 $(document).on('click', '.EstimateDetails', function(){
  //$('#dataModal').modal();
  var ApprovalID = $(this).attr("id");
  document.getElementById("apd").value = ApprovalID
  console.log(ApprovalID);
  $.ajax({
    url:"/cyrus/reporting/Estimate.php",
    method:"POST",
    data:{ApprovalID:ApprovalID},
    success:function(data){
      $('#EstimateData').html(data);
      $('#Estimate').modal('show');
    }
  });
});


 $(document).on('change','#EmployeeCode', function(){
  var EmployeeCode = $(this).val();
  if(EmployeeCode){
    $.ajax({
      type:'POST',
      url:'/cyrus/reporting/dataget.php',
      data:{'EmployeeCode':EmployeeCode},
      success:function(result){
        $('#EmployeeData').html(result);
        
      }
    }); 
  }
});


 $(document).on('change','#Branch', function(){
  var BranchCode = $(this).val();
  if(BranchCode){
    $.ajax({
      type:'POST',
      url:'/cyrus/reporting/details.php',
      data:{'BCode':BranchCode},
      success:function(result){
        $('#BranchData').html(result);
        
      }
    }); 
  }
});


 $(document).on('change','#Branch', function(){
  var BranchCode = $(this).val();
  if(BranchCode){
    $.ajax({
      type:'POST',
      url:'/cyrus/reporting/details.php',
      data:{'Branch':BranchCode},
      success:function(result){
        $('#jobcard').html(result);

      }
    }); 
  }
});

 $(document).on('change','#Branch', function(){
  var BranchCode = $(this).val();
  if(BranchCode){
    $.ajax({
      type:'POST',
      url:'/cyrus/reporting/details.php',
      data:{'BrCode':BranchCode},
      success:function(result){
        $('#Complaints').html(result);
        
      }
    }); 
  }
});

 $(document).on('change','#Branch', function(){
  var BranchCode = $(this).val();
  if(BranchCode){

    $.ajax({
      type:'POST',
      url:'/cyrus/reporting/details.php',
      data:{'BranchCode':BranchCode},
      success:function(result){
        $('#Order').html(result);        

        
      }
    }); 
  }
});
 
 $(document).on('click', '.view_vat', function(){
  //$('#dataModal').modal();
  var BranchCode = $(this).attr("id");
  $.ajax({
   url:"/cyrus/reporting/VATView.php",
   method:"POST",
   data:{BranchCode:BranchCode},
   success:function(data){
    $('#VATData').html(data);
    $('#ViewVAT').modal('show');
  }
});
});


 $(document).on('click', '.view_gst', function(){
  //$('#dataModal').modal();
  var BranchCode = $(this).attr("id");
  console.log(BranchCode);
  $.ajax({
   url:"/cyrus/reporting/GSTView.php",
   method:"POST",
   data:{BranchCode:BranchCode},
   success:function(data){
    $('#GSTData').html(data);
    $('#ViewGST').modal('show');
  }
});
});

 $(document).on('click', '.material', function(){
  //$('#dataModal').modal();
  var OrderID = $(this).attr("id");
  var ZoneCode=document.getElementById(OrderID).value;
  newObj2={OrderID: OrderID, ZoneCode: ZoneCode};
  const Data = JSON.stringify(newObj2);
  console.log(Data);
  $.ajax({
   url:"/cyrus/reporting/materialRelease.php",
   method:"POST",
   data:{Data:Data},
   success:function(data){
    $('#MaterialsData').html(data);
    $('#ReleasedMaterials').modal('show');
  }
});
});

$(document).on('click', '.Employees', function(){
  $.ajax({
   url:"dataget.php",
   method:"POST",
   data:{'view':'Employeelist'},
   success:function(data){
    $('.SrEngineer-Table').DataTable().clear();
    $('.SrEngineer-Table').DataTable().destroy();
    $('#employeelist').html(data);

    $('table.SrEngineer-Table').DataTable( {

      rowReorder: {
        selector: 'td:nth-child(2)'
      },

      "lengthMenu": [[10, 50, 100, -1], [10, 25, 50, "All"]],
      responsive: false
    } ); 

    $('#Employees').modal('show');
  }
});
});

$(document).on('click', '.DataentryAllotment', function(){
  $.ajax({
   url:"dataget.php",
   method:"POST",
   data:{'viewDataEntry':'Employeelist'},
   success:function(data){
    $('#employeelistD').html(data);
    $('#DataentryAllotment').modal('show');
  }
});
});


$(document).on('click', '.SaveExecutive', function(){
  username=document.getElementById("UserName").value;
  usertype=document.getElementById("UserType").value;
  if (username!='' && usertype!='') {
    $.ajax({
     url:"dataget.php",
     method:"POST",
     data:{'NewUser':username, 'UserType':usertype},
     success:function(data){
      swal("success","User Created","success");
    }
  });
  }else{
    swal("error","Please enter all fields.","error");
  }
});

$(document).on('change', '#ChangeReporting', function(){
  var ExecutiveID= $(this).val();
  var EmployeeCode=$(this).attr("id2");
  $.ajax({
   url:"dataget.php",
   method:"POST",
   data:{'NewReporting':ExecutiveID, 'EmployeeCode':EmployeeCode},
   success:function(data){

   }
 });

  $.ajax({
   url:"dataget.php",
   method:"POST",
   data:{'view':'Employeelist'},
   success:function(data){
    $('#employeelist').html(data);
    $('#Employees').modal('show');
  }
});
});



$(document).on('change', '#ChangeDataentry', function(){
  var ExecutiveID= $(this).val();
  var EmployeeCode=$(this).attr("id2");
  $.ajax({
   url:"dataget.php",
   method:"POST",
   data:{'NewDataentry':ExecutiveID, 'EmployeeCode':EmployeeCode},
   success:function(data){

   }
 });

  var delayInMilliseconds = 1000; 

  setTimeout(function() {

    $.ajax({
     url:"dataget.php",
     method:"POST",
     data:{'view':'Employeelist'},
     success:function(data){
      $('#employeelist').html(data);
      $('#Employees').modal('show');
    }
  });

  }, delayInMilliseconds);


});




$(document).on('click', '.ResetPass', function(){
  var EmployeeCode=$(this).attr("id");
  if (EmployeeCode) {
    $.ajax({
     url:"dataget.php",
     method:"POST",
     data:{'ResetPass':EmployeeCode},
     success:function(data){
      swal("success","Password Reset to cyrus@123","success");
    }
  });
  }
});


$(document).on('click', '.ResetExecutivePass', function(){
  var EmployeeCode=$(this).attr("id");
  if (EmployeeCode) {
    $.ajax({
     url:"dataget.php",
     method:"POST",
     data:{'ResetExecutivePass':EmployeeCode},
     success:function(data){
      swal("success","Password Reset to cyrus@123","success");
    }
  });
  }
});

$(document).on('click', '.Resetdataentry', function(){
  var EmployeeCode=$(this).attr("id");
  if (EmployeeCode) {
    $.ajax({
     url:"dataget.php",
     method:"POST",
     data:{'Resetdataentry':EmployeeCode},
     success:function(data){

     }
   });


    var delayInMilliseconds = 1000; 

    setTimeout(function() {

      $.ajax({
       url:"dataget.php",
       method:"POST",
       data:{'view':'Employeelist'},
       success:function(data){
        $('#employeelist').html(data);
        $('#Employees').modal('show');
      }
    });

    }, delayInMilliseconds);



  }
});


$(document).on('click', '.SaveNewEmployee', function(){
  EmployeeName=document.getElementById("EmployeeName").value;
  EmployeeQulaification=document.getElementById("EmployeeQulaification").value;
  EmployeeDistrict=document.getElementById("EmployeeDistrict").value;
  EmployeeMobile=document.getElementById("EmployeeMobile").value;
  if (EmployeeName!='' && EmployeeQulaification!='' && EmployeeDistrict!='' && EmployeeMobile!='') {
    $.ajax({
     url:"dataget.php",
     method:"POST",
     data:{'NewEmployeeName':EmployeeName, 'EmployeeQulaification':EmployeeQulaification, 'EmployeeDistrict':EmployeeDistrict,'EmployeeMobile':EmployeeMobile},
     success:function(data){
      swal("success","New employee added","success");
      $('#EAddEmployees').modal('hide');
      $('#NewEmployeeF').trigger("reset");
    }
  });
  }else{
    swal("error","Please enter all fields.","error");
  }
});

var EmployeeCodeU=0;
$(document).on('click', '.UEmployee', function(){
  EmployeeCodeU=$(this).attr("id");
  var EmployeeName=$(this).attr("id2");
  var Qualification=$(this).attr("id3");
  var District=$(this).attr("id4");
  var Phone=$(this).attr("id5");
  var Target=$(this).attr("id6");
  
  document.getElementById("EmployeeNameU").value=EmployeeName;
  document.getElementById("EmployeeQulaificationU").value=Qualification;
  document.getElementById("EmployeeDistrictU").value=District;
  document.getElementById("EmployeeMobileU").value=Phone;
  document.getElementById("EmployeeTargetU").value=Target
  $('#UpdateEmployees').modal('show');
});


$(document).on('click', '.SaveNewEmployeeU', function(){
  EmployeeName=document.getElementById("EmployeeNameU").value;
  EmployeeQulaification=document.getElementById("EmployeeQulaificationU").value;
  EmployeeDistrict=document.getElementById("EmployeeDistrictU").value;
  EmployeeMobile=document.getElementById("EmployeeMobileU").value;
  Target=document.getElementById("EmployeeTargetU").value;
  if (EmployeeName!='' && EmployeeQulaification!='' && EmployeeDistrict!='' && EmployeeMobile!='') {
    $.ajax({
     url:"dataget.php",
     method:"POST",
     data:{'EmployeeNameU':EmployeeName, 'EmployeeQulaificationU':EmployeeQulaification, 'EmployeeDistrictU':EmployeeDistrict,'EmployeeMobileU':EmployeeMobile,'EmployeeCodeU':EmployeeCodeU, 'EmployeeTargetU':Target},
     success:function(data){
      swal("success","New employee added","success");
      $('#UpdateEmployees').modal('hide');
      //$('#NewEmployeeF').trigger("reset");
      var delayInMilliseconds = 1000; 

      setTimeout(function() {

        $.ajax({
         url:"dataget.php",
         method:"POST",
         data:{'view':'Employeelist'},
         success:function(data){
          $('#employeelist').html(data);
          $('#Employees').modal('show');
        }
      });

      }, delayInMilliseconds);
    }
  });
  }else{
    swal("error","Please enter all fields.","error");
  }
});

$(document).on('change', '#Inservice', function(){
  var Inservice= $(this).val();
  var EmployeeCode=$(this).attr("id2");
  $.ajax({
   url:"dataget.php",
   method:"POST",
   data:{'Inservice':Inservice, 'EmployeeCode':EmployeeCode},
   success:function(data){

   }
 });

  var delayInMilliseconds = 1000; 

  setTimeout(function() {

    $.ajax({
     url:"dataget.php",
     method:"POST",
     data:{'view':'Employeelist'},
     success:function(data){
      $('#employeelist').html(data);
      $('#Employees').modal('show');
    }
  });
    
  }, delayInMilliseconds);


});


$(document).on('click', '.Executive', function(){
  $.ajax({
   url:"dataget.php",
   method:"POST",
   data:{'viewExecutive':'ExecutiveList'},
   success:function(data){
    $('.Executive-Table').DataTable().clear();
    $('.Executive-Table').DataTable().destroy();
    $('#executivelist').html(data);

    $('table.Executive-Table').DataTable( {

      rowReorder: {
        selector: 'td:nth-child(2)'
      },

      "lengthMenu": [[10, 50, 100, -1], [10, 25, 50, "All"]],
      responsive: false
    } ); 

    $('#Executive').modal('show');
  }
});
});

$(document).on('click', '.BankReminders', function(){
  $.ajax({
   url:"dataget.php",
   method:"POST",
   data:{'BankReminders':'BankReminders'},
   success:function(data){
    $('#BankReminderData').html(data);
    $('#BankReminders').modal('show');
  }
});
});


$(document).on('change', '#ChangeReminder', function(){
  var ExecutiveID= $(this).val();
  var ZoneCode=$(this).attr("id2");
  $.ajax({
   url:"dataget.php",
   method:"POST",
   data:{'NewReminder':ExecutiveID, 'ZoneCode':ZoneCode},
   success:function(data){

   }
 });

  var delayInMilliseconds = 1000; 

  setTimeout(function() {

    $.ajax({
     url:"dataget.php",
     method:"POST",
     data:{'BankReminders':'BankReminders'},
     success:function(data){
      $('#BankReminderData').html(data);
      $('#BankReminders').modal('show');
    }
  });

  }, delayInMilliseconds);


});



function myFunction5() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput5");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable6");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}

function myFunction6() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput6");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable6");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[2];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}