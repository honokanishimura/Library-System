<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title')</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('assets/css/admin/styles.css') }}">
</head>
<body>
  <div class="dashboard-container">

    <!-- Sidebar Navigation -->
    <aside class="sidebar">
      <h1 class="sidebar-title">Library System</h1>
      <hr class="dashboard-divider">
      <nav>
        <ul>
          <li class="side-navi-section-end active">
            <a href="{{ route('admin.dashboard') }}" class="active">
              <div class="side-navi-icon">
                <i class="fas fa-home"></i> Dashboard
              </div>
            </a>
          </li>
          <li class="side-navi-section-end">
            <a href="{{ route('admin.users.index') }}">
              <div class="side-navi-icon">
                <i class="fas fa-user"></i> User Management
              </div>
            </a>
          </li>
          <li class="side-navi-section-end">
            <a href="{{ route('admin.books.index') }}">
              <div class="side-navi-icon">
                <i class="fas fa-book"></i> Book List
              </div>
            </a>
          </li>
          <li class="side-navi-section-end">
            <a href="{{ route('admin.borrowing.index') }}">
              <div class="side-navi-icon">
                <i class="fas fa-exchange-alt"></i> Lending & Return
              </div>
            </a>
          </li>
          <li class="side-navi-section-end">
            <a href="{{ route('admin.genres.index') }}">
              <div class="side-navi-icon">
                <i class="fas fa-tags"></i> Genre Management
              </div>
            </a>
          </li>
          <li class="side-navi-section-end">
            <a href="{{ route('admin.admins.index') }}">
              <div class="side-navi-icon">
                <i class="fas fa-user-shield"></i> Admin Management
              </div>
            </a>
          </li>
        </ul>
      </nav>
    </aside>

    <!-- Main Content Area -->
    <div class="main-content">
      <header id="admin-header" class="d-flex justify-content-between align-items-center p-3 bg-light">
        <div>{{ Auth::guard('admin')->user()->name ?? 'Admin' }}</div>
        <div class="d-flex gap-4">
          <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">
            <i class="fas fa-house"></i> Home
          </a>
          <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit" class="btn btn-outline-secondary">
              <i class="fas fa-sign-out-alt"></i> Logout
            </button>
          </form>
        </div>
      </header>

      <main>
        @yield('content')
      </main>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  @yield('scripts')

</body>
</html>
