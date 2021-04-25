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

    var chart_data = [];
    $.ajax({
        url: '/general-data',
        type: 'get',
        success: function (data) {
            console.log(data);
            chart_data = data;
            var ctx = document.getElementById('myChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'polarArea',
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

    var chart_data2 = [];
    $.ajax({
        url: '/report-data-super',
        type: 'get',
        success: function (data) {
            console.log(data);
            chart_data = data;
            var user_data = [];
            var business_data = [];
            var countries = data['countries'];
            console.log(countries);
            countries.forEach(function(country) {
                user_data.push(data['users'][country]);
                business_data.push(data['business'][country]);
            });
            console.log(user_data);
            console.log(business_data);
            var ctx = document.getElementById('myChart2').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: data['countries'],
                    datasets: [{
                        label:"Users",
                        data: user_data,
                        borderWidth: 1,
                        borderColor: "#FFA0B4",
                        backgroundColor: "#FFA0B4",
                    },
                    {
                        label:"Businessess",
                        data: business_data,
                        borderWidth: 1,
                        borderColor: "#9AD0F5",
                        backgroundColor: "#9AD0F5",
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    },
                    title: {
                        display: true,
                        text: 'Users and Businessess in Countries'
                    }
                }
            });
                }
    });

    var chart_data3 = [];
    $.ajax({
        url: '/report-data-country',
        type: 'get',
        success: function (data) {
            console.log(data);
            var cities = data['cities'];
            var immigrant_count = [];
            var visitor_count = [];
            cities.forEach(function(city) {
                immigrant_count.push(data[city]['immigrants']);
                visitor_count.push(data[city]['visitors']);
            });
            var ctx = document.getElementById('myChart3').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: data['cities'],
                    datasets: [{
                        label:"Immigrants",
                        data: immigrant_count,
                        borderWidth: 1,
                        borderColor: "#FFA0B4",
                        backgroundColor: "#FFA0B4",
                    },
                    {
                        label:"Visitors",
                        data: visitor_count,
                        borderWidth: 1,
                        borderColor: "#9AD0F5",
                        backgroundColor: "#9AD0F5",
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    },
                    title: {
                        display: true,
                        text: 'Users and Businessess in Countries'
                    }
                }
            });
                }
    });

});
