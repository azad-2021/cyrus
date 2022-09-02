 $(document).on('change','#Bank', function(){
  var BankCode = $(this).val();
  if(BankCode){
    $.ajax({
      type:'POST',
      url:'dataget.php',
      data:{'Bank':BankCode},
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
      url:'dataget.php',
      data:{'Br':BranchCode},
      success:function(result){
        $('#BranchC').html(result);

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
});

 $(document).on('click','.addItems', function(){
  var RateID=document.getElementById("items").value;
  var Qty=document.getElementById("addQty").value;
  var ApprovalID=document.getElementById("apd").value;

  if(newQty){
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
});

