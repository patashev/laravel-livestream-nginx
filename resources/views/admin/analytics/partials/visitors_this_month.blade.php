
<!-- LINE CHART -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Line Chart</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div class="chart">
                <canvas id="lineChart" style="height:250px"></canvas>
              </div>
            </div>
            <!-- /.box-body -->
          </div>


@section('scripts')
    @parent
    <script type="text/javascript" charset="utf-8">
        $(function () {
            function getMonthlySummaryNew()
            {
                doAjax('/api/analytics/visitors', null, function (response) {
                    $('#visitors').html(response.data['month']['value']);
                    doughnutChartNew('chart-visitors-side-bar', response.data);
                });
            }

            function doughnutChartNew(id, data)
            {
                // total page views and visitors line chart
                var ctx = document.getElementById(id).getContext("2d");

                var chart = new Chart(ctx).Doughnut(data, {});
            }

            getMonthlySummaryNew();
        })
    </script>
@endsection
