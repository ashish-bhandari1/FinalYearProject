
//for dashboard menu
var date = document.getElementById("date");
var topnav = document.getElementById("welcomeAdmin");
var error = document.getElementById('ermsg');



function realtime(){
    var refresh = 1;// Refresh rate in milli seconds
    mytime=setTimeout('printdate()',refresh)
}

function printdate(){
    var today = new Date(); 
    var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
    var time = today.getHours()+':'+today.getMinutes() +':'+today.getSeconds();
    topnav.innerHTML='Time: '+time +'        Date: '+date; 

    realtime(); 
}

function greeting(){
    var today = new Date(); 

    var x = today.getHours();
    var greet;
    if(x<12 && x>3){
        greet  = "Good Morning Admin!"
    }
    else if(x<17 && x>=12){ greet = "Good Afternoon Admin!"
    console.log(x);
    }
    else if(x<20 && x>=16){ greet = "Good Evening Admin!"
    console.log(x);
    }
    
    else{ 
        greet = "Wish you sweet night Admin!";
        console.log(x);

    }

    date.innerHTML = greet;
}
greeting();



    // function for opening and closing add  form 
  
    
function addForm(){
    var form = document.getElementById("formWrap");

    var formCls = form.className;
    
    if(formCls === "UploadFrom")
    {
        form.classList.add('FormShow');

    }
    else{
        form.className = "UploadFrom";
    }
    
}


function closeFrom(){
    var formAdd = document.getElementById("formWrap");
    var formEdit = document.getElementById("formEdit");
    
    formAdd.className = "UploadFrom";
    formEdit.className = "UploadFrom";
}


window.addEventListener("dblclick", function(event) {
    var formAdd = document.getElementById("formWrap");
    var formEdit = document.getElementById("formEdit");

    if (event.target == formAdd || event.target == formEdit) {
         formAdd.className = "UploadFrom";
         formEdit.className = "UploadFrom";
    }
});




    // function for opening and closing add  form 
  
    
    function editForm(){
        var form = document.getElementById("formEdit");
    
        var formCls = form.className;
        
        if(formCls === "UploadFrom")
        {
            form.classList.add('FormShow');
        }
        else{
            form.className = "UploadFrom";
        }
        
    }
    
 
    //seat selection function
    function selectSeat( seatId){
        var seat = document.getElementById(seatId);
        var input = document.getElementById("seat_id");
        var count = document.getElementById("count");
       
        var inputValue = input.value;
        var countValue = count.textContent;


        //checking class name of seats
        if(seat.classList != "seat-btn color Booked"){
            var limit = parseInt(countValue) + 1;
            count.innerHTML = limit;
    
            //avoiding more than 5 bookings
            if(limit <=5 ){
                seat.style.backgroundColor = "#1aeb1a";
                
                if(inputValue == 0){
                    input.value = seatId;
                }
                else{
                    input.value = inputValue + "," + seatId;
                }
            }
            else{
                alert("Booking Limit Exeed!");
            }
        }else{
            alert("Sorry, Can't select Booked seat");
        }

    }
    
    
    function errorfunction(){
        error.style.display = "none";    
    }
    
  
    function seatError(id){
        var getid, seat, seatvalue, screenBtn;
        //screening seat number validaing
        getid = document.getElementById(id);
        seat = document.getElementById('seats').value;
        screenBtn = document.getElementById('screeningBtn');
        // document.write("hello");
        if(id == "error" && seat>500){
            getid.innerHTML = "<br> * Having seat number more than 500 is unappropiate please contact your servce provider";
            screenBtn.disabled = true;
            screenBtn.style.cursor = 'not-allowed';
            screenBtn.style.backgroundColor = 'rgba(255, 0, 0, 0.432)';
        }
        
        if(id == "error" && seat <= 500){
            getid.innerHTML = "";
            screenBtn.disabled = false;
            screenBtn.style.cursor = 'pointer';
            screenBtn.style.backgroundColor = 'rgb(13, 129, 182)';
        }


    }

    function seat_updateError(id){
        var getid, seat, btn;
        //screening seat number validaing
        getid = document.getElementById(id);
        btn = document.getElementById('screeningBtn');
        // document.write("hello");

           var column = document.getElementById('column_num').value;
            var row = document.getElementById('row_num').value;
            $calc = (row * column);

            if($calc > 500){
                getid.innerHTML = "<br> * Having seat number more than 500 is unappropiate please contact your servce provider";
                btn.disabled = true;
                btn.style.cursor = 'not-allowed';  
                btn.style.backgroundColor = 'rgba(255, 0, 0, 0.432)';
            }
            else{
                getid.innerHTML = "";
                btn.disabled = false;
                btn.style.cursor = 'pointer';
                btn.style.backgroundColor = 'rgb(13, 129, 182)';
            }
    }

    function password_valid(){
        var  pw, repw, btn;
        pw = document.getElementById('new_pw').value;
        repw = document.getElementById('renew_pw').value;
        btn = document.getElementById('passwordBtn');
        msg = document.getElementById('error');
        
        if(pw != repw){
            msg.innerHTML = "<br> * Password does not match";
            btn.disabled = true;
            btn.style.cursor = 'not-allowed';  
            btn.style.backgroundColor = 'rgba(255, 0, 0, 0.432)';
                }
        else{
            msg.innerHTML = "";
            btn.disabled = false;
            btn.style.cursor = 'pointer';
            btn.style.backgroundColor = 'rgb(13, 129, 182)';
      
        }

    }
    
    
