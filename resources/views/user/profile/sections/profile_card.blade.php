@section('profile_card')

  <!-- ======= Profile card ======= -->
  <div class="card">
      <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
      <img src="{{ asset('media/dashboard/profile-img.jpg') }}" alt="Profile" class="rounded-circle">
      <h2>{{ $user->name }}</h2>
      <h3>{{ $user->email }}</h3>
      <div class="social-links mt-2">
          <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
          <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
          <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
          <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
      </div>
      </div>
  </div><!-- End Profile card -->

@endsection