@section('profile_edit_card')

  <!-- ======= Profile Edit ======= -->
  <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
    <form action="{{ route($accountType . '.profile.update', $user->id ) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      <div class="row mb-3">
        <label class="col-md-4 col-lg-3 col-form-label">Foto do perfil</label>
        <div class="col-md-8 col-lg-9">
          @if ($user->image && file_exists(public_path('uploads/profile/img/').$user->image))
            <img id="profile_image_preview" src="{{ asset('uploads/profile/img/'.$user->image ) }}" alt="Profile" class="rounded">
          @else
            <img id="profile_image_preview" src="{{ asset('media/dashboard/profile-img-default.jpg') }}" alt="Profile" class="rounded">
          @endif
          <div class="pt-2">
            <input type="file" class="form-control" id="profile_image" name="profile_image" style="display: none">
            <label for="profile_image" class="btn btn-primary btn-sm" title="Upload new profile image" style="color: #FFFFFF"><i class="bi bi-upload"></i></label>
            {{-- <a href="#" class="btn btn-danger btn-sm" title="Remove my profile image"><i class="bi bi-trash"></i></a> --}}
            @if ($user->image && file_exists(public_path('uploads/profile/img/').$user->image))
                <input class="pl-3" type="checkbox" name="delete_profile_image" id="delete_profile_image" value="1"> Excluir imagem
            @endif
          </div>
        </div>
      </div>

      <div class="row mb-3">
        <label for="name" class="col-md-4 col-lg-3 col-form-label">Nome completo</label>
        <div class="col-md-8 col-lg-9">
          <input name="name" type="text" class="form-control" id="name" value="{{ $user->name }}" required>
        </div>
      </div>

      <div class="row mb-3">
        <label for="about" class="col-md-4 col-lg-3 col-form-label">Sobre você</label>
        <div class="col-md-8 col-lg-9">
          <textarea name="about" class="form-control" id="about" style="height: 100px">{{ $user->about }}</textarea>
        </div>
      </div>

      <div class="row mb-3">
        <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Telefone</label>
        <div class="col-md-8 col-lg-9">
          <input name="phone" type="text" class="form-control" id="phone" value="{{ $user->phone }}">
        </div>
      </div>

      <div class="row mb-3">
        <label for="Email" class="col-md-4 col-lg-3 col-form-label">E-mail</label>
        <div class="col-md-8 col-lg-9">
          <input name="email" type="email" class="form-control" id="email" value="{{ $user->email }}" disabled>
        </div>
      </div>

      <div class="row mb-3">
        <label for="twitter_url" class="col-md-4 col-lg-3 col-form-label">Twitter perfil</label>
        <div class="col-md-8 col-lg-9">
          <input name="twitter_url" type="text" class="form-control" id="twitter_url" value="{{ $user->twitter_url }}">
        </div>
      </div>

      <div class="row mb-3">
        <label for="facebook_url" class="col-md-4 col-lg-3 col-form-label">Facebook perfil</label>
        <div class="col-md-8 col-lg-9">
          <input name="facebook_url" type="text" class="form-control" id="facebook_url" value="{{ $user->facebook_url }}">
        </div>
      </div>

      <div class="row mb-3">
        <label for="instagram_url" class="col-md-4 col-lg-3 col-form-label">Instagram perfil</label>
        <div class="col-md-8 col-lg-9">
          <input name="instagram_url" type="text" class="form-control" id="instagram_url" value="{{ $user->instagram_url }}">
        </div>
      </div>

      <div class="row mb-3">
        <label for="linkedin_url" class="col-md-4 col-lg-3 col-form-label">Linkedin perfil</label>
        <div class="col-md-8 col-lg-9">
          <input name="linkedin_url" type="text" class="form-control" id="linkedin_url" value="{{ $user->linkedin_url }}">
        </div>
      </div>

      <div class="text-center">
        <button type="submit" class="btn btn-primary">Salvar</button>
      </div>
    </form><!-- End Profile Edit Form -->
  </div>
  <!-- End Profile Edit -->

@endsection