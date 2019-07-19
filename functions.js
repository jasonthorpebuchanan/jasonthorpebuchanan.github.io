var captionLength = 0;
var caption = '';


$(document).ready(function() {
    setInterval ('cursorAnimation()', 100);
    captionEl = $('#caption');
    
    $('#test-typing').click(function(){
        testTypingEffect();
    });

    $('#test-erasing').click(function(){
        testErasingEffect();
    });
});

function testTypingEffect() {
    caption = $('input#user-caption').val();
    type();
}

function type() {
    captionEl.html(caption.substr(0, captionLength++));
    if(captionLength < caption.length+1) {
        setTimeout('type()', 1);
    } else {
        captionLength = 0;
        caption = '';
    }
}

function testErasingEffect() {
    caption = captionEl.html();
    captionLength = caption.length;
    if (captionLength>0) {
        erase();
    } else {
        $('#caption').html("You didn't write anything to erase, but that's ok!");
        setTimeout('testErasingEffect()', 200);
    }
}

function erase() {
    captionEl.html(caption.substr(0, captionLength--));
    if(captionLength >= 0) {
        setTimeout('erase()', 20);
    } else {
        captionLength = 0;
        caption = '';
    } 
}

function cursorAnimation() {
    $('#cursor').animate({
        opacity: 0
    }, 'fast', 'swing').animate({
        opacity: 1
    }, 'fast', 'swing');
}