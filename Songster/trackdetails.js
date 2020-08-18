document.getElementById("play").onclick = function() {
    document.getElementById('demo').play();
}

document.getElementById("pause").onclick = function() {
    document.getElementById('demo').pause();
}

$(document).on('click', '.navbar li', function() {
    $(".navbar li").removeClass("active");
    $(this).addClass("active");
});