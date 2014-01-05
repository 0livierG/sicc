
$(document).ready(function() {


    $('#coin-slider').coinslider({
        width: 1170,
        height: 450,
        navigation: true, 
        delay: 2000
    });

    $( "a .top-box-accueil-img" )
        .mouseenter(function() {
            $( this ).animate({ "left": "0.25" }, "slow" );
        })
        .mouseleave(function() {
            $( this ).animate({ "opacity": "1" }, "slow" );
        });
});
