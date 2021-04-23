/* Author : Melkot, Aaneesh Naagaraj
ID : 1001750503 */
$.noConflict();
jQuery(document).ready(function ($) {


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

});