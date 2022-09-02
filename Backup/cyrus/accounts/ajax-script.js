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

  if (ReceiveAmount >=0.00 && ReceiveDate=='') {
    swal("error","Please Select Receive Date", "error");
  }else{
    $.ajax({
     url:"dataget.php",
     method:"POST",
     data: {"Billno":Billno, "ReceiveAmount": ReceiveAmount, "ReceiveDate": ReceiveDate, "SecurityAmount": SecurityAmount, "SReceiveAmount": SReceiveAmount, "SReceiveDate": SReceiveDate, "Sreleasedate": Sreleasedate, "DD": DD, "Remark": Remark, "Data":Data},
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

