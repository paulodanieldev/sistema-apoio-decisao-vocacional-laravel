@include('dashboard.sections.page_title')
@include('dashboard.sections.sales_card')
@include('dashboard.sections.revenue_card')
@include('dashboard.sections.customers_card')
@include('dashboard.sections.reports_card')
@include('dashboard.sections.recent_sales_card')
@include('dashboard.sections.top_selling_card')
@include('dashboard.sections.recent_activity_card')
@include('dashboard.sections.budget_card')
@include('dashboard.sections.website_trafic_card')
@include('dashboard.sections.news_and_updates_card')

@section('user_content')

    <main id="main">
        @yield('page_title')

        <section class="section dashboard">
            <div class="row">
                <!-- Left side columns -->
                <div class="col-lg-8">
                    <div class="row">

                    @yield('sales_card')
                    @yield('revenue_card')
                    @yield('customers_card')
                    @yield('reports_card')
                    @yield('recent_sales_card')
                    @yield('top_selling_card')

                    </div>
                </div><!-- End Left side columns -->

                <!-- Right side columns -->
                <div class="col-lg-4">
                    <div>

                    @yield('recent_activity_card')
                    @yield('budget_card')
                    @yield('website_trafic_card')
                    @yield('news_and_updates_card')

                    </div>
                </div><!-- End Right side columns -->
            </div>
        </section>

    </main>

@endsection