// require('./bootstrap');

// const { parse } = require("postcss");

/* Author : Melkot, Aaneesh Naagaraj
ID : 1001750503 */
$.noConflict();
jQuery(document).ready(function ($) {

    $.ajax({
        url: '/city',
        dataType: 'json',
        success: function (data) {
            var cities = data;
            // console.log(data);
            var $citySelect = $('#location-select');
            var cityString = `<option value="choose" disabled selected>Change your location</option>`;
            cities.forEach(function (city) {
                cityString += `<option id=${city.city_id} value=${city.city_id}>${city.city_name}</option>`
            });
            $citySelect.append(cityString);
        }
    });

    $.ajax({
        url: '/category',
        dataType: 'json',
        success: function (data) {
            var categories = data;
            var $catSelect = $('#categories');
            var catString = `<option value="choose" disabled selected>Choose a category</option>`;
            categories.forEach(function (cat) {
                catString += `<option id=${cat.category_id} value=${cat.category_id}>${cat.category_name}</option>`
            });
            $catSelect.append(catString);
        }
    });

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

    $("input[name=dp]").on('change', function () {
        // alert(this.files[0].name);
        var fd = new FormData();
        var files = $('#inputChangeDP')[0].files;
        console.log(files);

        // Check file selected or not
        if (files.length > 0) {
            fd.append('file', files[0]);
            fd.append('_token', $('[name="csrf-token"]').attr('content'));

            $.ajax({
                url: '/dp',
                type: 'POST',
                data: fd,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response != 0) {
                        location.reload();
                        // alert(response);
                    } else {
                        alert('file not uploaded');
                    }
                },
            });
        } else {
            alert("Please select a file.");
        }
    });

    $("input[name=user_photo]").on('change', function () {
        // alert(this.files[0].name);
        var fd = new FormData();
        var files = $('#uploadPhotoInput')[0].files;

        // Check file selected or not
        if (files.length > 0) {
            fd.append('file', files[0]);
            fd.append('_token', $('[name="csrf-token"]').attr('content'));

            $.ajax({
                url: '/photo',
                type: 'post',
                data: fd,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response != 0) {
                        location.reload();
                    } else {
                        alert('file not uploaded');
                    }
                },
            });
        } else {
            alert("Please select a file.");
        }
    });

    $("input[name=user_video]").on('change', function () {
        // alert(this.files[0].name);
        var fd = new FormData();
        var files = $('#uploadVideoInput')[0].files;

        // Check file selected or not
        if (files.length > 0) {
            fd.append('file', files[0]);

            $.ajax({
                url: '/video',
                type: 'post',
                data: fd,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response != 0) {
                        location.reload();
                        // alert(response);
                    } else {
                        alert('file not uploaded');
                    }
                },
            });
        } else {
            alert("Please select a file.");
        }
    });

    $("input[name=business_photo]").on('change', function () {
        // alert(this.files[0].name);
        var fd = new FormData();
        var files = $('#fileBusinessPhoto')[0].files;
        var biz_id = $(this).attr('biz_id');
        // Check file selected or not
        if (files.length > 0) {
            fd.append('file', files[0]);
            $.ajax({
                url: '/business/photo/' + biz_id,
                type: 'post',
                data: fd,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response != 0) {
                        location.reload();
                        // alert(response);
                    } else {
                        alert('file not uploaded');
                    }
                },
            });
        } else {
            alert("Please select a file.");
        }
    });


    const socket = io('ws://localhost:8080');

    socket.on('message', text => {
        console.log(JSON.stringify(text));
        var chat = ` <div class="card post">
        <div class="flex-left">
            <img class="postIMG" src="http://localhost:8000/upload/user_dp/${text['dp']}" alt="">
            <div class="full-width">
                <div class="flex-left space-between align-items-center">
                    <a href="">
                        <h4 class="">${text['full_name']}</h4>
                    </a>
                    <p class="post-date"></p>
                </div>
                <p class="post-content">${text['message']}</p>
            </div>
        </div>
    </div>`
    $('#chats').append(chat);

    });

    $('#sendMessage').on('click', function() {
        const text = $('#chatMessage').val();
        $('#chatMessage').val('');
        var user;
        $.ajax({
            url: '/user',
            type: 'get',
            success: function (response) {
                user = response;
                user['message']=text
                // write chat message to DB
                socket.emit('message', user);
            },
        });

    });

});
