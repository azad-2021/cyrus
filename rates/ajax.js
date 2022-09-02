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
        $('#itemdata').html(result);
        
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
    url:"/cyrus/reporting/estupdate.php",
    method:"POST",
    data:{EstimateID:EstimateID},
    success:function(data){

      $.ajax({
       url:"/cyrus/reporting/Estimate.php",
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
        url:'/cyrus/reporting/estupdate.php',
        data:{Data:Data},
        success:function(result){
          $.ajax({
           url:"/cyrus/reporting/Estimate.php",
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
        url:'/cyrus/reporting/estupdate.php',
        data:{AddData:Data},
        success:function(result){
          $.ajax({
           url:"/cyrus/reporting/Estimate.php",
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

*/

