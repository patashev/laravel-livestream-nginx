<div class="box box-primary" id="box-browsers" style="min-height: 400px;">
    <div class="box-header with-border">
        <h3 class="box-title">
            <span><i class="fa fa-chrome"></i></span>
            <span>Top Browsers</span>
        </h3>

        <?php echo $__env->make('admin.partials.boxes.toolbar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div>

    <div class="box-body">
        <div class="loading-widget text-primary">
            <i class="fa fa-fw fa-spinner fa-spin"></i>
        </div>

        <div id="chart-browsers-legend" class="chart-legend" style="margin-bottom: 5px;"></div>
        <canvas id="chart-browsers"></canvas>
    </div>
</div>

<?php $__env->startSection('scripts'); ?>
    ##parent-placeholder-16728d18790deb58b3b8c1df74f06e536b532695##
    <script type="text/javascript" charset="utf-8">
        $(function ()
        {
            var chart;

            initToolbarDateRange('#box-browsers .daterange', updateChart);

            /**
             * Get the chart's data
             * @param  view
             */
            function updateChart(start, end)
            {
                if (chart) {
                    chart.destroy();
                }

                if (!start) {
                    start = moment().subtract(29, 'days').format('YYYY-MM-DD');
                    end = moment().format('YYYY-MM-DD');
                }

                $('#box-browsers .loading-widget').show();
                doAjax('/api/analytics/browsers', {
                    'start': start, 'end': end,
                }, createPieChart);
            }

            function createPieChart(data)
            {
                // total page views and visitors line chart
                var ctx = document.getElementById("chart-browsers").getContext("2d");

                chart = new Chart(ctx).Doughnut(data, {
                    multiTooltipTemplate: "<%= value %> - <%= datasetLabel %>"
                });

                 $('#box-browsers .loading-widget').slideUp();

                $('#chart-browsers-legend').html(chart.generateLegend());
            }

            setTimeout(function ()
            {
                updateChart();
            }, 300);
        })
    </script>
<?php $__env->stopSection(); ?>