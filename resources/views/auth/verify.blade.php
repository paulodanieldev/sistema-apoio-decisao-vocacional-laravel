@extends('layouts.dashboard_user_simple')
@include('dashboard.alerts')

@section('content')

<main id="main">
    <div class="container">
        <section class="section d-flex flex-column align-items-center justify-content-center">
            <!-- Special title treatmen -->
            <div class="card text-center">
                <div class="card-body my-3">
                    @yield('alerts')
                    <h5 class="card-title">{{ __('Verify Your Email Address') }}</h5>
                    <p class="card-text">{{ __('Before proceeding, please check your email for a verification link.') }}
                        {{ __('If you did not receive the email') }}.</p>
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-primary">{{ __('click here to request another') }}</button>.
                    </form>
                </div>
            </div>
            <!-- End Special title treatmen -->
        </section>
    </div>
</main><!-- End #main -->

@endsection
