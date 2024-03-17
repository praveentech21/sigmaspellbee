	
var i = 0;
function timer() {
  if (i == 0) {
    i = 1;
    var elem = document.getElementById("myBar");
    var width = 1;
    var id = setInterval(frame, 120	);
    function frame() {
      if (width >= 100) {
        clearInterval(id);
        i = 0;
      } else {
        width++;
        elem.style.width = width + "%";
      }
    }
  }
}
	
	<!-- SSE CODE -->
			
        var source = new EventSource("load_new.php");
        source.onmessage = function(event) {
		var labl;
		
  		   if(event.data == "GP")
		    {
			 labl = "<span style=''><br>GAME<br>PAUSED</span>";   
		    }
		   else if(event.data == "GO")
		    {
			 labl = "<span style='font-size:14px;'>GAME OVER</span>";   
		    }
		   else if(event.data == "GR" || event.data == "GR2")
		    {
			 labl = "<h6>GAME<br>READY</h6>";   
			 if(event.data == "GR2")
			   {
				 $('#overlay2').modal('show');
			   }	 
		    }
		   else
		   {
			 timer();     
			 document.getElementById('f1').innerHTML = event.data;
			 document.getElementById('f2').innerHTML = event.data;
			 document.getElementById('f3').innerHTML = event.data;
			 document.getElementById('f4').innerHTML = event.data;
			 document.getElementById('f5').innerHTML = event.data;

             var er="c" + event.data;			 
			 //document.getElementById(er).innerHTML = "<div id='ticked'><i class='fa fa-check'></i>" + event.data + "</div>";
	         if(sound == "on")
			 {
         	  var audio = new Audio("sounds/" + event.data + ".mp3");
              audio.play();
			 }
		   }
		   };

	   var source = new EventSource("load_recent.php");
        source.onmessage = function(event) {
           document.getElementById('recent').innerHTML = event.data;
        };

        var source = new EventSource("load_claims.php");
        source.onmessage = function(event) {
		   var dat = event.data;
		   var res=dat.split("|");	
	       var i,x;
		   for(i=0;i<res.length;i++)
			 {
          	   x=res[i];
               if(x == "J5") {var y = document.getElementById("J5"); y.disabled=true; y.classList.remove('bg-green'); y.classList.add('bg-black');}
               if(x == "L1") {var y = document.getElementById("L1"); y.disabled=true; y.classList.remove('bg-green'); y.classList.add('bg-black');}
               if(x == "L2") {var y = document.getElementById("L2"); y.disabled=true; y.classList.remove('bg-green'); y.classList.add('bg-black');}
               if(x == "L3") {var y = document.getElementById("L3"); y.disabled=true; y.classList.remove('bg-green'); y.classList.add('bg-black');}
               if(x == "FH") {var y = document.getElementById("FH"); y.disabled=true; y.classList.remove('bg-green'); y.classList.add('bg-black');}
             }   
		};
