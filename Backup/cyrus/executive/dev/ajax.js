   function limits(element, limit)
   {
    var max_chars = limit;

    if(element.value.length > max_chars) {
      element.value = element.value.substr(0, max_chars);
    }
  }

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


  $(document).on('change','#BankVisit', function(){
    var BankCode = $(this).val();
    if(BankCode){
      $.ajax({
        type:'POST',
        url:'dataget.php',
        data:{'BankCode':BankCode},
        success:function(result){
          $('#ZoneVisit').html(result);

        }
      }); 
    }else{
      $('#ZoneVisit').html('<option value="">Zone</option>');
    }
  });


  $(document).on('change','#DesignationVisit', function(){
    var DesignationID = $(this).val();
    var ZoneCode=document.getElementById("ZoneVisit").value;
    if(DesignationID){
      $.ajax({
        type:'POST',
        url:'dataget.php',
        data:{'DesignationIDVisit':DesignationID, 'ZoneCodeVisit':ZoneCode},
        success:function(result){
          $('#BEmployeeVisit').html(result);

        }
      }); 
    }else{
      $('#BEmployeeVisit').html('<option value="">No Bank Employee</option>');
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
      $.ajax({
        type:'POST',
        url:'dataget.php',
        data:{'ZoneCodeAMC':ZoneCode},
        success:function(result){
          $('#AMCVisit').html(result);

        }
      });

    }else{

      $('#Branch').html('<option value=""> Branch </option>'); 
    }
  });




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
     url:"dataget.php",
     method:"POST",
     data:{Data:Data},
     success:function(data){
      $('#ItemID').html(data);
      $('#add').modal('show');
    }
  });
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


  $(document).on('click', '.addItems', function(){
  //$('#dataModal').modal();
  var OrderID=document.getElementById("orderid").value;
  var json=document.getElementById("ItemID").value;
  var obj = JSON.parse(json);
  var RateID=obj.RateID;
  var ItemID=obj.ItemID;
  console.log(json);
  var Qty=document.getElementById("qty").value;
  var ZoneCode=document.getElementById("ZoneCode").value;
  //console.log(ItemID);
  //console.log(OrderID);
  //console.log(Qty);
  newObj2={OrderID: OrderID, ZoneCode: ZoneCode};
  const Data2 = JSON.stringify(newObj2);
  newObj={OrderID: OrderID, RateID: RateID, ItemID:ItemID, Qty: Qty, Type: "Add"};
  const Data = JSON.stringify(newObj);


  console.log(Data);
  if (Qty==='' || Qty==0 || RateID==='') {
    alert("Quantity or item must be greater than 0.");
  }else{
    $.ajax({
     url:"add.php",
     method:"POST",
     data:{Data:Data},
     success:function(data){
      $('#material').html(data);
      $.ajax({
       url:"dataget.php",
       method:"POST",
       data:{ZoneCode:ZoneCode},
       success:function(data){
        $('#RateID').html(data);
        $('#add').modal('show');

        $.ajax({
          type:'POST',
          url:'material.php',
          data:{Data:Data2},
          success:function(result){
            $('#material').html(result);

          }
        }); 

        document.getElementById("f1").reset();
        document.getElementById("orderid").value = OrderID;
        document.getElementById("ZoneCode").value = ZoneCode;
      }
    });
    }
  });
  }
});

  $(document).on('click', '.delete', function(){

    var OrderID=document.getElementById("orderid").value;
    var RateID=$(this).val();
    var Qty=document.getElementById("qty").value;
    var ZoneCode=document.getElementById("ZoneCode").value;
    newObj2={OrderID: OrderID, ZoneCode: ZoneCode};
    const Data2 = JSON.stringify(newObj2);
    newObj={OrderID: OrderID, RateID: RateID, Type: "Delete"};
    const Data = JSON.stringify(newObj);

    console.log(Data);
    $.ajax({
     url:"add.php",
     method:"POST",
     data:{Data:Data},
     success:function(data){
      $.ajax({
       url:"dataget.php",
       method:"POST",
       data:{ZoneCode:ZoneCode},
       success:function(data){
        $('#RateID').html(data);
        $('#add').modal('show');

        $.ajax({
          type:'POST',
          url:'material.php',
          data:{Data:Data2},
          success:function(result){
            $('#material').html(result);

          }
        }); 

        document.getElementById("f1").reset();
        document.getElementById("orderid").value = OrderID;
        document.getElementById("ZoneCode").value = ZoneCode;
      }
    });
    }
  });
  });


  $(document).on('click', '.confirm', function(){
  //$('#dataModal').modal();
  var OrderID=document.getElementById("orderid").value;
  var ZoneCode=document.getElementById("ZoneCode").value;
  //console.log(ItemID);
  //console.log(OrderID);
  //console.log(Qty);
  newObj2={OrderID: OrderID, ZoneCode: ZoneCode};
  const Data2 = JSON.stringify(newObj2);

  console.log(Data2);
  if (confirm("You want to Confirm all items. do you wish to continue?")) {
    $.ajax({
     url:"addDemand.php",
     method:"POST",
     data:{OrderID:OrderID},
     success:function(data){
      $('#material').html(data);
      $.ajax({
       url:"dataget.php",
       method:"POST",
       data:{ZoneCode:ZoneCode},
       success:function(data){
        $('#RateID').html(data);
        $('#add').modal('show');

        $.ajax({
          type:'POST',
          url:'material.php',
          data:{Data:Data2},
          success:function(result){
            $('#material').html(result);

          }
        }); 

        document.getElementById("f1").reset();
        document.getElementById("orderid").value = OrderID;
        document.getElementById("ZoneCode").value = ZoneCode;
      }
    });
    }
  });
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


  $(document).on('click', '.saveQty', function(){
  //$('#dataModal').modal();
  var OrderID=document.getElementById("Order").value;
  var ItemID=document.getElementById("ItemIDUpdate").value;
  var Qty=document.getElementById("NewQty").value;
  var ZoneCode=document.getElementById("Zone").value;
  console.log(ItemID);
  console.log(OrderID);
  console.log(Qty);
  newObj2={Qty: Qty, ItemID: ItemID, Type: "update", OrderID: OrderID};
  const Data = JSON.stringify(newObj2);
  console.log(Data);
  if (Qty==='' || Qty==0) {
    alert("Quantity or item must be greater than 0.");
  }else{
    $.ajax({
     url:"update.php",
     method:"POST",
     data:{Data:Data},
     success:function(data){
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
    }
  });
  }
});


  $(document).on('click', '.deleteItemData', function(){
    var ItemID = $(this).attr("id");
    var OrderID=document.getElementById("Order").value;
  //var ItemID=document.getElementById("ItemIDUpdate").value;
  var Qty="";
  var ZoneCode=document.getElementById("Zone").value;
  console.log(ItemID);
  console.log(OrderID);
  console.log(Qty);
  newObj2={Qty: Qty, ItemID: ItemID, Type: "DeleteItems", OrderID: OrderID};
  const Data = JSON.stringify(newObj2);
  console.log(Data);
  if (confirm("Please Confirm to delete item")) {
    $.ajax({
     url:"add.php",
     method:"POST",
     data:{Data:Data},
     success:function(data){
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
    }
  });
  }
});



  $(document).on('click', '.addUpdate', function(){
    var OrderID=document.getElementById("order_id").value;
    var ZoneCode=document.getElementById("zone_code").value;
    console.log(ZoneCode);
    console.log(OrderID);
    if (ZoneCode) {
      newObj={OrderID: OrderID, ZoneCode: ZoneCode};
      const Data = JSON.stringify(newObj);
      $.ajax({
       url:"dataget.php",
       method:"POST",
       data:{Data:Data},
       success:function(data){
        $('#ItemID').html(data);
        $('#add').modal('show');
      }
    });
      $.ajax({
        type:'POST',
        url:'material2.php',
        data:{Data:Data},
        success:function(result){
          $('#material').html(result);

        }
      }); 
    }
  });



  $(document).on('click', '.addUpdateItems', function(){
  //$('#dataModal').modal();
  var OrderID=document.getElementById("order_id").value;
  var ZoneCode=document.getElementById("zone_code").value;
  var Qty=document.getElementById("qty").value;
  var json=document.getElementById("ItemID").value;
  var obj = JSON.parse(json);
  var RateID=obj.RateID;
  var ItemID=obj.ItemID;

  newObj2={OrderID: OrderID, ZoneCode: ZoneCode};
  const Data2 = JSON.stringify(newObj2);
  newObj={OrderID: OrderID, RateID: RateID, Qty: Qty, ItemID: ItemID, Type: "Add"};
  const Data = JSON.stringify(newObj);


  console.log(Data);
  if (Qty==='' || Qty==0 || RateID==='') {
    alert("Quantity or item must be greater than 0.");
  }else{
    $.ajax({
     url:"add.php",
     method:"POST",
     data:{Data:Data},
     success:function(data){
      $('#material').html(data);
      $.ajax({
       url:"dataget.php",
       method:"POST",
       data:{ZoneCode:ZoneCode},
       success:function(data){
        $('#RateID').html(data);
        $('#add').modal('show');

        $.ajax({
          type:'POST',
          url:'material2.php',
          data:{Data:Data2},
          success:function(result){
            $('#material').html(result);

          }
        }); 

        document.getElementById("f1").reset();
        document.getElementById("order_id").value = OrderID;
        document.getElementById("zone_code").value = ZoneCode;
      }
    });
    }
  });
  }
});

  $(document).on('click', '.deleteItems', function(){
  //$('#dataModal').modal();

  var OrderID=document.getElementById("order_id").value;

  
  
  //var ZoneCode2=document.getElementById("zone_code").value;
  var RateID=$(this).val();
  var Qty=document.getElementById("qty").value;
  var ZoneCode=document.getElementById("zone_code").value;
  //console.log(ItemID);
  //console.log(OrderID);
  //console.log(Qty);
  newObj2={OrderID: OrderID, ZoneCode: ZoneCode};
  const Data2 = JSON.stringify(newObj2);
  newObj={OrderID: OrderID, RateID: RateID, Type: "Delete"};
  const Data = JSON.stringify(newObj);


  console.log(Data);
  $.ajax({
   url:"add.php",
   method:"POST",
   data:{Data:Data},
   success:function(data){
    $.ajax({
     url:"dataget.php",
     method:"POST",
     data:{ZoneCode:ZoneCode},
     success:function(data){
      $('#RateID').html(data);
      $('#add').modal('show');

      $.ajax({
        type:'POST',
        url:'material2.php',
        data:{Data:Data2},
        success:function(result){
          $('#material').html(result);

        }
      }); 

      document.getElementById("f1").reset();
      document.getElementById("order_id").value = OrderID;
      document.getElementById("zone_code").value = ZoneCode;
    }
  });
  }
});
});


  $(document).on('click', '.confirmUpdate', function(){
  //$('#dataModal').modal();
  var OrderID=document.getElementById("order_id").value;
  var ZoneCode=document.getElementById("zone_code").value;
  //console.log(ItemID);
  //console.log(OrderID);
  //console.log(Qty);
  newObj2={OrderID: OrderID, ZoneCode: ZoneCode};
  const Data2 = JSON.stringify(newObj2);

  console.log(Data2);
  if (confirm("You want to Confirm all items. do you wish to continue?")) {
    $.ajax({
     url:"addDemand.php",
     method:"POST",
     data:{OrderID:OrderID},
     success:function(data){
      $('#material').html(data);
      $.ajax({
       url:"dataget.php",
       method:"POST",
       data:{ZoneCode:ZoneCode},
       success:function(data){
        $('#RateID').html(data);
        $('#add').modal('show');

        $.ajax({
          type:'POST',
          url:'material2.php',
          data:{Data:Data2},
          success:function(result){
            $('#material').html(result);

          }
        }); 

        document.getElementById("f1").reset();
        document.getElementById("order_id").value = OrderID;
        document.getElementById("Zone_code").value = ZoneCode;
      }
    });
    }
  });
  }
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

  $(document).on('click', '.AssignedRegion', function(){

    $.ajax({
      type:'POST',
      url:'dataget.php',
      data:{'Regiondata':'Data'},
      success:function(result){
        $('#RegionData').html(result);

      }
    }); 
  });

  $(document).on('click', '.BankVisit', function(){

    $.ajax({
      type:'POST',
      url:'dataget.php',
      data:{'BankVisit':'BankCode'},
      success:function(result){
        $('#BankVisitData').html(result);
      }
    }); 
  });


  $(document).on('click', '.saveBankVisit', function(){

    var DesignationID=document.getElementById("DesignationVisit").value;
    var BEmployeeVisit=document.getElementById("BEmployeeVisit").value;
    var VisitDate=document.getElementById("VisitDateD").value;
    var Description=document.getElementById("DescriptionD").value;
    var NextVisitDate=document.getElementById("NextVisitDateD").value;
    var ZoneCode=document.getElementById("ZoneVisit").value;
    console.log(DesignationID);
    console.log(BEmployeeVisit);
    console.log(VisitDate);
    console.log(Description);
    console.log(NextVisitDate);
    
    if (DesignationID && BEmployeeVisit && VisitDate && Description && NextVisitDate) {

      $.ajax({
        type:'POST',
        url:'dataget.php',
        data:{'DesignationIDVEntry':DesignationID, 'BEmployeeVisit':BEmployeeVisit, 'VisitDate':VisitDate, 'Description':Description, 'NextVisitDate':NextVisitDate, 'ZoneCodeVEntry':ZoneCode},
        success:function(result){
          if ((result)==1) {
            swal("success","Data enter successfully",'success');
            $('#FBankVisit').trigger('reset');
          }else{
            swal("error",(result),'error');
          }

        }
      });

      }else{
        swal("error","Please enter all fields","error");
      } 

      $.ajax({
        type:'POST',
        url:'dataget.php',
        data:{'BankVisit':'BankCode'},
        success:function(result){
          $('#BankVisitData').html(result);
        //$('#AddBankVisit').modal('show');
      }
    }); 
  });

  $(document).on('click','.SaveBankEmployee', function(){
    var ZoneCode = document.getElementById("Zone").value;
    var DesignationID = document.getElementById("DesignationID").value;
    var Name = document.getElementById("DName").value;
    var Mobile = document.getElementById("DMobile").value;
    //console.log(ZoneCode);
    if(ZoneCode && DesignationID && Name && Mobile){
      $.ajax({
        type:'POST',
        url:'dataget.php',
        data:{'ZoneCodeD':ZoneCode, 'DesignationID':DesignationID, 'DName':Name, 'DMobile':Mobile},
        success:function(result){
          if ((result)==1) {
            swal("success", Name+" Added", "success");
            $('#FBankEmployee').trigger('reset');
            $('#AddBankVisit').modal('show');
          }else{
            swal("error", result , "error");
          }
        }
      }); 
    }else{
      swal("error","Please enter all fields","error");
    }
  });