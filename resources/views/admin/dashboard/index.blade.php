<x-layouts.admin.master>
    <div class="row">
        <div class="col-xl-12">
            <div class="card crm-widget">
                <div class="card-body p-0">
                    <div class="row row-cols-md-3 row-cols-1">
                        <div class="col col-lg border-end">
                            <div class="py-4 px-3">
                                <h5 class="text-muted text-uppercase fs-13">{{ __('Total Client') }}
                                </h5>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <i class="ri-user-line display-6 text-muted"></i>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h2 class="mb-0"><span class="counter-value"
                                                data-target="{{ $widgetData['totalClients'] }}">0</span></h2>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end col -->
                        <div class="col col-lg border-end">
                            <div class="mt-3 mt-md-0 py-4 px-3">
                                <h5 class="text-muted text-uppercase fs-13">{{ __('Total Orders(Amount)') }}
                                </h5>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <i class="mdi mdi-currency-bdt display-6 text-muted"></i>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h2 class="mb-0"><span class="counter-value"
                                                data-target="{{ $widgetData['totalOrdersAmount'] }}">0</span>
                                        </h2>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end col -->
                        <div class="col col-lg border-end">
                            <div class="mt-3 mt-md-0 py-4 px-3">
                                <h5 class="text-muted text-uppercase fs-13">
                                    {{ __('Completed Orders(Quantity)') }}
                                </h5>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <i class="ri-checkbox-circle-line display-6 text-muted"></i>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h2 class="mb-0"><span class="counter-value"
                                                data-target="{{ $widgetData['totalCompletedOrder'] }}">0</span>
                                        </h2>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end col -->
                        <div class="col col-lg border-end">
                            <div class="mt-3 mt-lg-0 py-4 px-3">
                                <h5 class="text-muted text-uppercase fs-13">
                                    {{ __('Total Pending Orders(Quantity)') }}
                                </h5>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <i class="ri-run-line display-6 text-muted"></i>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h2 class="mb-0"><span class="counter-value"
                                                data-target="{{ $widgetData['totalPendingOrder'] }}">0</span>
                                        </h2>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end col -->
                        <div class="col col-lg">
                            <div class="mt-3 mt-lg-0 py-4 px-3">
                                <h5 class="text-muted text-uppercase fs-13">
                                    {{ __('Total Cancelled Orders(Quantity)') }}
                                </h5>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <i class="ri-service-line display-6 text-muted"></i>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h2 class="mb-0"><span class="counter-value"
                                                data-target="{{ $widgetData['totalCancelledOrder'] }}">0</span></h2>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end col -->
                    </div><!-- end row -->
                </div><!-- end card body -->
            </div><!-- end card -->
        </div><!-- end col -->
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">{{ __('Monthly Order Status(Amount)') }}</h4>
                </div><!-- end card header -->
                <div class="card-body">
                    <div id="order_status_chart" data-colors='["--vz-primary", "--vz-success", "--vz-danger"]'
                        class="apex-charts" dir="ltr"></div>
                </div><!-- end card-body -->
            </div><!-- end card -->
        </div>
    </div>

    @push('scripts')
        <!-- ApexCharts Library -->
        <script src="/assets/admin/libs/apexcharts/apexcharts.min.js"></script>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const chartData = @json($chartData);

                const colors = {
                    pending: "#3b76e1", // Replace with CSS variable if required
                    completed: "#2db57d",
                    cancelled: "#ff5b5b"
                };

                const options = {
                    chart: {
                        height: 350,
                        type: "bar",
                        stacked: false,
                    },
                    plotOptions: {
                        bar: {
                            horizontal: false,
                            columnWidth: "50%",
                        },
                    },
                    dataLabels: {
                        enabled: false,
                    },
                    series: [{
                            name: "Pending",
                            data: chartData.pending,
                        },
                        {
                            name: "Completed",
                            data: chartData.completed,
                        },
                        {
                            name: "Cancelled",
                            data: chartData.cancelled,
                        },
                    ],
                    colors: [colors.pending, colors.completed, colors.cancelled],
                    xaxis: {
                        categories: chartData.categories,
                        title: {
                            text: "Months",
                        },
                    },
                    yaxis: {
                        title: {
                            text: "Total Amount (৳)",
                        },
                        labels: {
                            formatter: function(val) {
                                return `৳ ${val.toFixed(2)}`; // Add Unicode character
                            }
                        }
                    },
                    legend: {
                        position: "top",
                    },
                    grid: {
                        borderColor: "#f1f1f1",
                    },
                    tooltip: {
                        y: {
                            formatter: function(val) {
                                return `৳ ${val.toFixed(2)}`; // Add Unicode character
                            },
                        },
                    },
                };

                const chart = new ApexCharts(
                    document.querySelector("#order_status_chart"),
                    options
                );

                chart.render();
            });
        </script>
    @endpush


</x-layouts.admin.master>