/* Author : Melkot, Aaneesh Naagaraj
ID : 1001750503 */
$.noConflict();
jQuery(function ($) {

    // Sticky Navbar
    /*     window.onscroll = function () {
            stickNav()
        };
        var navbar = document.getElementById("navbar");
        var sticky = navbar.offsetTop;

        function stickNav() {
            if (window.pageYOffset >= sticky) {
                navbar.classList.add("sticky")
            } else {
                navbar.classList.remove("sticky");
            }
        } */

    // Fake Placeholder names and Images
    let firstName = faker.name.firstName();
    let lastName = faker.name.lastName();

    let cityName = faker.address.city();
    let stateAbbr = faker.address.stateAbbr();

    $(".profileName").text(`${firstName} ${lastName}`);
    $(".currentLocation").html(`<i class="fas fa-map-marker-alt loc-icon"></i> ${cityName}, ${stateAbbr}`)
    $(".business-name").text(`${faker.company.companyName()}`);
    $(".business-category").text(`${faker.company.catchPhrase()}`);
    $(".profileAddress").text(`${faker.address.streetAddress()}, ${faker.address.city()}, ${faker.address.stateAbbr()}, ${faker.address.zipCode().slice(0,5)}`);

    $.ajax({
        url: '/getPageData',
        dataType: 'json',
        success: function (data) {
            var avatarURL = data.results[0].picture.thumbnail;
            var profileIMGURL = data.results[0].picture.large;
            $(".avatarIMG").attr('src', avatarURL);
            $(".profileIMG").attr('src', profileIMGURL);
        }
    });

    // Fake Post Names
    $('.post .profileName').each(function () {
        $(this).text(`${faker.name.firstName()} ${faker.name.lastName()}`);
    });

    $('.post .post-content').each(function () {
        $(this).text(`${faker.lorem.sentences()}`);
    });

    $('.tips .tip-author').each(function () {
        $(this).text(`${faker.name.firstName()} ${faker.name.lastName()}`);
    });

    $('.post .postIMG').each(function () {
        var $img = $(this);
        $.ajax({
            url: 'https://randomuser.me/api/',
            dataType: 'json',
            success: function (data) {
                var avatarURL = data.results[0].picture.thumbnail;
                $img.attr('src', avatarURL);
            }
        });
    })

    // TODO
    $("#btnSearchNow").on('click', function () {});

    // Profile Page Tabs
    var clickedTab = $(".tabs > .active");
    var tabWrapper = $(".tab-content");
    var activeTab = tabWrapper.find(".active");
    var activeTabHeight = activeTab.outerHeight();

    activeTab.show();
    tabWrapper.height(activeTabHeight);

    $(".tabs > li").on("click", function () {
        $(".tabs > li").removeClass("active");
        $(this).addClass("active");
        clickedTab = $(".tabs .active");
        activeTab.fadeOut(250, function () {
            $(".tab-content > li").removeClass("active");
            var clickedTabIndex = clickedTab.index();
            $(".tab-content > li").eq(clickedTabIndex).addClass("active");
            activeTab = $(".tab-content > .active");
            activeTabHeight = activeTab.outerHeight();
            tabWrapper.stop().delay(50).animate({
                height: activeTabHeight
            }, 500, function () {
                activeTab.delay(50).fadeIn(250);
            });
        });
    });

    $("#currentLocation").on('click', function () {
        $("#location-select-modal-container").css("display", "block");
        $("#location-select-modal").css("display", "block");
    });

    $(".cancel").click(function () {
        $(".modal-container").fadeOut();
        $("#location-select-modal").fadeOut();
    });

    $("#btnEditProfile").on('click', function () {
        $("#profile-edit-modal-container").css("display", "block");
        $("#profile-edit-modal").css("display", "block");
    })

    $("#btnUploadPhoto").on('click', function () {
        $("#uploadPhotoInput").click();
    });

    $("#btnUploadVideo").on('click', function () {
        $("#uploadVideoInput").click();
    });

    $("#changeDP").on('click', function () {
        $("#inputChangeDP").click();
    });

    $("#btnMenu").on('click', function () {
        $(".navbar ul").toggleClass("hidden");
        $(".navbar ul").toggleClass("visible");
    })

    $("#btnWriteReview").on('click', function () {
        $('html,body').animate({
                scrollTop: $("#review-section").offset().top
            },
            'slow');
    });

    $("#btnUploadBusinessPhoto").on('click', function () {
        $("#fileBusinessPhoto").click();
    });

    // TODO Add Video & Photo on input onchange listeners

});
