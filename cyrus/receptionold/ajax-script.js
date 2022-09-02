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

    $.ajax({
      type:'POST',
      url:'dataget.php',
      data:{'ZoneCodeAMC':ZoneCode},
      success:function(result){
        $('#AMCVisit').html(result);

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
  console.log(BranchCode);
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
      url:'dataget.php',
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
      url:'dataget.php',
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
      url:'dataget.php',
      data:{'BCode':BranchCode},
      success:function(result){
        $('#BranchData').html(result);
        
      }
    }); 
  }
});


 $(document).on('click', '.view_data', function(){
  //$('#dataModal').modal();
  var OrderID = $(this).attr("id");
  $.ajax({
   url:"ordersView.php",
   method:"POST",
   data:{OrderID:OrderID},
   success:function(data){
    $('#OrdersData').html(data);
    $('#dataModal').modal('show');
  }
});
});

 $(document).on('click', '.view_complaint', function(){
  //$('#dataModal').modal();
  var ComplaintID = $(this).attr("id");
  console.log(ComplaintID);
  $.ajax({
   url:"complaintsView.php",
   method:"POST",
   data:{ComplaintID:ComplaintID},
   success:function(data){
    $('#ComplaintsData').html(data);
    $('#dataModal2').modal('show');
  }
});
});

 $(document).on('click', '.view_jobcard', function(){
  //$('#dataModal').modal();
  var ID = $(this).attr("id");
  $.ajax({
   url:"jobcardView.php",
   method:"POST",
   data:{ID:ID},
   success:function(data){
    $('#JobcardData').html(data);
    $('#dataModal3').modal('show');
  }
});
});


 function myFunction() {
  var BranchCode = document.getElementById("BranchC").value;
  var Device = document.getElementById("Device").value;
  var Type = document.getElementById("Type").value;
  var ReceivedBy = document.getElementById("ReceivedBy").value;
  var MadeBy = document.getElementById("MadeBy").value;
  var InfoDate = document.getElementById("InfoDateAdd").value;
  var Expected = document.getElementById("ExpectedAdd").value;
  var Discription = document.getElementById("DiscriptionAdd").value;

 console.log(BranchCode);
 console.log(Device);
 console.log(Type);
 console.log(ReceivedBy);
 console.log(MadeBy);
 console.log(Discription);
// Returns successful data submission message when the entered information is stored in database.
//var dataString = 'branch=' + BranchCode + '&device=' + Device + '&type=' + Type + '&receivedby=' + ReceivedBy + '&madeby=' + MadeBy + '&infodate=' + InfoDate + '&expected=' + Expected + '&discription=' + Discription;
if (BranchCode == '') {
  swal("error", "Please Select Branch", "error");
} else if(Device == '' || Type == '' || ReceivedBy == '' || MadeBy == '' || InfoDate == '' || Expected == '' || Discription == ''){
  swal("error", "Please enter all fields", "error");
} else{
  const obj = {BranchCode: BranchCode, Device: Device, Type: Type, ReceivedBy: ReceivedBy, MadeBy: MadeBy, InfoDate: InfoDate, Expected: Expected, Discription: Discription };
  const data = JSON.stringify(obj);
  console.log(data);
  document.getElementById("form").reset();
  $.ajax({
    type: "POST",
    url: "post.php",
    data: {'Data':data},
    cache: false,
    success: function(html) {
      swal("success", "Your " + Type + " registered successfully", "success");
    }
  });


  if(BranchCode){
    let interval = setInterval(function(){
      $.ajax({
        type:'POST',
        url:'dataget.php',
        data:{'Branch':BranchCode},
        success:function(result){
          $('#jobcard').html(result);     

          
        }
      });

      clearInterval(interval); 
    }, 1000);

  }

  if(BranchCode){
    let interval = setInterval(function(){
      $.ajax({
        type:'POST',
        url:'dataget.php',
        data:{'BranchCode':BranchCode},
        success:function(result){
          $('#Order').html(result);        

          
        }
      });

      clearInterval(interval); 
    }, 1000);

  }


  if(BranchCode){
    let interval = setInterval(function(){
      $.ajax({
        type:'POST',
        url:'dataget.php',
        data:{'BrCode':BranchCode},
        success:function(result){
          $('#Complaints').html(result);      

          
        }
      });

      clearInterval(interval); 
    }, 1000);

  }

}


return false;
}



function UpdatePhone() {
  var BranchCode = document.getElementById("BranchC").value;
  var Phone = document.getElementById("Phone").value;

  var dataString = 'branch=' + BranchCode + '&phone=' + Phone;
  if (Phone == '') {
    swal("error", "Please Enter Phone Number", "error");
  }else{
    document.getElementById("form3").reset();
    $.ajax({
      type: "POST",
      url: "update.php",
      data: dataString,
      cache: false,
      success: function(html) {
      //alert("Phone Number: " + Phone + " updated successfully");
      swal("success", "Phone Number: " + Phone + " updated successfully", "success");
    }
  });


    if(BranchCode){
      let interval = setInterval(function(){
        $.ajax({
          type:'POST',
          url:'dataget.php',
          data:{'BCode':BranchCode},
          success:function(result){
            $('#BranchData').html(result);

          }
        });

        clearInterval(interval); 
      }, 1000);

    }

  }


  return false;
}


function UpdateMobile() {
  var BranchCode = document.getElementById("BranchC").value;
  var Mobile = document.getElementById("Mobile").value;

// Returns successful data submission message when the entered information is stored in database.
var dataString = 'branch=' + BranchCode + '&mobile=' + Mobile;
if (Mobile == '') {
  swal("error", "Please Enter Mobile Number", "error");
}else{
  document.getElementById("form3").reset();
  $.ajax({
    type: "POST",
    url: "update.php",
    data: dataString,
    cache: false,
    success: function(html) {
      //alert("Mobile Number: " + Mobile + " updated successfully");
      swal("success", "Mobile Number: " + Mobile + " updated successfully", "success");
    }
  });


  if(BranchCode){
    let interval = setInterval(function(){
      $.ajax({
        type:'POST',
        url:'dataget.php',
        data:{'BCode':BranchCode},
        success:function(result){
          $('#BranchData').html(result);
          
        }
      });

      clearInterval(interval); 
    }, 1000);

  }

}


return false;
}


function UpdateEmail() {
  var BranchCode = document.getElementById("BranchC").value;
  var Email = document.getElementById("Email").value;
  //var Mobile = document.getElementById("Mobile").value;
  //var Email = document.getElementById("Email").value;
  //var GST = document.getElementById("GST").value;
// Returns successful data submission message when the entered information is stored in database.
var dataString = 'branch=' + BranchCode + '&email=' + Email;
if (Email == '') {
  swal("error", "Please Enter Email", "error");
}else{
  document.getElementById("form4").reset();
  $.ajax({
    type: "POST",
    url: "update.php",
    data: dataString,
    cache: false,
    success: function(html) {
      swal("success", "Email: " + Email + " updated successfully", "success");
    }
  });


  if(BranchCode){
    let interval = setInterval(function(){
      $.ajax({
        type:'POST',
        url:'dataget.php',
        data:{'BCode':BranchCode},
        success:function(result){
          $('#BranchData').html(result);
          
        }
      });

      clearInterval(interval); 
    }, 1000);

  }

}


return false;
}


function UpdateGST() {
  var BranchCode = document.getElementById("BranchC").value;
  var GST = document.getElementById("GST").value;

// Returns successful data submission message when the entered information is stored in database.
var dataString = 'branch=' + BranchCode + '&gst=' + GST;
if (GST == '') {
  swal("error", "Please Enter GST Number", "error");
}else{
  document.getElementById("form5").reset();
  $.ajax({
    type: "POST",
    url: "update.php",
    data: dataString,
    cache: false,
    success: function(html) {
      swal("success", "GST Number: " + GST + " updated successfully", "success");
    }
  });


  if(BranchCode){
    let interval = setInterval(function(){
      $.ajax({
        type:'POST',
        url:'dataget.php',
        data:{'BCode':BranchCode},
        success:function(result){
          $('#BranchData').html(result);
          
        }
      });

      clearInterval(interval); 
    }, 1000);

  }

}


return false;
}



function UpdateBranchCode() {
  var BranchCode = document.getElementById("BranchC").value;
  var Branch_code = document.getElementById("Branch_code").value;
  //var Mobile = document.getElementById("Mobile").value;
  //var Email = document.getElementById("Email").value;
  //var GST = document.getElementById("GST").value;
// Returns successful data submission message when the entered information is stored in database.
var dataString = 'branch=' + BranchCode + '&branch_code=' + Branch_code;
if (Branch_code == '') {
  swal("error", "Please Enter Branch Code Number", "error");
}else{
  document.getElementById("form5").reset();
  $.ajax({
    type: "POST",
    url: "update.php",
    data: dataString,
    cache: false,
    success: function(html) {
      swal("success", "Branch Code : " + Branch_code + " updated successfully", "success");
    }
  });


  if(BranchCode){
    let interval = setInterval(function(){
      $.ajax({
        type:'POST',
        url:'dataget.php',
        data:{'BCode':BranchCode},
        success:function(result){
          $('#BranchData').html(result);
          
        }
      });

      clearInterval(interval); 
    }, 1000);

  }

}


return false;
}





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
});


$(document).on('click', '.search_order', function(){
  //$('#dataModal').modal();
  var OrderID = document.getElementById("forder").value;
  $.ajax({
   url:"ordersView.php",
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
   url:"complaintsView.php",
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
   url:"jobcardView.php",
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
    swal("error","Please Select Search Type", "error");
  }else{
    $.ajax({
     url:"branchView.php",
     method:"POST",
     data:dataString,
     success:function(data){
      $('#ViewBranchData').html(data);
      $('#ViewBranch').modal('show');
    }
  });
  }
});


$(document).on('click', '.update_disc', function(){
  //$('#dataModal').modal();
  var disc = document.getElementById("disc").value;
  //console.log(disc);
  var OrderID = document.getElementById("OrderID1").value;
  var BranchCode = document.getElementById("Branch").value;

  const obj = {OrderID: OrderID, discription: disc};
  const Data = JSON.stringify(obj);
  console.log(Data);
 // var dataString = 'OrderID=' + OrderID + '&discription=' + disc;
 if (disc == '') {
  swal("error", "Please Enter Discription", "error");
}else{
  $.ajax({
   url:"orderUpdate.php",
   method:"POST",
   data:{Data:Data},
   success:function(data){
    //alert("Discription: " + disc + " updated successfully");
    swal("success", "Discription: " + disc + " updated successfully", "success");
  }
});


  if(OrderID){
    let interval = setInterval(function(){
      $.ajax({
       url:"ordersView.php",
       method:"POST",
       data:{OrderID:OrderID},
       success:function(data){
        $('#OrdersData').html(data);
        $('#dataModal').modal('show');

      }
    });

      clearInterval(interval); 
    }, 1000);

  }
  if(BranchCode){
    let interval = setInterval(function(){
      $.ajax({
        type:'POST',
        url:'dataget.php',
        data:{'BranchCode':BranchCode},
        success:function(result){
          $('#Order').html(result);        


        }
      });

      clearInterval(interval); 
    }, 1000);

  }


}

});


$(document).on('click', '.update_gadget', function(){
  //$('#dataModal').modal();
  var gadget = document.getElementById("gadget").value;
  var OrderID = document.getElementById("OrderID5").value;
  var BranchCode = document.getElementById("Branch").value;
  var dataString = 'OrderID=' + OrderID + '&gadget=' + gadget;
  console.log(OrderID);
  if (gadget == '') {
    swal("error", "Please Select Device", "error");
  }else{
    $.ajax({
     url:"orderUpdate.php",
     method:"POST",
     data:dataString,
     success:function(data){
      swal("success", "Gadget updated successfully", "success");
    }
  });


    if(OrderID){
      let interval = setInterval(function(){
        $.ajax({
         url:"ordersView.php",
         method:"POST",
         data:{OrderID:OrderID},
         success:function(data){
          $('#OrdersData').html(data);
          $('#dataModal').modal('show');
          
        }
      });

        clearInterval(interval); 
      }, 1000);

    }
    if(BranchCode){
      let interval = setInterval(function(){
        $.ajax({
          type:'POST',
          url:'dataget.php',
          data:{'BranchCode':BranchCode},
          success:function(result){
            $('#Order').html(result);        


          }
        });

        clearInterval(interval); 
      }, 1000);

    }


  }

});



$(document).on('click', '.update_gadgetC', function(){
  //$('#dataModal').modal();
  var gadget = document.getElementById("gadgetC").value;
  var ComplaintID = document.getElementById("ComplaintID5").value;
  var BranchCode = document.getElementById("Branch").value;
  var dataString = 'ComplaintID=' + ComplaintID + '&gadget=' + gadget;
  //console.log(OrderID);
  if (gadget == '') {
    swal("error", "Please Select Device", "error");
  }else{
    $.ajax({
     url:"complaintsUpdate.php",
     method:"POST",
     data:dataString,
     success:function(data){
      swal("success", "Gadget updated successfully", "success");
    }
  });


    if(ComplaintID){
      let interval = setInterval(function(){
        $.ajax({
         url:"complaintsView.php",
         method:"POST",
         data:{ComplaintID:ComplaintID},
         success:function(data){
          $('#ComplaintsData').html(data);
          $('#dataModal2').modal('show');
          
        }
      });

        clearInterval(interval); 
      }, 1000);

    }
    if(BranchCode){
      let interval = setInterval(function(){
        $.ajax({
          type:'POST',
          url:'dataget.php',
          data:{'BrCode':BranchCode},
          success:function(result){
            $('#Complaints').html(result);            
          }
        });

        clearInterval(interval); 
      }, 1000);

    }


  }

});



$(document).on('click', '.update_infodate', function(){
  //$('#dataModal').modal();
  var date = document.getElementById("InfoDate").value;
  console.log(date);
  var OrderID = document.getElementById("OID").value;
  var BranchCode = document.getElementById("Branch").value;
  var dataString = 'OrderID=' + OrderID + '&infodate=' + date;
  if (date == '') {
    swal("error", "Please Enter Information Date", "error");
  }else{
    $.ajax({
     url:"orderUpdate.php",
     method:"POST",
     data:dataString,
     success:function(data){
      swal("success", "Information Date : " + date + " updated successfully", "success");
    }
  });


    if(OrderID){
      let interval = setInterval(function(){
        $.ajax({
         url:"ordersView.php",
         method:"POST",
         data:{OrderID:OrderID},
         success:function(data){
          $('#OrdersData').html(data);
          $('#dataModal').modal('show');
          
        }
      });

        clearInterval(interval); 
      }, 1000);

    }
    if(BranchCode){
      let interval = setInterval(function(){
        $.ajax({
          type:'POST',
          url:'dataget.php',
          data:{'BranchCode':BranchCode},
          success:function(result){
            $('#Order').html(result);        


          }
        });

        clearInterval(interval); 
      }, 1000);

    }


  }

});


$(document).on('click', '.update_receivedby', function(){
  //$('#dataModal').modal();
  var received = document.getElementById("Received").value;
  console.log(received);
  var OrderID = document.getElementById("ODID").value;
  var BranchCode = document.getElementById("Branch").value;
  var dataString = 'OrderID=' + OrderID + '&ReceivedBy=' + received;
  if (received == '') {
    swal("error", "Please Enter Received By", "error");
  }else{
    $.ajax({
     url:"orderUpdate.php",
     method:"POST",
     data:dataString,
     success:function(data){
      swal("success", "Received By : " + received + " updated successfully", "success");
    }
  });


    if(OrderID){
      let interval = setInterval(function(){
        $.ajax({
         url:"ordersView.php",
         method:"POST",
         data:{OrderID:OrderID},
         success:function(data){
          $('#OrdersData').html(data);
          $('#dataModal').modal('show');
          
        }
      });

        clearInterval(interval); 
      }, 1000);

    }
    if(BranchCode){
      let interval = setInterval(function(){
        $.ajax({
          type:'POST',
          url:'dataget.php',
          data:{'BranchCode':BranchCode},
          success:function(result){
            $('#Order').html(result);        


          }
        });

        clearInterval(interval); 
      }, 1000);

    }


  }

});


$(document).on('click', '.update_orderby', function(){
  //$('#dataModal').modal();
  var orderby = document.getElementById("orderby").value;
  console.log(orderby);
  var OrderID = document.getElementById("odid").value;
  var BranchCode = document.getElementById("Branch").value;
  var dataString = 'OrderID=' + OrderID + '&OrderBy=' + orderby;
  if (orderby == '') {
    swal("error", "Please Enter order By", "error");
  }else{
    $.ajax({
     url:"orderUpdate.php",
     method:"POST",
     data:dataString,
     success:function(data){
      swal("success", "Order By : " + orderby + " updated successfully", "success");
    }
  });


    if(OrderID){
      let interval = setInterval(function(){
        $.ajax({
         url:"ordersView.php",
         method:"POST",
         data:{OrderID:OrderID},
         success:function(data){
          $('#OrdersData').html(data);
          $('#dataModal').modal('show');
          
        }
      });

        clearInterval(interval); 
      }, 1000);

    }
    if(BranchCode){
      let interval = setInterval(function(){
        $.ajax({
          type:'POST',
          url:'dataget.php',
          data:{'BranchCode':BranchCode},
          success:function(result){
            $('#Order').html(result);        


          }
        });

        clearInterval(interval); 
      }, 1000);

    }


  }

});


$(document).on('click', '.update_discC', function(){
  //$('#dataModal').modal();
  var desc= document.getElementById("discC").value;
  console.log(desc);
  var ComplaintID = document.getElementById("ComplaintID").value;
  var BranchCode = document.getElementById("Branch").value;
  //var dataString = 'ComplaintID=' + ComplaintID + '&discription=' + desc;
  if (desc == '') {
    swal("error", "Please Enter Discription", "error");
  }else{
   var obj = {ComplaintID: ComplaintID, discription: desc}
   const Data = JSON.stringify(obj);
   console.log(Data);
   $.ajax({
     url:"complaintsUpdate.php",
     method:"POST",
     data:{Data:Data},
     success:function(data){
      swal("success", "Discription : " + desc + " updated successfully", "success");

    }
  });



   if(ComplaintID){
    let interval = setInterval(function(){

      $.ajax({
       url:"complaintsView.php",
       method:"POST",
       data:{ComplaintID:ComplaintID},
       success:function(data){
        $('#ComplaintsData').html(data);
        $('#dataModal2').modal('hide');
        $('#dataModal2').modal('show');

      }
    });

      clearInterval(interval); 
    }, 1000);

  }
  if(BranchCode){
    let interval = setInterval(function(){
      $.ajax({
        type:'POST',
        url:'dataget.php',
        data:{'BrCode':BranchCode},
        success:function(result){
          $('#Complaints').html(result);            
        }
      });

      clearInterval(interval); 
    }, 1000);

  }


}

});


$(document).on('click', '.update_infodateC', function(){
  //$('#dataModal').modal();
  var infodate= document.getElementById("InfoDateC").value;
  //console.log(onfodate);
  var ComplaintID = document.getElementById("ComplaintID2").value;
  var BranchCode = document.getElementById("Branch").value;
  var dataString = 'ComplaintID=' + ComplaintID + '&infodate=' + infodate;
  if (infodate == '') {
    swal("error", "Please Enter Date of Information", "error");
  }else{
    $.ajax({
     url:"complaintsUpdate.php",
     method:"POST",
     data:dataString,
     success:function(data){
      swal("success", "Date of Information : " + infodate + " updated successfully", "success");
    }
  });


    if(ComplaintID){
      let interval = setInterval(function(){
        $.ajax({
         url:"complaintsView.php",
         method:"POST",
         data:{ComplaintID:ComplaintID},
         success:function(data){
          $('#ComplaintsData').html(data);
          $('#dataModal2').modal('show');
          
        }
      });

        clearInterval(interval); 
      }, 1000);

    }
    if(BranchCode){
      let interval = setInterval(function(){
        $.ajax({
          type:'POST',
          url:'dataget.php',
          data:{'BrCode':BranchCode},
          success:function(result){
            $('#Complaints').html(result);            
          }
        });

        clearInterval(interval); 
      }, 1000);

    }


  }

});


$(document).on('click', '.update_receivedbyC', function(){
  //$('#dataModal').modal();
  var Received= document.getElementById("ReceivedC").value;
  //console.log(onfodate);
  var ComplaintID = document.getElementById("ComplaintID3").value;
  var BranchCode = document.getElementById("Branch").value;
  var dataString = 'ComplaintID=' + ComplaintID + '&ReceivedBy=' + Received;
  if (Received == '') {
    swal("error", "Please Enter Received By", "error");
  }else{
    $.ajax({
     url:"complaintsUpdate.php",
     method:"POST",
     data:dataString,
     success:function(data){
      swal("success", "Received By : " + Received + " updated successfully", "success");
    }
  });


    if(ComplaintID){
      let interval = setInterval(function(){
        $.ajax({
         url:"complaintsView.php",
         method:"POST",
         data:{ComplaintID:ComplaintID},
         success:function(data){
          $('#ComplaintsData').html(data);
          $('#dataModal2').modal('show');
          
        }
      });

        clearInterval(interval); 
      }, 1000);

    }
    if(BranchCode){
      let interval = setInterval(function(){
        $.ajax({
          type:'POST',
          url:'dataget.php',
          data:{'BrCode':BranchCode},
          success:function(result){
            $('#Complaints').html(result);            
          }
        });

        clearInterval(interval); 
      }, 1000);

    }


  }

});



$(document).on('click', '.update_madebyC', function(){
  //$('#dataModal').modal();
  var madeby= document.getElementById("madebyC").value;
  //console.log(onfodate);
  var ComplaintID = document.getElementById("ComplaintID4").value;
  var BranchCode = document.getElementById("Branch").value;
  var dataString = 'ComplaintID=' + ComplaintID + '&MadeBy=' + madeby;
  if (madeby == '') {
    swal("error", "Please Enter Made By", "error");
  }else{
    $.ajax({
     url:"complaintsUpdate.php",
     method:"POST",
     data:dataString,
     success:function(data){
      swal("success", "Received By : " + madeby + " updated successfully", "success");
    }
  });


    if(ComplaintID){
      let interval = setInterval(function(){
        $.ajax({
         url:"complaintsView.php",
         method:"POST",
         data:{ComplaintID:ComplaintID},
         success:function(data){
          $('#ComplaintsData').html(data);
          $('#dataModal2').modal('show');
          
        }
      });

        clearInterval(interval); 
      }, 1000);

    }
    if(BranchCode){
      let interval = setInterval(function(){
        $.ajax({
          type:'POST',
          url:'dataget.php',
          data:{'BrCode':BranchCode},
          success:function(result){
            $('#Complaints').html(result);            
          }
        });

        clearInterval(interval); 
      }, 1000);

    }


  }

});


 $(document).on('click','.exp', function(){
  var BCode = $(this).attr("bcc");
  var OID = $(this).attr("oid");
  var ExDate = $(this).attr("expdate");
  console.log(ExDate);
  document.getElementById("expbrcd").value=BCode;
  document.getElementById("expeDate").value=ExDate;
  document.getElementById("expOID").value=OID;
});


 $(document).on('click','.expC', function(){
  var BCode = $(this).attr("bccC");
  var CID = $(this).attr("cid");
  var ExDate = $(this).attr("expdateC");
  console.log(ExDate);
  document.getElementById("expbrcdC").value=BCode;
  document.getElementById("expeDateC").value=ExDate;
  document.getElementById("expCID").value=CID;
});


$(document).on('click', '.update_ExpectedDateC', function(){
  //$('#dataModal').modal();
  var ExpDate = document.getElementById("expeDateC").value;
  //console.log(disc);
  var ComplaintID = document.getElementById("expCID").value;
  var BranchCode = document.getElementById("Branch").value;

  const obj = {ComplaintID: ComplaintID, ExpectedDate: ExpDate};
  const Data = JSON.stringify(obj);
  console.log(Data);
 // var dataString = 'OrderID=' + OrderID + '&discription=' + disc;
 if (ExpDate == '') {
  swal("error", "Please Enter Expected Date", "error");
}else{
  $.ajax({
   url:"complaintsUpdate.php",
   method:"POST",
   data:{Data2:Data},
   success:function(data){
    //alert("Discription: " + disc + " updated successfully");
    swal("success", "Expected Date: " + ExpDate + " updated successfully", "success");
  }
});


  if(ComplaintID){
    let interval = setInterval(function(){
      $.ajax({
       url:"complaintsView.php",
       method:"POST",
       data:{ComplaintID:ComplaintID},
       success:function(data){
        $('#ComplaintsData').html(data);
        $('#dataModal2').modal('show');

      }
    });

      clearInterval(interval); 
    }, 1000);

  }
  if(BranchCode){
    let interval = setInterval(function(){
      $.ajax({
        type:'POST',
        url:'dataget.php',
        data:{'BranchCode':BranchCode},
        success:function(result){
          $('#Complaints').html(result);        


        }
      });

      clearInterval(interval); 
    }, 1000);

  }


}

});



$(document).on('click', '.update_ExpectedDate', function(){
  //$('#dataModal').modal();
  var ExpDate = document.getElementById("expeDate").value;
  //console.log(disc);
  var OrderID = document.getElementById("expOID").value;
  var BranchCode = document.getElementById("Branch").value;

  const obj = {OrderID: OrderID, ExpectedDate: ExpDate};
  const Data = JSON.stringify(obj);
  console.log(Data);
 // var dataString = 'OrderID=' + OrderID + '&discription=' + disc;
 if (ExpDate == '') {
  swal("error", "Please Enter Expected Date", "error");
}else{
  $.ajax({
   url:"orderUpdate.php",
   method:"POST",
   data:{Data2:Data},
   success:function(data){
    //alert("Discription: " + disc + " updated successfully");
    swal("success", "Expected Date: " + ExpDate + " updated successfully", "success");
  }
});


  if(OrderID){
    let interval = setInterval(function(){
      $.ajax({
       url:"ordersView.php",
       method:"POST",
       data:{OrderID:OrderID},
       success:function(data){
        $('#OrdersData').html(data);
        $('#dataModal').modal('show');

      }
    });

      clearInterval(interval); 
    }, 1000);

  }
  if(BranchCode){
    let interval = setInterval(function(){
      $.ajax({
        type:'POST',
        url:'dataget.php',
        data:{'BranchCode':BranchCode},
        success:function(result){
          $('#Order').html(result);        


        }
      });

      clearInterval(interval); 
    }, 1000);

  }


}

});