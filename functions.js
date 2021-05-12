document.getElementById("test-typing").click();

var str = "<p>panic<span style='color:red;'>panic</span> panic panic !</p>",
    i = 0,
    isTag,
    text;

(function type() {
    text = str.slice(0, ++i);
    if (text === str) return;

    document.getElementById('typewriter').innerHTML = text;

    var char = text.slice(-1);
    if( char === '<' ) isTag = true;
    if( char === '>' ) isTag = false;

    if (isTag) return type();
    setTimeout(type

var blacktime = 1400;
var whitetime = 1000;
//These can be as long as you desire in milliseconds
setTimeout(whiteFunc,blacktime);
function whiteFunc(){
    document.getElementById("blink").style.color = "white";
    setTimeout(blackFunc,whitetime);
}
function blackFunc(){
    document.getElementById("blink").style.color = "black";
    setTimeout(whiteFunc,blacktime);

}

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
        setTimeout('testErasingEffect()', 180);
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
