//Bootstrap' alert auto close in 2s
window.setTimeout(function() {
    $(".error").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 2000);