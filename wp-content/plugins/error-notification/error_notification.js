jQuery(document).ready(function(){
	
	var ppID = jQuery('#error-notification-id').attr('class');
	if( ppID ) {
		 /* Thank You text - you can see it when you sent a notification */
		var thankYouText = jQuery('#error-notification-settings p').text();
		/* Background of notification DIV */
		var backgroundStyle = enp.barBackground;
		/* Notification Bar Position */
		var barPosition = enp.barPosition;
		/* Text color of notification DIV */
		var textStyle = enp.barTextColor;
		/* Keys container */
		var keys = {};

	
		/* When visitor/user presses keys combination - Shift + Enter to report an error */
		 jQuery(document).keydown(function (e) {
			keys[e.which] = true;
			if(keys[16] && keys[13]) {
				sendError(backgroundStyle, barPosition, textStyle, thankYouText);    
				for (var i in keys) {
				  var item = keys[i];
					keys[i] = false;
				}
			}
		});
	
		jQuery(document).keyup(function (e) {
			delete keys[e.which];
		});
	
		/* When visitor/user clicks on a link to report an error */
		jQuery('a.enp-report').live('click', function(event) {
			event.preventDefault();
			sendError(backgroundStyle, barPosition, textStyle, thankYouText);
		});
	}
	
});

/* Send an email to the administrator */
function sendError(bgColor, barPosition, textColor, thxText) {
	if(getSelectedText() != "") {
		
		/* get current post/page id */
		var ppID = jQuery('#error-notification-id').attr('class');
		
		/* data */
		data = { 
			action: 'error_notification_email',
			pageName: jQuery.trim(jQuery('title').text()),
			pageError: getSelectedText(), 
			pageUrl: window.location.href,
			postPageID: ppID
		};
		
		/* check if user wants to have confirmation box */
		if(enp.confirmation == 1) {
			var confirmationBox = {'display': 'none', 'padding': '20px', 'width': '400px', 'background': 'black', 'position':'fixed', 'top': '50%', 'margin-top': '-100px', 'left': '50%', 'margin-left': '-150px', 'z-index' : '9999'};
			jQuery('body').append('<div id="notification-error-confirmation"><h4 style="text-align: center; padding:10px; background: '+bgColor+'; color: '+textColor+';">Are you sure?</h4><p style="color: #eee; padding: 10px"><span style="color:#888;"><strong>Error:</strong></span> '+getSelectedText()+'</p><p style="text-align: center; margin-top: 20px;"><a style="display: inline-block; width: 100px; padding: 10px; background: #89BA2E; text-align: center; text-decoration: none; color: #f4f4f4;" id="notification-error-cb-yes" href="#">OK</a><a style="display: inline-block; width: 100px; padding: 10px; background: #CC433E; text-align: center; text-decoration: none; color: #f4f4f4;" id="notification-error-cb-no" href="#">Cancel</a></p></div>');
			
			/* show confirmation box */
			jQuery('#notification-error-confirmation').css(confirmationBox).fadeIn();
			
			/* user clicked ok */
			jQuery('#notification-error-confirmation #notification-error-cb-yes').click(function(e) {
				e.preventDefault();
				jQuery('#notification-error-confirmation').remove();
				
				jQuery.post(enp.ajaxurl, data, function(response) {
					if(!response) {
						thxText = 'Sorry something went wrong. Please try again.';
					}
				});
		
				if(barPosition === 'top') {
					var notificationContainer = {'width':'100%', 'display': 'none', 'background': bgColor, 'color': textColor, 'position':'fixed', 'top':'0', 'left':'0', 'text-align': 'center', 'z-index' : '9999'};
				} else {
					var notificationContainer = {'width':'100%', 'display': 'none', 'background': bgColor, 'color': textColor, 'position':'fixed', 'bottom':'0', 'left':'0', 'text-align': 'center', 'z-index' : '9999'};
				}
				
				/* Add bar container to document */
				jQuery('body').append('<div id="notification-error-plugin" class="error-notification"><p style="margin:0; padding: 10px;">'+thxText+'</p></div>');
				
				jQuery('#notification-error-plugin').css(notificationContainer);
				jQuery('#notification-error-plugin').fadeIn(1000).delay(2500).fadeOut(500);
				});
			
			/* user clicked cancel */
			jQuery('#notification-error-confirmation #notification-error-cb-no').click(function(e) {
				e.preventDefault();
				jQuery('#notification-error-confirmation').remove();
			});
			
		} else {
			jQuery.post(enp.ajaxurl, data, function(response) {
				if(!response) {
					thxText = 'Sorry something went wrong. Please try again.';
				}
			});
		
			if(barPosition === 'top') {
				var notificationContainer = {'width':'100%', 'display': 'none', 'background': bgColor, 'color': textColor, 'position':'fixed', 'top':'0', 'left':'0', 'text-align': 'center', 'z-index' : '9999'};
			} else {
				var notificationContainer = {'width':'100%', 'display': 'none', 'background': bgColor, 'color': textColor, 'position':'fixed', 'bottom':'0', 'left':'0', 'text-align': 'center', 'z-index' : '9999'};
			}
			
			/* Add bar container to document */
			jQuery('body').append('<div id="notification-error-plugin" class="error-notification"><p style="margin:0; padding: 10px;">'+thxText+'</p></div>');
			
			jQuery('#notification-error-plugin').css(notificationContainer);
			jQuery('#notification-error-plugin').fadeIn(1000).delay(2500).fadeOut(500);
		}

	} else {
		alert("Please find an error and highlight it.");
	}
}

/* Get selected text */
function getSelectedText() { 
	if (window.getSelection) { 
		return window.getSelection().toString(); 
	} else if (document.getSelection) { 
		return document.getSelection(); 
	} else if (document.selection) { 
		return document.selection.createRange().text; 
	} 
} 