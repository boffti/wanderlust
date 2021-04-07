/* Author : Melkot, Aaneesh Naagaraj
ID : 1001750503 */
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
            var profileIMGURL = data.results[0].picture.large;
            $(".avatarIMG").attr('src', avatarURL);
            $(".profileIMG").attr('src', profileIMGURL);
        }
    });

    $("#btnAddCity").on('click', function () {
        $("#add-city-modal-container").css("display", "block");
        $("#add-city-modal").css("display", "block");
    });

    $("#btnAddCountry").on('click', function () {
        $("#add-country-modal-container").css("display", "block");
        $("#add-country-modal").css("display", "block");
    });

    $("#btnAddContinent").on('click', function () {
        $("#add-continent-modal-container").css("display", "block");
        $("#add-continent-modal").css("display", "block");
    });

    $("#btnAddAdmin").on('click', function () {
        $("#add-admin-modal-container").css("display", "block");
        $("#add-admin-modal").css("display", "block");
    });

    $(".cancel").click(function () {
        $(".modal-container").fadeOut();
        $(".modal").fadeOut();
    });

    $('#btnAddPlaceOfInterest').on('click', function () {
        $("#add-poi-modal-container").css("display", "block");
        $("#add-poi-modal").css("display", "block");
    });

    var chart_data = [];
    $.ajax({
        url: '../../php/charts.php',
        type: 'post',
        success: function (data) {
            console.log(data);
            chart_data = JSON.parse(data);
            var ctx = document.getElementById('myChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ['Users', 'Posts', 'Attractions', 'Tips'],
                    datasets: [{
                        data: chart_data,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
                }
    });
    

});