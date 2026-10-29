<nav class="navbar navbar-expand-lg border-bottom shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('home') }}">
            KursusKu
        </a>

        <div class="navbar-collapse" id="navbarMenu">
            <ul class="navbar-nav ms-auto gap-lg-2 flex-row">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">Beranda</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('courses.index') }}">Daftar Kursus</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('enrollments.create') }}">Pendaftaran</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('enrollments.index') }}">Data Peserta</a>
                </li>
            </ul>
        </div>
    </div>
</nav>