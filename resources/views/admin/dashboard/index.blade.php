<x-layouts.admin.master>
    @php
        $currentYear = date('Y');
        $startYear = 2021; // Define the starting year
        $endYear = $currentYear + 5; // Define the end year dynamically, 5 years into the future
        $years = [];
        for ($year = $startYear; $year <= $endYear; $year++) {
            $years[$year] = $year;
        }
    @endphp
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
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">{{ __('Monthly Profit') }} - Year: {{ $selectedYear }}</h4>
                    <div class="position-relative">
                        <form action="{{ route('dashboard') }}" method="get">
                            <div class="right-content d-flex gap-2 align-items-center">
                                <x-data-entry.select name="profit_year" label="Year" placeholder="Year"
                                    :options="$years" :selected="$selectedProfitYear" label="Select Year" required />
                                <button class="btn btn-primary btn-sm py-2 mt-2 px-2" type="submit">
                                    <i class="mdi mdi-magnify"></i> Search
                                </button>
                            </div>
                        </form>
                    </div>

                </div>
                <div class="card-body">
                    <div id="profit_chart" data-colors='["--vz-primary", "--vz-success", "--vz-danger"]'
                        class="apex-charts" dir="ltr"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="left-content">
                        <h4 class="card-title mb-0">{{ __('Monthly Order Status(Amount)') }}-Year: {{ $selectedYear }}
                        </h4>
                    </div>
                    <div class="position-relative">
                        <form action="{{ route('dashboard') }}" method="get">
                            <div class="right-content d-flex gap-2 align-items-center">
                                <x-data-entry.select name="order_status_year" label="Year" placeholder="Year"
                                    :options="$years" :selected="$selectedYear" label="Select Year" required />
                                <button class="btn btn-primary btn-sm py-2 mt-2 px-2" type="submit">
                                    <i class="mdi mdi-magnify"></i> Search
                                </button>
                            </div>
                        </form>
                    </div>

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
            document.addEventListener("DOMContentLoaded", function() {
                const profitChartData = @json($profitChartData);

                const profitOptions = {
                    chart: {
                        height: 350,
                        type: "line", // Change to "bar" if you prefer
                    },
                    series: [{
                        name: "Profit",
                        data: profitChartData.profit,
                    }],
                    colors: ["#2db57d"], // Customize color
                    xaxis: {
                        categories: profitChartData.categories,
                        title: {
                            text: "Months",
                        },
                    },
                    yaxis: {
                        title: {
                            text: "Profit (৳)",
                        },
                        labels: {
                            formatter: function(val) {
                                return `৳ ${val.toFixed(2)}`; // Add currency symbol
                            }
                        }
                    },
                    grid: {
                        borderColor: "#f1f1f1",
                    },
                    tooltip: {
                        y: {
                            formatter: function(val) {
                                return `৳ ${val.toFixed(2)}`;
                            },
                        },
                    },
                };

                const profitChart = new ApexCharts(
                    document.querySelector("#profit_chart"),
                    profitOptions
                );

                profitChart.render();
            });
        </script>
    @endpush
</x-layouts.admin.master>
