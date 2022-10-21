@section('profile_card')

  <!-- ======= Profile card ======= -->
  <div class="card">
      <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
        @if ($user->image && file_exists(public_path('uploads/profile/img/').$user->image))
          <img src="{{ asset('uploads/profile/img/'.$user->image ) }}" alt="Profile" class="rounded">
        @else
          <img src="{{ asset('media/dashboard/profile-img-default.jpg') }}" alt="Profile" class="rounded">
        @endif
        <h2>{{ $user->name }}</h2>
        <h3>{{ $user->email }}</h3>
        <div class="social-links mt-2">
          @if (!empty($user->twitter_url))
            <a href="{{ $user->twitter_url }}" class="twitter" target="_blank"><i class="bi bi-twitter"></i></a>
          @endif
          @if (!empty($user->facebook_url))
            <a href="{{ $user->facebook_url }}" class="facebook" target="_blank"><i class="bi bi-facebook"></i></a>
          @endif
          @if (!empty($user->instagram_url))
            <a href="{{ $user->instagram_url }}" class="instagram" target="_blank"><i class="bi bi-instagram"></i></a>
          @endif
          @if (!empty($user->linkedin_url))
            <a href="{{ $user->linkedin_url }}" class="linkedin" target="_blank"><i class="bi bi-linkedin"></i></a>
          @endif
        </div>
      </div>
  </div><!-- End Profile card -->

@endsection