/*
 * If a theme need a menu function
 * just insert it into default.js file
 * rather than copy whole file
 */

$(window).on("load resize", function(){

    // Show on click
	//SJ.Dropdown.init();

	// Show on hover not after click
	SJ.Dropdown.init({type:'hover'});
    
    $('.nav').animate({'opacity': 1}, 1000);

	// Show on hover with spans - arrows
    //	SJ.Dropdown.init({type:'hover',arrows:true});

	// Do not show 'More' menu
	//SJ.Dropdown.init({more:false});

	// Change title of 'More' menu
	//SJ.Dropdown.init({more:'All about us'});

	// Defaults to .dropdown, ul is prepended automaticaly
	//SJ.Dropdown.init({selector:'.dropdown2'});

});

