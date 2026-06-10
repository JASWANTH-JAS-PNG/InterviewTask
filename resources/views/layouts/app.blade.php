<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'BlogHub - Latest Blogs')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #4f46e5;
            --primary-dark: #3730a3;
            --accent: #06b6d4;
            --bg-light: #f8fafc;
            --text-dark: #1e293b;
            --text-muted: #64748b;
            --border: #e2e8f0;
        }
        * { box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: var(--bg-light); color: var(--text-dark); }

        /* Navbar */
        .navbar { background: #fff; box-shadow: 0 1px 10px rgba(0,0,0,.08); padding: 1rem 0; }
        .navbar-brand { font-weight: 700; font-size: 1.5rem; color: var(--primary) !important; }
        .navbar-brand span { color: var(--accent); }
        .nav-link { color: var(--text-dark) !important; font-weight: 500; transition: color .2s; }
        .nav-link:hover { color: var(--primary) !important; }
        .search-form { display: flex; gap: .5rem; }
        .search-form input { border-radius: 50px; border: 1.5px solid var(--border); padding: .4rem 1rem; font-size: .9rem; width: 220px; }
        .search-form input:focus { outline: none; border-color: var(--primary); box-shadow: 0 0 0 3px rgba(79,70,229,.15); }
        .btn-search { border-radius: 50px; background: var(--primary); color: #fff; border: none; padding: .4rem 1rem; }

        /* Hero */
        .hero { background: linear-gradient(135deg, var(--primary) 0%, var(--accent) 100%); color: #fff; padding: 4rem 0 3rem; text-align: center; }
        .hero h1 { font-size: 2.8rem; font-weight: 700; margin-bottom: .75rem; }
        .hero p { font-size: 1.1rem; opacity: .9; max-width: 520px; margin: 0 auto; }

        /* Cards */
        .blog-card { background: #fff; border-radius: 16px; overflow: hidden; box-shadow: 0 2px 12px rgba(0,0,0,.06); transition: transform .25s, box-shadow .25s; height: 100%; display: flex; flex-direction: column; }
        .blog-card:hover { transform: translateY(-4px); box-shadow: 0 8px 28px rgba(0,0,0,.12); }
        .blog-card img { width: 100%; height: 200px; object-fit: cover; }
        .card-body-custom { padding: 1.25rem; flex: 1; display: flex; flex-direction: column; }
        .card-category { display: inline-block; background: rgba(79,70,229,.1); color: var(--primary); font-size: .75rem; font-weight: 600; padding: .2rem .7rem; border-radius: 50px; margin-bottom: .6rem; text-transform: uppercase; letter-spacing: .05em; }
        .card-title-custom { font-size: 1.05rem; font-weight: 600; color: var(--text-dark); margin-bottom: .5rem; line-height: 1.4; }
        .card-excerpt { font-size: .88rem; color: var(--text-muted); line-height: 1.6; flex: 1; }
        .card-footer-custom { display: flex; justify-content: space-between; align-items: center; margin-top: 1rem; padding-top: .75rem; border-top: 1px solid var(--border); }
        .card-date { font-size: .8rem; color: var(--text-muted); }
        .btn-read { font-size: .82rem; font-weight: 600; color: var(--primary); text-decoration: none; }
        .btn-read:hover { color: var(--primary-dark); }

        /* Sidebar */
        .filter-card { background: #fff; border-radius: 16px; padding: 1.5rem; box-shadow: 0 2px 12px rgba(0,0,0,.06); margin-bottom: 1.5rem; }
        .filter-card h5 { font-weight: 700; margin-bottom: 1rem; color: var(--text-dark); font-size: 1rem; }
        .category-btn { display: block; width: 100%; text-align: left; background: none; border: 1.5px solid var(--border); border-radius: 8px; padding: .5rem .9rem; margin-bottom: .5rem; font-size: .88rem; color: var(--text-dark); cursor: pointer; transition: all .2s; }
        .category-btn:hover, .category-btn.active { background: var(--primary); color: #fff; border-color: var(--primary); }
        .category-btn .badge { float: right; background: rgba(255,255,255,.3); color: inherit; font-size: .75rem; }

        /* Blog detail */
        .blog-detail-img { width: 100%; max-height: 420px; object-fit: cover; border-radius: 16px; margin-bottom: 1.5rem; }
        .blog-content { font-size: 1rem; line-height: 1.85; color: #374151; }
        .blog-content p { margin-bottom: 1.2rem; }

        /* Footer */
        footer { background: #1e293b; color: #94a3b8; padding: 2.5rem 0 1.5rem; margin-top: 4rem; }
        footer h5 { color: #fff; font-weight: 600; }
        footer a { color: #94a3b8; text-decoration: none; }
        footer a:hover { color: #fff; }
        .footer-bottom { border-top: 1px solid #334155; margin-top: 1.5rem; padding-top: 1.25rem; text-align: center; font-size: .85rem; }

        /* Loading spinner */
        #loading-spinner { display: none; text-align: center; padding: 2rem; }
        .spinner { width: 40px; height: 40px; border: 4px solid #e2e8f0; border-top-color: var(--primary); border-radius: 50%; animation: spin .8s linear infinite; display: inline-block; }
        @keyframes spin { to { transform: rotate(360deg); } }

        /* No results */
        .no-results { text-align: center; padding: 3rem 1rem; color: var(--text-muted); }
        .no-results i { font-size: 3rem; margin-bottom: 1rem; opacity: .4; }

        @media (max-width: 768px) {
            .hero h1 { font-size: 1.9rem; }
            .search-form input { width: 150px; }
        }
    </style>
    @stack('styles')
</head>
<body>

<nav class="navbar navbar-expand-lg sticky-top">
    <div class="container">
        <a class="navbar-brand" href="{{ route('blogs.index') }}">Blog<span>Hub</span></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link" href="{{ route('blogs.index') }}">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('blogs.index') }}">Blogs</a></li>
            </ul>
            <form class="search-form" id="search-form" action="{{ route('blogs.index') }}" method="GET">
                <input type="text" name="search" id="search-input" placeholder="Search blogs..." value="{{ request('search') }}">
                <button type="submit" class="btn-search"><i class="fas fa-search"></i></button>
            </form>
        </div>
    </div>
</nav>

@yield('content')

<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-3">
                <h5>BlogHub</h5>
                <p class="mt-2" style="font-size:.9rem;">Your go-to source for the latest news on admit cards, results, and more.</p>
            </div>
            <div class="col-md-4 mb-3">
                <h5>Quick Links</h5>
                <ul class="list-unstyled mt-2">
                    <li><a href="{{ route('blogs.index') }}">Home</a></li>
                    <li><a href="{{ route('blogs.index') }}?category=admit-card">Admit Cards</a></li>
                    <li><a href="{{ route('blogs.index') }}?category=result">Results</a></li>
                </ul>
            </div>
            <div class="col-md-4 mb-3">
                <h5>Admin</h5>
                <ul class="list-unstyled mt-2">
                    <li><a href="{{ route('admin.login') }}">Admin Panel</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            &copy; {{ date('Y') }} BlogHub. Built with Laravel &amp; ❤️
        </div>
    </div>
</footer>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
