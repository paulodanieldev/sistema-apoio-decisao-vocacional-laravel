@section('admin_sidebar')
  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="{{ route( App\Helpers\UserHelper::getUserAccountType(Auth::user()) . '.dashboard') }}">
          <i class="bi bi-grid"></i>
          <span>Dashboard - Admin</span>
        </a>
      </li><!-- End Dashboard Nav -->

      {{-- <li class="nav-heading">Pages</li> --}}

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route( App\Helpers\UserHelper::getUserAccountType(Auth::user()) . '.profile.index') }}">
          <i class="bi bi-person"></i>
          <span>Perfil</span>
        </a>
      </li><!-- End Profile Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-faq.html">
          <i class="bi bi-people"></i>
          <span>Usuários</span>
        </a>
      </li><!-- End Users Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#school-reports-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-file-earmark-ruled"></i><span>Históricos escolares</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="school-reports-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{ route('admin.school-reports.index') }}">
              <i class="bi bi-circle"></i><span>Históricos</span>
            </a>
          </li>
          <li>
            <a href="school-reports-data.html">
              <i class="bi bi-circle"></i><span>Níveis escolares</span>
            </a>
          </li>
          <li>
            <a href="school-reports-data.html">
              <i class="bi bi-circle"></i><span>Séries escolares</span>
            </a>
          </li>
          <li>
            <a href="{{ route('admin.school-subjects.index') }}">
              <i class="bi bi-circle"></i><span>Matérias escolares</span>
            </a>
          </li>
        </ul>
      </li><!-- End School Reports Nav -->

      {{-- <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#quiz-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-card-checklist"></i><span>Quiz</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="quiz-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="quiz-chartjs.html">
              <i class="bi bi-circle"></i><span>General Quiz</span>
            </a>
          </li>
          <li>
            <a href="quiz-apexquiz.html">
              <i class="bi bi-circle"></i><span>Quiz Type</span>
            </a>
          </li>
          <li>
            <a href="quiz-equiz.html">
              <i class="bi bi-circle"></i><span>Quiz Questions Type</span>
            </a>
          </li>
        </ul>
      </li><!-- End Quiz Nav --> --}}
    </ul>

  </aside><!-- End Sidebar-->
@endsection