@section('page_title')

  <!-- ======= Page Title ======= -->
  <div class="pagetitle">
      <h1>Perfil</h1>
      <nav>
          <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route( $accountType . '.dashboard') }}">Dashboard</a></li>
          {{-- <li class="breadcrumb-item">Users</li> --}}
          <li class="breadcrumb-item active">Perfil</li>
          </ol>
      </nav>
  </div><!-- End Page Title -->

@endsection