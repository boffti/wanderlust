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


    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
            datasets: [{
                label: '# Some cool data',
                data: [12, 19, 3, 5, 2, 3],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
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

    var ctx2 = document.getElementById('chart2').getContext('2d');
    var myDoughnutChart = new Chart(ctx2, {
        type: 'doughnut',
        data: {
            datasets: [{
                backgroundColor: [
                    "#2ecc71",
                    "#3498db",
                    "#95a5a6",
                    "#9b59b6",
                    "#f1c40f",
                    "#e74c3c",
                    "#34495e"
                ],
                data: [12, 19, 3, 17, 28, 24, 7]
            }]
        }
    });

    $("#btnAddCity").on('click', function () {
        $(".modal-container").css("display", "block");
        $("#add-city-modal").css("display", "block");
    });

    $(".cancel").click(function () {
        $(".modal-container").fadeOut();
        $(".modal").fadeOut();
    });

    $('#btnAddPlaceOfInterest').on('click', function () {
        $(".modal-container").css("display", "block");
        $("#add-poi-modal").css("display", "block");
    });

});