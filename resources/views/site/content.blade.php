@include('site.sections.hero')
@include('site.sections.about')
{{-- @include('site.sections.services') --}}
{{-- @include('site.sections.cta') --}}
@include('site.sections.features')
{{-- @include('site.sections.clients') --}}
{{-- @include('site.sections.counts') --}}
{{-- @include('site.sections.portfolio') --}}
{{-- @include('site.sections.pricing') --}}
{{-- @include('site.sections.faq') --}}
{{-- @include('site.sections.contact') --}}

@section('content')

    @yield('hero')

    <main id="main">
        @yield('about')
        {{-- @yield('services') --}}
        {{-- @yield('cta') --}}
        @yield('features')
        {{-- @yield('clients') --}}
        {{-- @yield('counts') --}}
        {{-- @yield('portfolio') --}}
        {{-- @yield('pricing') --}}
        {{-- @yield('faq') --}}
        {{-- @yield('contact') --}}
    </main>

@endsection