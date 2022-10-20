@section('profile_edit_card')

  <!-- ======= Profile Edit Card ======= -->
  <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
      {{-- <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <div class="row">
              <div class="col-xl-4">
                  <div class="card">
                      <div class="card-body">
                          <div class="profile-img">
                              <img src="{{ asset('media/dashboard/profile-img.jpg') }}" alt="Profile" class="rounded-circle">
                              <div class="file btn btn-lg btn-primary">
                                  Change Photo
                                  <input type="file" name="profile_image" />
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-xl-8">
                  <div class="card">
                      <div class="card-body">
                          <div class="row">
                              <div class="col-xl-6">
                                  <div class="mb-3">
                                      <label for="name" class="form-label">Name</label>
                                      <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
                                  </div>
                              </div>
                              <div class="col-xl-6">
                                  <div class="mb-3">
                                      <label for="email" class="form-label">Email</label>
                                      <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
                                  </div>
                              </div>
                              <div class="col-xl-6">
                                  <div class="mb-3">
                                      <label for="phone" class="form-label">Phone</label>
                                      <input type="text" class="form-control" id="phone" name="phone" value="{{ $user->phone }}">
                                  </div>
                              </div>
                              <div class="col-xl-6">
                                  <div class="mb-3">
                                      <label for="address" class="form-label">Address</label>
                                      <input type="text" class="form-control" id="address" name="address" value="{{ $user->address }}">
                                  </div>
                              </div>
                              <div class="col-xl-6">
                                  <div class="mb-3">
                                      <label for="city" class="form-label">City</label>
                                      <input type="text" class --}}
    <!-- Profile Edit Form -->
    <form>
      <div class="row mb-3">
        <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
        <div class="col-md-8 col-lg-9">
          <img src="{{ asset('media/dashboard/profile-img.jpg') }}" alt="Profile">
          <div class="pt-2">
            <a href="#" class="btn btn-primary btn-sm" title="Upload new profile image"><i class="bi bi-upload"></i></a>
            <a href="#" class="btn btn-danger btn-sm" title="Remove my profile image"><i class="bi bi-trash"></i></a>
          </div>
        </div>
      </div>

      <div class="row mb-3">
        <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
        <div class="col-md-8 col-lg-9">
          <input name="fullName" type="text" class="form-control" id="fullName" value="Kevin Anderson">
        </div>
      </div>

      <div class="row mb-3">
        <label for="about" class="col-md-4 col-lg-3 col-form-label">About</label>
        <div class="col-md-8 col-lg-9">
          <textarea name="about" class="form-control" id="about" style="height: 100px">Sunt est soluta temporibus accusantium neque nam maiores cumque temporibus. Tempora libero non est unde veniam est qui dolor. Ut sunt iure rerum quae quisquam autem eveniet perspiciatis odit. Fuga sequi sed ea saepe at unde.</textarea>
        </div>
      </div>

      <div class="row mb-3">
        <label for="company" class="col-md-4 col-lg-3 col-form-label">Company</label>
        <div class="col-md-8 col-lg-9">
          <input name="company" type="text" class="form-control" id="company" value="Lueilwitz, Wisoky and Leuschke">
        </div>
      </div>

      <div class="row mb-3">
        <label for="Job" class="col-md-4 col-lg-3 col-form-label">Job</label>
        <div class="col-md-8 col-lg-9">
          <input name="job" type="text" class="form-control" id="Job" value="Web Designer">
        </div>
      </div>

      <div class="row mb-3">
        <label for="Country" class="col-md-4 col-lg-3 col-form-label">Country</label>
        <div class="col-md-8 col-lg-9">
          <input name="country" type="text" class="form-control" id="Country" value="USA">
        </div>
      </div>

      <div class="row mb-3">
        <label for="Address" class="col-md-4 col-lg-3 col-form-label">Address</label>
        <div class="col-md-8 col-lg-9">
          <input name="address" type="text" class="form-control" id="Address" value="A108 Adam Street, New York, NY 535022">
        </div>
      </div>

      <div class="row mb-3">
        <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
        <div class="col-md-8 col-lg-9">
          <input name="phone" type="text" class="form-control" id="Phone" value="(436) 486-3538 x29071">
        </div>
      </div>

      <div class="row mb-3">
        <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
        <div class="col-md-8 col-lg-9">
          <input name="email" type="email" class="form-control" id="Email" value="k.anderson@example.com">
        </div>
      </div>

      <div class="row mb-3">
        <label for="Twitter" class="col-md-4 col-lg-3 col-form-label">Twitter Profile</label>
        <div class="col-md-8 col-lg-9">
          <input name="twitter" type="text" class="form-control" id="Twitter" value="https://twitter.com/#">
        </div>
      </div>

      <div class="row mb-3">
        <label for="Facebook" class="col-md-4 col-lg-3 col-form-label">Facebook Profile</label>
        <div class="col-md-8 col-lg-9">
          <input name="facebook" type="text" class="form-control" id="Facebook" value="https://facebook.com/#">
        </div>
      </div>

      <div class="row mb-3">
        <label for="Instagram" class="col-md-4 col-lg-3 col-form-label">Instagram Profile</label>
        <div class="col-md-8 col-lg-9">
          <input name="instagram" type="text" class="form-control" id="Instagram" value="https://instagram.com/#">
        </div>
      </div>

      <div class="row mb-3">
        <label for="Linkedin" class="col-md-4 col-lg-3 col-form-label">Linkedin Profile</label>
        <div class="col-md-8 col-lg-9">
          <input name="linkedin" type="text" class="form-control" id="Linkedin" value="https://linkedin.com/#">
        </div>
      </div>

      <div class="text-center">
        <button type="submit" class="btn btn-primary">Save Changes</button>
      </div>
    </form><!-- End Profile Edit Form -->
  </div>
  <!-- End Profile Edit Card -->

@endsection