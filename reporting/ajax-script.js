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


 $(document).on('change','#Zone', function(){
  var ZoneCode = $(this).val();
  if(ZoneCode){
    $.ajax({
      type:'POST',
      url:'dataget.php',
      data:{'ItemZone':ZoneCode},
      success:function(result){
        $('#items').html(result);

      }
    });
  }
});



 $(document).on('change','#Branch', function(){
  var BranchCode = $(this).val();
  if(BranchCode){
    $.ajax({
      type:'POST',
      url:'estView.php',
      data:{'Branch':BranchCode,},
      success:function(result){
        $('#estimateView').html(result);

      }
    }); 

  }
});



 $(document).on('change','#BankAddEst', function(){
  var BankCode = $(this).val();
  //alert(BankCode);
  if(BankCode){
    $.ajax({
      type:'POST',
      url:'dataget.php',
      data:{'BankCode':BankCode},
      success:function(result){
        $('#ZoneAddEst').html(result);
        
      }
    }); 
  }else{
    $('#ZoneAddEst').html('<option value="">Zone</option>');
    $('#BranchAddEst').html('<option value="">Branch</option>'); 
  }
});
 
 $(document).on('change','#ZoneAddEst', function(){
  var ZoneCode = $(this).val();
  if(ZoneCode){
    $.ajax({
      type:'POST',
      url:'dataget.php',
      data:{'ZoneCode':ZoneCode},
      success:function(result){
        $('#BranchAddEst').html(result);
        
      }
    });
    
  }else{

    $('#BranchAddEst').html('<option value=""> Branch </option>'); 
  }
});


 $(document).on('change','#ZoneAddEst', function(){
  var ZoneCode = $(this).val();
  if(ZoneCode){
    $.ajax({
      type:'POST',
      url:'dataget.php',
      data:{'ItemZone':ZoneCode},
      success:function(result){
        $('#ItemsEstimate').html(result);
      }
    });
  }
});



 $(document).on('change','#BranchAddEst', function(){
  var BranchCode = $(this).val();
  if(BranchCode){
    $.ajax({
      type:'POST',
      url:'estView.php',
      data:{'Branch':BranchCode,},
      success:function(result){
        $('#estimateView').html(result);

      }
    }); 

    $.ajax({
      type:'POST',
      url:'dataget.php',
      data:{'BranchEst':BranchCode,},
      success:function(result){
        $('#EstAddData').html(result);

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
   url:"Estimate.php",
   method:"POST",
   data:{ApprovalID:ApprovalID},
   success:function(data){
    $('#EstimateData').html(data);
    $('#Estimate').modal('show');
  }
});
});

 $(document).on('click', '.Delete', function(){
  //$('#dataModal').modal();
  //var userid = document.getElementById("delete").value;
  var EstimateID=document.getElementById("delest").value;
  var ApprovalID=document.getElementById("delap").value;
 // var rawData = $(this).val();
 console.log(ApprovalID);
 console.log(EstimateID);




 if(EstimateID){
  $.ajax({
    url:"estupdate.php",
    method:"POST",
    data:{EstimateID:EstimateID},
    success:function(data){

      $.ajax({
       url:"Estimate.php",
       method:"POST",
       data:{ApprovalID:ApprovalID},
       success:function(data){
        $('#EstimateData').html(data);
        $('#Estimate').modal('show');
      }
    });

    }
  });
}
});




 $(document).on('click','.QtyUpdate', function(){
  var EstimateID=document.getElementById("es").value;
  var newQty=document.getElementById("newQty").value;
  var ApprovalID=document.getElementById("ap").value;
  if (newQty==='0') {
    alert("Quantity must be greater than 0");
  }else{
    if(newQty){
      newObj={EstimateID: EstimateID, newQty: newQty};
      const Data = JSON.stringify(newObj);
      console.log(Data);
      $.ajax({
        type:'POST',
        url:'estupdate.php',
        data:{Data:Data},
        success:function(result){
          $.ajax({
           url:"Estimate.php",
           method:"POST",
           data:{ApprovalID:ApprovalID},
           success:function(data){
            $('#EstimateData').html(data);
            $('#Estimate').modal('show');
          }
        });

        }
      }); 
    }
  }
});

 $(document).on('click','.addItems', function(){
  var RateID=document.getElementById("items").value;
  var Qty=document.getElementById("addQty").value;
  var ApprovalID=document.getElementById("apd").value;
  if (Qty==='') {
    alert("Please enter quantity");
  }else{
    if(Qty){
      newObj={RateID: RateID, Qty: Qty, ApprovalID: ApprovalID};
      const Data = JSON.stringify(newObj);
      console.log(Data);
      $.ajax({
        type:'POST',
        url:'estupdate.php',
        data:{AddData:Data},
        success:function(result){
          $.ajax({
           url:"Estimate.php",
           method:"POST",
           data:{ApprovalID:ApprovalID},
           success:function(data){
            $('#EstimateData').html(data);
            $('#Estimate').modal('show');
          }
        });

        }
      }); 
    }
  }
});



 $(document).on('change','#Branch', function(){
  var BranchCode = $(this).val();
  if(BranchCode){
    $.ajax({
      type:'POST',
      url:'details.php',
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
      url:'details.php',
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
      url:'details.php',
      data:{'BranchCode':BranchCode},
      success:function(result){
        $('#Order').html(result);        

        
      }
    }); 
  }
});


 $(document).on('change','#Branch', function(){
  var BranchCode = $(this).val();
  if(BranchCode){
    $.ajax({
      type:'POST',
      url:'details.php',
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
      url:'details.php',
      data:{'Branch':BranchCode},
      success:function(result){
        $('#jobcard').html(result);

      }
    }); 
  }
});


 $(document).on('click', '.view_vat', function(){
  //$('#dataModal').modal();
  var BranchCode = $(this).attr("id");
  $.ajax({
   url:"VATView.php",
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
   url:"GSTView.php",
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


 $(document).on('click', '.SaveNewEstimate', function(){

  var BranchCode = document.getElementById("BranchAddEst").value;
  if (BranchCode) {
    $.ajax({
      url:"dataget.php",
      method:"POST",
      data:{'GenEstimate':BranchCode},
      success:function(data){
            //alert(data);
            if (data>0) {
              //window.open( link,'_blank');
              window.open('viewe.php?apid='+data,'_blank');
            }
          }
        });
  }
});


 $(document).on('click', '.AddToEstimate', function(){

  var RateID = document.getElementById("ItemsEstimate").value;
  var Qty = document.getElementById("qtyEstimate").value;
  var BranchCode=document.getElementById("BranchAddEst").value;
  if (RateID && Qty && BranchCode) {
    $.ajax({
      url:"dataget.php",
      method:"POST",
      data:{'EstimateRateID':RateID, 'EstQty':Qty, 'EstBranch':BranchCode},
      success:function(data){
        //alert(data);
      }
    });

    var delayInMilliseconds = 1000; 

    setTimeout(function() {
      $.ajax({
        type:'POST',
        url:'dataget.php',
        data:{'BranchEst':BranchCode,},
        success:function(result){
          $('#EstAddData').html(result);
          $('#FNewEst').trigger("reset");
        }
      }); 
    }, delayInMilliseconds);
  }else{
    swal("error","Please enter all fields","error");
  }
});


 $(document).on('click', '.DelEst', function(){

  var RateID = $(this).attr("id");
  var BranchCode=document.getElementById("BranchAddEst").value;
  if (RateID && BranchCode) {
    $.ajax({
      url:"dataget.php",
      method:"POST",
      data:{'DelEst':RateID, 'BranchCodeDel':BranchCode},
      success:function(data){
        //alert(data);
      }
    });

    var delayInMilliseconds = 1000; 

    setTimeout(function() {
      $.ajax({
        type:'POST',
        url:'dataget.php',
        data:{'BranchEst':BranchCode,},
        success:function(result){
          $('#EstAddData').html(result);

        }
      }); 
    }, delayInMilliseconds);
  }
});