@include('user.profile.sections.page_title')
@include('user.profile.sections.profile_card')
@include('user.profile.sections.profile_tabs')
@include('user.profile.sections.profile_overview_card')
@include('user.profile.sections.profile_edit_card')
@include('user.profile.sections.profile_change_pass_card')

@section('content')

    <main id="main" class="main">
        @yield('page_title')
        <section class="section profile">
            <div class="row">
                <div class="col-xl-4">
                    @yield('profile_card')
                </div>
                <div class="col-xl-8">
                    <div class="card">
                        <div class="card-body pt-3">
                            <!-- Bordered Tabs -->
                            @yield('profile_tabs')
                            <div class="tab-content pt-2">
                                @yield('profile_overview_card')
                                @yield('profile_edit_card')
                                @yield('profile_change_pass_card')
                            </div><!-- End Bordered Tabs -->
                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main><!-- End #main -->

@endsection