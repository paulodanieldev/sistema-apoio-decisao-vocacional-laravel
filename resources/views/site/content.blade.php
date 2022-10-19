@include('site.sections.hero')
@include('site.sections.app_features')
@include('site.sections.details')
@include('site.sections.galery')
@include('site.sections.testimonials')
@include('site.sections.pricing')
@include('site.sections.questions')
@include('site.sections.contact')

@section('content')

    @yield('hero')

    <main id="main">
        @yield('app_features')
        @yield('details')
        @yield('galery')
        @yield('testimonials')
        @yield('pricing')
        @yield('questions')
        @yield('contact')
    </main>

@endsection