/*
  This is a great way to quickly test things out!

  Add all your JavaScript here.
  Open the `index.html` file in Chrome, save changes here,
  and simply refresh Chrome to see those changes.
*/

console.log('Loaded, bro.')

$( document ).ready(function() {
    
	$('.top-menu-item-mobile').click(function(){
		$('.top-menu-item').toggleClass('visible');
		$('.top-menu-item-mobile').toggleClass('open');
		$('.top-menu-item-mobile.desc').toggle();
	})


});