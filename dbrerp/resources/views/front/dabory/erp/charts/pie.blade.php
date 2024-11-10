<!-- Basic pie charts -->
<div class="card" id="pie-chart">
    <div class="card-header header-elements-inline">
        <h5 class="card-title"></h5>
    </div>

    <div class="card-body chart-container has-scroll text-center" id="chart-group">
        <div class="d-inline-block" id="google-pie"></div>
    </div>
</div>
<!-- /basic pie charts -->

@push('js')
    <script>
        $(document).ready(function() {
            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(function() {
                drawPie()
            })
        });

        (function( ChartsPie, $, undefined ) {
            ChartsPie.show_popup_callback = function () {
                // $('#pie-chart').find('#chart-group').html(`
                //     <div class="chart svg-center" id="d3-pie-basic"></div>
                // `)
                // _pieBasic();

                $('#pie-chart').find('#chart-group').html(`
                    <div class="d-inline-block" id="google-pie"></div>
                `)
                google.charts.setOnLoadCallback(function() {
                    drawPie()
                })
            }
        }( window.ChartsPie = window.ChartsPie || {}, jQuery ));

        function drawPie() {
            // Define charts element
            var pie_chart_element = document.getElementById('google-pie');

            // Data
            var data = google.visualization.arrayToDataTable(
            [
                ['Task', 'Hours per Day'],
                ['Work',     11],
                ['Eat',      2],
                ['Commute',  2],
                ['Watch TV', 2],
                ['Sleep',    7]
            ]);

            // Options
            var options_pie = {
                width: 500,
                height: 360,
                showLables: 'true',
                pieSliceText: 'value',
                pieSliceTextStyle: {
                    color: 'white',
                    fontSize: 18
                },
                legend: {
                    position: 'center',
                    alignment: 'center'
                },
                chartArea: {
                    left: 50,
                    top: 15,
                    width: '130%',
                    height: '90%'
                },
            };

            // Instantiate and draw our chart, passing in some options.
            var pie = new google.visualization.PieChart(pie_chart_element);
            pie.draw(data, options_pie);
        }

        // Chart
        var _pieBasic = function() {
            if (typeof d3 == 'undefined') {
                console.warn('Warning - d3.min.js is not loaded.');
                return;
            }

            // Main variables
            var element = document.getElementById('d3-pie-basic'),
                radius = 120;


            // Initialize chart only if element exsists in the DOM
            if(element) {

                // Basic setup
                // ------------------------------

                // Colors
                var color = d3.scale.category20();


                // Create chart
                // ------------------------------

                // Add SVG element
                var container = d3.select(element).append("svg");

                // Add SVG group
                var svg = container
                    .attr("width", radius * 2)
                    .attr("height", radius * 2)
                    .append("g")
                        .attr("transform", "translate(" + radius + "," + radius + ")");


                // Construct chart layout
                // ------------------------------

                // Arc
                var arc = d3.svg.arc()
                    .outerRadius(radius)
                    .innerRadius(0);

                // Pie
                var pie = d3.layout.pie()
                    .sort(null)
                    .value(function(d) { return d.population; });


                // Load data
                // ------------------------------

                data = [
                    { age: '<5', population: 4704659 },
                    { age: '5-13', population: 4499890 },
                    { age: '14-17', population: 3759981 },
                    { age: '18-25', population: 6853788 },
                    { age: '25-44', population: 7410543 },
                    { age: '45-64', population: 8819342 },
                    { age: '>=65', population: 4124630 },
                ]
                // Pull out values
                data.forEach(function(d) {
                        d.population = +d.population;
                    });


                    //
                    // Append chart elements
                    //

                    // Bind data
                    var g = svg.selectAll(".d3-arc")
                        .data(pie(data))
                        .enter()
                        .append("g")
                            .attr("class", "d3-arc");

                    // Add arc path
                    g.append("path")
                        .attr("d", arc)
                        .style("stroke", "#fff")
                        .style("fill", function(d) { return color(d.data.age); });

                    // Add text labels
                    g.append("text")
                        .attr("transform", function(d) { return "translate(" + arc.centroid(d) + ")"; })
                        .attr("dy", ".35em")
                        .style("fill", "#fff")
                        .style("font-size", 12)
                        .style("text-anchor", "middle")
                        .text(function(d) { return d.data.age; });
            }
        };
    </script>
@endpush
