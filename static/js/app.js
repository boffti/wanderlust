var typed = new Typed('#welcome-string', {
    stringsElement: '#typed',
    showCursor: false,
    cursorChar: '|',
    typeSpeed: 70,
    backSpeed: 70,
    backDelay: 5000,
    loop: true,
    loopCount: Infinity,
    shuffle: true,
});

// When the user scrolls the page, execute myFunction
window.onscroll = function () {
    myFunction()
};

// Get the navbar
var navbar = document.getElementById("navbar");

// Get the offset position of the navbar
var sticky = navbar.offsetTop;

// Add the sticky class to the navbar when you reach its scroll position. Remove "sticky" when you leave the scroll position
function myFunction() {
    if (window.pageYOffset >= sticky) {
        navbar.classList.add("sticky")
    } else {
        navbar.classList.remove("sticky");
    }
}

$.noConflict();
jQuery(document).ready(function ($) {

    let firstName = faker.name.firstName();
    let lastName = faker.name.lastName();

    let cityName = faker.address.city();
    let stateAbbr = faker.address.stateAbbr();

    $(".profileName").text(`${firstName} ${lastName}`);
    $(".currentLocation").html(`<i class="fas fa-map-marker-alt loc-icon"></i> ${cityName}, ${stateAbbr}`)

    $.ajax({
        url: 'https://randomuser.me/api/',
        dataType: 'json',
        success: function (data) {
            var avatarURL = data.results[0].picture.thumbnail;
            console.log(avatarURL)
            $(".avatarIMG").attr('src', avatarURL);
        }
    });

    $("#btnSearchNow").on('click', function() {

    });
});