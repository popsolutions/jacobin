jQuery(document).ready(function($){
	$('#login-toggle').on('click', openLoginBar);
	$('#close-login').on('click', openLoginBar);
	var body = $('body');
	function openLoginBar(){
        if( body.hasClass('display-login') ) {
            body.removeClass('display-login');
            // make login input inaccessible to keyboards
            //siteHeader.find('.login-field').attr('tabindex', -1);

            // allow scrolling again
            body.css('overflow', 'auto');
        } else {
            body.addClass('display-login');
            // make login input keyboard accessible
            //siteHeader.find('.login-field').attr('tabindex', 0);
            // put cursor into the login input (delay 0.25 b/c of CSS transition)
            setTimeout( function() {
                $('#login-form-popup').find('#login-field').focus();
            }, 250);

            // prevent background scrolling
            body.css('overflow', 'hidden');
        }
    }
    /*
    function closeLoginBar(){
            body.removeClass('display-login');
            // make login input keyboard accessible
            siteHeader.find('.login-field').attr('tabindex', 0);
            // put cursor into the login input (delay 0.25 b/c of CSS transition)
            setTimeout( function() {
                $('#login-form-popup').find('#login-field').blur();
            }, 250);

            // prevent background scrolling
            body.css('overflow', 'hidden');
    }
    */
});