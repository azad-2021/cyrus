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
var dataString = 'branch=' + BranchCode + '&device=' + Device + '&type=' + Type + '&receivedby=' + ReceivedBy + '&madeby=' + MadeBy + '&infodate=' + InfoDate + '&expected=' + Expected + '&discription=' + Discription;
if (BranchCode == '') {
  alert("Please Select Branch");
} else if(Device == '' || Type == '' || ReceivedBy == '' || MadeBy == '' || InfoDate == '' || Expected == '' || Discription == ''){
  alert("Please enter all fields");
} else{
  document.getElementById("form").reset();
  $.ajax({
    type: "POST",
    url: "post.php",
    data: dataString,
    cache: false,
    success: function(html) {
      alert("Your " + Type + " registered successfully");
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
  //var Mobile = document.getElementById("Mobile").value;
  //var Email = document.getElementById("Email").value;
  //var GST = document.getElementById("GST").value;
// Returns successful data submission message when the entered information is stored in database.
var dataString = 'branch=' + BranchCode + '&phone=' + Phone;
if (Phone == '') {
  alert("Please Enter Phone Number");
}else{
  document.getElementById("form3").reset();
  $.ajax({
    type: "POST",
    url: "update.php",
    data: dataString,
    cache: false,
    success: function(html) {
      alert("Phone Number: " + Phone + " updated successfully");
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
  //var Mobile = document.getElementById("Mobile").value;
  //var Email = document.getElementById("Email").value;
  //var GST = document.getElementById("GST").value;
// Returns successful data submission message when the entered information is stored in database.
var dataString = 'branch=' + BranchCode + '&mobile=' + Mobile;
if (Mobile == '') {
  alert("Please Enter Mobile Number");
}else{
  document.getElementById("form3").reset();
  $.ajax({
    type: "POST",
    url: "update.php",
    data: dataString,
    cache: false,
    success: function(html) {
      alert("Mobile Number: " + Mobile + " updated successfully");
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
  alert("Please Enter Email");
}else{
  document.getElementById("form4").reset();
  $.ajax({
    type: "POST",
    url: "update.php",
    data: dataString,
    cache: false,
    success: function(html) {
      alert("Email: " + Email + " updated successfully");
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
  //var Mobile = document.getElementById("Mobile").value;
  //var Email = document.getElementById("Email").value;
  //var GST = document.getElementById("GST").value;
// Returns successful data submission message when the entered information is stored in database.
var dataString = 'branch=' + BranchCode + '&gst=' + GST;
if (GST == '') {
  alert("Please Enter GST Number");
}else{
  document.getElementById("form5").reset();
  $.ajax({
    type: "POST",
    url: "update.php",
    data: dataString,
    cache: false,
    success: function(html) {
      alert("GST Number: " + GST + " updated successfully");
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
  alert("Please Enter Branch Code Number");
}else{
  document.getElementById("form5").reset();
  $.ajax({
    type: "POST",
    url: "update.php",
    data: dataString,
    cache: false,
    success: function(html) {
      alert("Branch Code : " + Branch_code + " updated successfully");
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
    alert("Please Select Search Type");
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
  var OrderID = document.getElementById("OrderID1").value;
  var BranchCode = document.getElementById("brc").value;
  var dataString = 'OrderID=' + OrderID + '&discription=' + disc;
  if (disc == '') {
    alert("Please Enter Discription");
  }else{
    $.ajax({
     url:"orderUpdate.php",
     method:"POST",
     data:dataString,
     success:function(data){
      alert("Discription: " + disc + " updated successfully");
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
  var BranchCode = document.getElementById("BranchCode5").value;
  var dataString = 'OrderID=' + OrderID + '&gadget=' + gadget;
  console.log(OrderID);
  if (gadget == '') {
    alert("Please Select Device");
  }else{
    $.ajax({
     url:"orderUpdate.php",
     method:"POST",
     data:dataString,
     success:function(data){
      alert("Gadget updated successfully");
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
  var BranchCode = document.getElementById("BranchCodeC5").value;
  var dataString = 'ComplaintID=' + ComplaintID + '&gadget=' + gadget;
  //console.log(OrderID);
  if (gadget == '') {
    alert("Please Select Device");
  }else{
    $.ajax({
     url:"complaintsUpdate.php",
     method:"POST",
     data:dataString,
     success:function(data){
      alert("Gadget updated successfully");
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
  var BranchCode = document.getElementById("brcd").value;
  var dataString = 'OrderID=' + OrderID + '&infodate=' + date;
  if (date == '') {
    alert("Please Enter Information Date");
  }else{
    $.ajax({
     url:"orderUpdate.php",
     method:"POST",
     data:dataString,
     success:function(data){
      alert("Information Date : " + date + " updated successfully");
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
  var BranchCode = document.getElementById("BRCD").value;
  var dataString = 'OrderID=' + OrderID + '&ReceivedBy=' + received;
  if (received == '') {
    alert("Please Enter Received By");
  }else{
    $.ajax({
     url:"orderUpdate.php",
     method:"POST",
     data:dataString,
     success:function(data){
      alert("Received By : " + received + " updated successfully");
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
  var BranchCode = document.getElementById("Brcd").value;
  var dataString = 'OrderID=' + OrderID + '&OrderBy=' + orderby;
  if (orderby == '') {
    alert("Please Enter order By");
  }else{
    $.ajax({
     url:"orderUpdate.php",
     method:"POST",
     data:dataString,
     success:function(data){
      alert("Order By : " + orderby + " updated successfully");
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
  var BranchCode = document.getElementById("BranchCodeC").value;
  var dataString = 'ComplaintID=' + ComplaintID + '&discription=' + desc;
  if (desc == '') {
    alert("Please Enter Discription");
  }else{
    $.ajax({
     url:"complaintsUpdate.php",
     method:"POST",
     data:dataString,
     success:function(data){
      alert("Discription : " + desc + " updated successfully");
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


$(document).on('click', '.update_infodateC', function(){
  //$('#dataModal').modal();
  var infodate= document.getElementById("InfoDateC").value;
  //console.log(onfodate);
  var ComplaintID = document.getElementById("ComplaintID2").value;
  var BranchCode = document.getElementById("BranchCodeC2").value;
  var dataString = 'ComplaintID=' + ComplaintID + '&infodate=' + infodate;
  if (infodate == '') {
    alert("Please Enter Date of Information");
  }else{
    $.ajax({
     url:"complaintsUpdate.php",
     method:"POST",
     data:dataString,
     success:function(data){
      alert("Date of Information : " + infodate + " updated successfully");
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
  var BranchCode = document.getElementById("BranchCodeC3").value;
  var dataString = 'ComplaintID=' + ComplaintID + '&ReceivedBy=' + Received;
  if (Received == '') {
    alert("Please Enter Received By");
  }else{
    $.ajax({
     url:"complaintsUpdate.php",
     method:"POST",
     data:dataString,
     success:function(data){
      alert("Received By : " + Received + " updated successfully");
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
  var BranchCode = document.getElementById("BranchCodeC4").value;
  var dataString = 'ComplaintID=' + ComplaintID + '&MadeBy=' + madeby;
  if (madeby == '') {
    alert("Please Enter Made By");
  }else{
    $.ajax({
     url:"complaintsUpdate.php",
     method:"POST",
     data:dataString,
     success:function(data){
      alert("Received By : " + madeby + " updated successfully");
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

