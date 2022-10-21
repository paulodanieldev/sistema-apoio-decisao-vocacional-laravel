@section('page_title')

  <!-- ======= Page Title ======= -->
  <div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route( App\Helpers\UserHelper::getUserAccountType(Auth::user()) . '.dashboard') }}">Home</a></li>
        <li class="breadcrumb-item active">Dashboard</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

@endsection