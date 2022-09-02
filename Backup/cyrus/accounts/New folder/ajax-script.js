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
      url:'VATView.php',
      data:{'BranchCode':BranchCode},
      success:function(result){
        $('#VatView').html(result);

      }
    }); 

    $.ajax({
      type:'POST',
      url:'GSTView.php',
      data:{'BranchCode':BranchCode},
      success:function(result){
        $('#GSTView').html(result);

      }
    });

  }
});



 $(document).on('click', '.payment', function(){

  var Billno=document.getElementById("billno").value;
  var DD=document.getElementById("DD").value;
  var Remark=document.getElementById("Remark").value;
  var ReceiveAmount=document.getElementById("receiveamount").value;
  var ReceiveDate=document.getElementById("receivedate").value;

  var SecurityAmount=document.getElementById("securityamount").value;
  var Sreleasedate=document.getElementById("securityDate").value;
  

  var SReceiveAmount=document.getElementById("SreceiveAmount").value;
  var SReceiveDate=document.getElementById("SreceiveDate").value;
  
  var BranchCode=document.getElementById("Branch").value;

  newObj={Billno: Billno, ReceiveAmount: ReceiveAmount, ReceiveDate: ReceiveDate, SecurityAmount: SecurityAmount, SReceiveAmount: SReceiveAmount, SReceiveDate: SReceiveDate, Sreleasedate: Sreleasedate, DD: DD, Remark: Remark};
  const Data = JSON.stringify(newObj);

  console.log(Data);
  var textbox = document.getElementById('receiveamount');

  if (ReceiveAmount >0.00 && ReceiveDate=='') {
    alert("Please Select Receive Date");
  }else{
    $.ajax({
     url:"dataget.php",
     method:"POST",
     data:{Data:Data},
     success:function(data){
      $.ajax({
        type:'POST',
        url:'GSTView.php',
        data:{'BranchCode':BranchCode},
        success:function(result){
          $('#GSTView').html(result);

        }
      });

    }
  });
  }
});


/*
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
      url:'dataget.php',
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
  $.ajax({
   url:"GSTView.php",
   method:"POST",
   data:{BranchCode:BranchCode},
   success:function(data){
    $('#GSTData').html(data);
    $('#ViewGST').modal('show');
  }
});
});*/