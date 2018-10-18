<div class="box box-primary" id="box-geo-visitors" style="min-height: 400px;">
    <div class="box-header with-border">
        <h3 class="box-title">
            <span><i class="fa fa-globe"></i></span>
            <span>Visitors</span>
        </h3>

        <?php echo $__env->make('admin.partials.boxes.toolbar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div>

    <div class="box-body">
        <div class="loading-widget text-primary">
            <i class="fa fa-fw fa-spinner fa-spin"></i>
        </div>

        <div id="js-geo-visitors-chart"></div>
    </div>
</div>

<?php $__env->startSection('scripts'); ?>
    ##parent-placeholder-16728d18790deb58b3b8c1df74f06e536b532695##
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" charset="utf-8">
        $(function () {
            google.charts.load('current', {
                'packages': ['geochart'],
                'mapsApiKey': "<?php echo e(config('app.google_map_key')); ?>"
            });
            // on callback - get chart info chart
            google.charts.setOnLoadCallback(updateChart);

            var chart;

            initToolbarDateRange('#box-geo-visitors .daterange', updateChart);

            /**
             * Get the chart's data
             * @param  view
             */
            function updateChart(start, end)
            {
                if (chart) {
                    chart.clearChart();
                }

                if (!start) {
                    start = moment().subtract(29, 'days').format('YYYY-MM-DD');
                    end = moment().format('YYYY-MM-DD');
                }

                $('#box-geo-visitors .loading-widget').show();
                doAjax('/api/analytics/visitors/locations', {
                    'start': start, 'end': end,
                }, createVisitorsLocations);
            }

            function createVisitorsLocations(response)
            {
                $('#box-geo-visitors .loading-widget').slideUp();

                var items = response.data;
                items.unshift(['Country', 'Sessions']);

                var data = google.visualization.arrayToDataTable(items);
                chart = new google.visualization.GeoChart(document.getElementById('js-geo-visitors-chart'));
                chart.draw(data, {
                    colorAxis: {minValue: 0,  colors: ['#b2dcf5', '#06517b']}
                });
            }
        })
    </script>
<?php $__env->stopSection(); ?>