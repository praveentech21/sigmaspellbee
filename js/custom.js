/* Add here all your JS customizations */

  var source = new EventSource("login_alert.php");
  source.onmessage = function(event) {
	  if(event.data != "0")
	  {
		new PNotify({
			title: 'New Login!',
			text: event.data,
            addclass: 'red notification-primary',
			icon: 'fab fa-twitter',
			delay:1000
		   });
	  }
   }	  
