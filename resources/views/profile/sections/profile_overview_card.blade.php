@section('profile_overview_card')

  <!-- ======= Profile About Card ======= -->
  <div class="tab-pane fade show active profile-overview" id="profile-overview">
    @if (!empty($user->about))
      <h5 class="card-title">About</h5>
      <p class="small fst-italic">{{ $user->about }}</p>
    @endif

    <h5 class="card-title">Detalhes do perfil</h5>

    <div class="row">
      <div class="col-lg-3 col-md-4 label ">Nome completo</div>
      <div class="col-lg-9 col-md-8">{{ $user->name }}</div>
    </div>

    @if (!empty($user->phone))
      <div class="row">
        <div class="col-lg-3 col-md-4 label">Telefone</div>
        <div class="col-lg-9 col-md-8">{{ $user->phone }}</div>
      </div>
    @endif

    <div class="row">
      <div class="col-lg-3 col-md-4 label">E-mail</div>
      <div class="col-lg-9 col-md-8">{{ $user->email }}</div>
    </div>
  </div>
  <!-- End Profile About Card -->

@endsection