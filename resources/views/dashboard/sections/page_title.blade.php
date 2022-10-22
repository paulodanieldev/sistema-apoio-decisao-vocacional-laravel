@section('page_title')

  <!-- ======= Page Title ======= -->
  <div class="pagetitle">
    <h1>Dashboard @if (Auth::user()->account_type == App\Constants\AccountTypePrefixConstants::ADMIN)- Admin @endif</h1>

    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route( App\Helpers\UserHelper::getUserAccountType(Auth::user()) . '.dashboard') }}">Home</a></li>
        <li class="breadcrumb-item active">Dashboard</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

@endsection