<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel') - BlogHub</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --sidebar-bg: #1e293b;
            --sidebar-hover: #334155;
            --primary: #4f46e5;
            --primary-dark: #3730a3;
            --success: #10b981;
            --danger: #ef4444;
        }
        * { box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: #f1f5f9; margin: 0; }

        /* Sidebar */
        .sidebar {
            width: 260px; min-height: 100vh; background: var(--sidebar-bg);
            position: fixed; top: 0; left: 0; z-index: 1000;
            display: flex; flex-direction: column; transition: transform .3s;
        }
        .sidebar-logo { padding: 1.5rem 1.5rem 1rem; border-bottom: 1px solid #334155; }
        .sidebar-logo a { font-size: 1.4rem; font-weight: 700; color: #fff; text-decoration: none; }
        .sidebar-logo span { color: #06b6d4; }
        .sidebar-logo small { display: block; color: #64748b; font-size: .75rem; margin-top: .1rem; }
        .sidebar-nav { padding: 1rem 0; flex: 1; }
        .nav-section-label { font-size: .7rem; text-transform: uppercase; letter-spacing: .08em; color: #64748b; padding: .75rem 1.5rem .3rem; }
        .sidebar-link {
            display: flex; align-items: center; gap: .75rem; padding: .65rem 1.5rem;
            color: #94a3b8; text-decoration: none; font-size: .9rem; font-weight: 500;
            transition: all .2s; border-left: 3px solid transparent;
        }
        .sidebar-link:hover { background: var(--sidebar-hover); color: #fff; }
        .sidebar-link.active { background: var(--sidebar-hover); color: #fff; border-left-color: var(--primary); }
        .sidebar-link i { width: 20px; text-align: center; }
        .sidebar-footer { padding: 1rem 1.5rem; border-top: 1px solid #334155; }

        /* Main content */
        .main-wrapper { margin-left: 260px; min-height: 100vh; }
        .topbar {
            background: #fff; padding: .9rem 1.5rem; display: flex;
            justify-content: space-between; align-items: center;
            box-shadow: 0 1px 6px rgba(0,0,0,.07); position: sticky; top: 0; z-index: 500;
        }
        .topbar h4 { font-weight: 600; margin: 0; font-size: 1.1rem; color: #1e293b; }
        .admin-badge { background: var(--primary); color: #fff; border-radius: 50px; padding: .3rem .9rem; font-size: .8rem; font-weight: 600; }
        .content-area { padding: 2rem 1.5rem; }

        /* Cards */
        .stat-card { background: #fff; border-radius: 14px; padding: 1.5rem; box-shadow: 0 2px 10px rgba(0,0,0,.06); }
        .stat-icon { width: 50px; height: 50px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.3rem; }

        /* Table */
        .admin-table { background: #fff; border-radius: 14px; box-shadow: 0 2px 10px rgba(0,0,0,.06); overflow: hidden; }
        .admin-table .table { margin: 0; }
        .admin-table .table th { background: #f8fafc; font-weight: 600; font-size: .85rem; color: #475569; border-bottom: 1px solid #e2e8f0; padding: .9rem 1.2rem; }
        .admin-table .table td { padding: .9rem 1.2rem; vertical-align: middle; font-size: .9rem; border-bottom: 1px solid #f1f5f9; }
        .admin-table .table tr:last-child td { border-bottom: none; }
        .table-header { padding: 1.2rem 1.5rem; display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #e2e8f0; }

        /* Forms */
        .form-card { background: #fff; border-radius: 14px; padding: 2rem; box-shadow: 0 2px 10px rgba(0,0,0,.06); }
        .form-label { font-weight: 600; font-size: .88rem; color: #374151; }
        .form-control, .form-select { border-radius: 8px; border: 1.5px solid #e2e8f0; font-size: .9rem; padding: .6rem .9rem; }
        .form-control:focus, .form-select:focus { border-color: var(--primary); box-shadow: 0 0 0 3px rgba(79,70,229,.12); }
        .btn-primary-custom { background: var(--primary); color: #fff; border: none; border-radius: 8px; padding: .6rem 1.5rem; font-weight: 600; font-size: .9rem; }
        .btn-primary-custom:hover { background: var(--primary-dark); color: #fff; }

        /* Badge */
        .badge-category { background: rgba(79,70,229,.1); color: var(--primary); font-size: .78rem; padding: .3rem .7rem; border-radius: 50px; font-weight: 600; }

        /* Sidebar toggle for mobile */
        .sidebar-overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,.5); z-index: 999; }
        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.open { transform: translateX(0); }
            .sidebar-overlay.show { display: block; }
            .main-wrapper { margin-left: 0; }
            .toggle-sidebar { display: flex !important; }
        }
        .toggle-sidebar { display: none; background: none; border: none; font-size: 1.3rem; color: #1e293b; }
    </style>
    @stack('styles')
</head>
<body>

<div class="sidebar-overlay" id="sidebarOverlay"></div>

<aside class="sidebar" id="sidebar">
    <div class="sidebar-logo">
        <a href="{{ route('admin.dashboard') }}">Blog<span>Hub</span></a>
        <small>Admin Panel</small>
    </div>
    <nav class="sidebar-nav">
        <div class="nav-section-label">Main</div>
        <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="fas fa-th-large"></i> Dashboard
        </a>
        <div class="nav-section-label">Content</div>
        <a href="{{ route('admin.blogs.index') }}" class="sidebar-link {{ request()->routeIs('admin.blogs.*') ? 'active' : '' }}">
            <i class="fas fa-newspaper"></i> Blog Posts
        </a>
        <a href="{{ route('admin.blogs.create') }}" class="sidebar-link {{ request()->routeIs('admin.blogs.create') ? 'active' : '' }}">
            <i class="fas fa-plus-circle"></i> New Post
        </a>
        <div class="nav-section-label">Site</div>
        <a href="{{ route('blogs.index') }}" class="sidebar-link" target="_blank">
            <i class="fas fa-external-link-alt"></i> View Site
        </a>
    </nav>
    <div class="sidebar-footer">
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit" class="sidebar-link w-100 text-start" style="background:none;border:none;cursor:pointer;color:#ef4444;padding:.65rem 0;">
                <i class="fas fa-sign-out-alt"></i> Logout
            </button>
        </form>
    </div>
</aside>

<div class="main-wrapper">
    <div class="topbar">
        <div class="d-flex align-items-center gap-3">
            <button class="toggle-sidebar" id="toggleSidebar"><i class="fas fa-bars"></i></button>
            <h4>@yield('page-title', 'Dashboard')</h4>
        </div>
        <span class="admin-badge"><i class="fas fa-user-shield me-1"></i>{{ Auth::guard('admin')->user()->name }}</span>
    </div>

    <div class="content-area">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show d-flex align-items-center gap-2 mb-3" role="alert" style="border-radius:10px;">
            <i class="fas fa-check-circle"></i>
            {{ session('success') }}
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center gap-2 mb-3" role="alert" style="border-radius:10px;">
            <i class="fas fa-exclamation-circle"></i>
            {{ session('error') }}
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
        </div>
        @endif

        @yield('content')
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
<script>
    $('#toggleSidebar').on('click', function() {
        $('#sidebar').toggleClass('open');
        $('#sidebarOverlay').toggleClass('show');
    });
    $('#sidebarOverlay').on('click', function() {
        $('#sidebar').removeClass('open');
        $(this).removeClass('show');
    });
</script>
@stack('scripts')
</body>
</html>
