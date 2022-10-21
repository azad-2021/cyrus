var BranchCode=0;

$(document).on('click', '.Bill', function(){
  //$('#dataModal').modal();
  BranchCode = $(this).attr("id");
  document.getElementById("branch").value = BranchCode;
  console.log(BranchCode);
  $.ajax({
   url:"Bill.php",
   method:"POST",
   data:{BranchCode:BranchCode},
   success:function(data){
    //$('#BillData').html(data);
    

    $('.display2').DataTable().clear();
    $('.display2').DataTable().destroy();
    $('#BillData').html(data);

    $('table.display2').DataTable( {

      rowReorder: {
        selector: 'td:nth-child(2)'
      },
      "lengthMenu": [[10, 50, 100, -1], [10, 25, 50, "All"]],
      responsive: false
    } );

    //$('#BillData').html(data);




  }
});
});


function selectElementContents(el) {
  var body = document.body, range, sel;
  if (document.createRange && window.getSelection) {
    range = document.createRange();
    sel = window.getSelection();
    sel.removeAllRanges();
    try {
      range.selectNodeContents(el);
      sel.addRange(range);
    } catch (e) {
      range.selectNode(el);
      sel.addRange(range);
    }
  } else if (body.createTextRange) {
    range = body.createTextRange();
    range.moveToElementText(el);
    range.select();
  }
}

$(document).on('click', '.close', function(){


});



$(document).on('click', '.SaveReminder', function(){
  var BillID=document.getElementById("billid").value;
  var BranchCode=document.getElementById("branch").value;
  var Conversation=document.getElementById("conversation").value;
  var NextDate=document.getElementById("NextDate").value;
  var actionCheck=document.getElementById("Action");
  var CallReceived =$('input[name="CallReceived"]:checked').val();
  //alert(CallReceived);
  if (actionCheck.checked == true){
    Action=1;
  }else{
    Action=0;
  }

  console.log(BranchCode);
  const obj = {BranchCode: BranchCode, BillID: BillID, Description: Conversation, NextReminderDate: NextDate, Action: Action};
  const Data = JSON.stringify(obj);
  console.log(Data);
  if (Conversation=='' || NextDate=='') {
    alert("Please enter all details")
  }else{
    $.ajax({
     url:"dataget.php",
     method:"POST",
     data:{Data:Data},
     success:function(data){
      $.ajax({
       url:"Bill.php",
       method:"POST",
       data:{BranchCode:BranchCode},
       success:function(data){
        $('#BillData').html(data);
        if (CallReceived=='yes') {
          $('#Bill').modal('show');
        }
      }
    });
      if(CallReceived=='No'){

       $.ajax({
        url:"dataget.php",
        method:"POST",
        data:{'BranchCodeM':BranchCode, 'Getmail':'GetEmail'},
        success:function(data){
           //$('#BranchMobile').html(data);
           //alert(data);

           const obj = JSON.parse(data);
           var Mobile1 = obj.Mobile1;
           var Mobile2 = obj.Mobile2;
           var Mobile3 = obj.Mobile3;
           var Email = obj.Email;
           var Phone=obj.Phone;
           document.getElementById("MailBranchCode").value=BranchCode;
           document.getElementById("BranchNo1").value=Mobile1;
           document.getElementById("BranchNo2").value=Mobile2;
           document.getElementById("BranchNo3").value=Mobile3;
           document.getElementById("BranchMail").value=Email;
           document.getElementById("BranchPhone").value=Phone;

           if (Mobile1 && Email) {
            document.getElementById("BranchNo1").disabled = true;  
            document.getElementById("BranchMail").disabled = true;  
          }else if (Mobile1 && Mobile2 && Mobile3) {
           document.getElementById("BranchNo1").disabled = true;  
           document.getElementById("BranchNo2").disabled = true; 
           document.getElementById("BranchNo3").disabled = true; 
         }else if(Mobile1 && (Email=='' || Email=='no email')) {
           document.getElementById("BranchNo1").disabled = true;  
           document.getElementById("BranchMail").disabled = false;  
         }else if(Mobile1=='' && Email) {
           document.getElementById("BranchNo1").disabled = false;  
           document.getElementById("BranchNo1").type="number";
           document.getElementById("BranchMail").disabled = true;  
         }else if(Mobile1=='' && (Email=='' || Email=='no email')) {
           document.getElementById("BranchNo1").disabled = false;  
           document.getElementById("BranchNo1").type="number";
           document.getElementById("BranchMail").disabled = false;  
         }


         $('#MailBox').modal('show');
       }
     });


     }else{
      $.ajax({
       url:"Bill.php",
       method:"POST",
       data:{BranchCode:BranchCode},
       success:function(data){
        $('#BillData').html(data);
        $('#Bill').modal('show');
      }
    });
    }
    document.getElementById("FormReminder").reset();
    document.getElementById("branch").value = BranchCode;

  }
});
  }
});


 //Modals Script

 var exampleModal = document.getElementById('reminder')
 exampleModal.addEventListener('show.bs.modal', function (event) {
  // Button that triggered the modal
  var button = event.relatedTarget
  // Extract info from data-bs-* attributes
  var BillID = button.getAttribute('data-bs-BillID')
  var BillNo = button.getAttribute('data-bs-Billno')
  document.getElementById("billid").value = BillID;
  console.log(BillID);
  var modalTitle = exampleModal.querySelector('.modal-title')

  modalTitle.textContent = 'Bill No. ' + BillNo

})


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

 var Moberr=0;

 $(document).on('click', '.SendMail', function(){

  var Mobile1=document.getElementById("BranchNo1").value;
  var Mobile2=document.getElementById("BranchNo2").value;
  var Mobile3=document.getElementById("BranchNo3").value;

  if ($('#CheckBranchNo1').is(":checked") && Mobile1.length<10) {
    swal("error","Mobile Number must be 10 digit long","error");
    Moberr=1;
  }

  if ($('#CheckBranchNo2').is(":checked")  && Mobile2.length<10) {
    swal("error","Mobile Number must be 10 digit long","error");
    Moberr=1;
  }

  if ($('#CheckBranchNo3').is(":checked")  && Mobile3.length<10) {
    swal("error","Mobile Number must be 10 digit long","error");
    Moberr=1;
  }



  var BranchCode=document.getElementById("MailBranchCode").value;
  var Email=document.getElementById("BranchMail").value;
  var BranchPhone=document.getElementById("BranchPhone").value;

  if (BranchCode && Email && (Mobile1 || Mobile2 || Mobile3 || BranchPhone) && Moberr==0) {

    $.ajax({
     url:"/cyrus/phpmailer/email.php",
     method:"POST",
     data:{'Mobile1':Mobile1, 'Mobile2':Mobile2, 'Mobile3':Mobile3, 'EmailID':Email, 'BranchCode':BranchCode, 'BranchPhone':BranchPhone},
     success:function(data){
      //alert(data);
      swal("success","mail sent","success");
    //$('#ViewOrderData').html(data);
    $('#MailBox').modal('hide');

    $.ajax({
     url:"Bill.php",
     method:"POST",
     data:{BranchCode:BranchCode},
     success:function(data){
    //$('#BillData').html(data);
    

    $('.display2').DataTable().clear();
    $('.display2').DataTable().destroy();
    $('#BillData').html(data);

    $('table.display2').DataTable( {

      rowReorder: {
        selector: 'td:nth-child(2)'
      },
      "lengthMenu": [[10, 50, 100, -1], [10, 25, 50, "All"]],
      responsive: false
    } );

    //$('#BillData').html(data);




  }
});
  }
});

  }else{
    swal("error","Please enter all fields","error");
  }
});