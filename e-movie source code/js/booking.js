 
    //seat selection function
    function selectSeat( seatId){
        var seat = document.getElementById(seatId);
        var input = document.getElementById("seat_id");
        var count = document.getElementById("count");
        var amount  = document.getElementById("total-cost");
        var inputValue = input.value;
        var countValue = count.value;


        //checking class name of seats
        if(seat.classList == "seat-btn color Normal" ){
            var limit = parseInt(countValue) + 1;
            if(limit <= 5){
                count.value = limit;
            }    
            //avoiding more than 5 bookings
            if(limit <=5 ){
                seat.className  = "seat-btn color selected";
                if(inputValue == 0){
                    input.value = seatId;
                }
                else{
                    input.value = inputValue + "," + seatId;
                }
                amount.textContent = (limit * 250 );
            }
            else{
                alert("Booking Limit Exeed!");
            }
        }


        else if(seat.classList == "seat-btn color selected"){
            var string, newString,remove;
            var limit = countValue;  
       
            //avoiding more than 5 bookings
            if(limit <=5 ){            
                seat.className  = "seat-btn color Normal";
                
                if(limit == 1){         
                     string = input.value;
                     remove = seatId;
                     newString = string.replace(remove, '');
                     input.value = newString;
                     limit = parseInt(countValue) - 1;
                     count.value = limit;
                }
                else{
                    limit = parseInt(countValue) - 1;
                    count.value = limit;
                    string = input.value;
                    remove = ',' + seatId;
                    newString = string.replace(remove, '');
                    input.value = newString;
                }

                amount.textContent = 'Rs: '+(limit * 250 );
            }
            else{
                alert("Booking Limit Exeed!");
            }
        
        }


        else if(seat.classList == "seat-btn color Reserved"){
            alert("Sorry this seat is reserved! Try other");
        }

        else{
            alert("Sorry, Can't select Booked seat");
        }

    }


    function bookclick(){
        var btn = document.getElementById('bookbtn');
        var input = document.getElementById("seat_id").value;

        if( input == ""){
            alert("Please Select Seat First");
        }

    }
    
