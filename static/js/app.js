$.noConflict();
jQuery(document).ready(function ($) {

    // Sticky Navbar
    window.onscroll = function () {
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
    }

    // Fake Placeholder names and Images
    let firstName = faker.name.firstName();
    let lastName = faker.name.lastName();

    let cityName = faker.address.city();
    let stateAbbr = faker.address.stateAbbr();

    $(".profileName").text(`${firstName} ${lastName}`);
    $(".currentLocation").html(`<i class="fas fa-map-marker-alt loc-icon"></i> ${cityName}, ${stateAbbr}`)
    $(".business-name").text(`${faker.company.companyName()}`);
    $(".business-category").text(`${faker.company.catchPhrase()}`);

    $.ajax({
        url: 'https://randomuser.me/api/',
        dataType: 'json',
        success: function (data) {
            var avatarURL = data.results[0].picture.thumbnail;
            var profileIMGURL = data.results[0].picture.large;
            $(".avatarIMG").attr('src', avatarURL);
            $(".profileIMG").attr('src', profileIMGURL);
        }
    });

    // TODO
    $("#btnSearchNow").on('click', function() {
    });

    // Profile Page Tabs
	var clickedTab = $(".tabs > .active");
	var tabWrapper = $(".tab-content");
	var activeTab = tabWrapper.find(".active");
	var activeTabHeight = activeTab.outerHeight();
	
	activeTab.show();
	tabWrapper.height(activeTabHeight);
	
	$(".tabs > li").on("click", function() {
		$(".tabs > li").removeClass("active");
		$(this).addClass("active");
		clickedTab = $(".tabs .active");
		activeTab.fadeOut(250, function() {
			$(".tab-content > li").removeClass("active");
			var clickedTabIndex = clickedTab.index();
			$(".tab-content > li").eq(clickedTabIndex).addClass("active");
			activeTab = $(".tab-content > .active");
			activeTabHeight = activeTab.outerHeight();	
			tabWrapper.stop().delay(50).animate({
				height: activeTabHeight
			}, 500, function() {
				activeTab.delay(50).fadeIn(250);
			});
		});
	});
	
});