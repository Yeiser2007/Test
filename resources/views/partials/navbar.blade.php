<nav class="navbar navbar-light bg-white shadow-sm px-3 border-bottom justify-content-between">
    <div class="d-flex align-items-center">
        <div id="toggleSidebar" class="burger me-3">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>

    <div class="d-flex align-items-center">
        <button id="toggleTheme" class="btn btn-outline-secondary me-3">
            <i class="bi bi-moon"></i>
        </button>
        <span class="navbar-brand mb-0 h1">{{ Auth::user()->nombre }} {{ Auth::user()->paterno }} {{ Auth::user()->materno }}</span>
    </div>
</nav>
