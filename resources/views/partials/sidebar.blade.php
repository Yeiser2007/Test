<div id="sidebar" class="bg-light border-end vh-100 position-fixed">
    <div class="p-3 text-center">
        <img src="https://cdn-icons-png.freepik.com/256/4344/4344949.png" class="img-sidebar" alt="">
        <ul class="nav flex-column mt-5">
            <li class="nav-item mb-2">
                <a href="{{ route('dashboard') }}" class="nav-link d-flex align-items-center">
                    <i class="bi bi-house fs-5 me-2"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item mb-2">
                <a href="{{ route('profile.edit') }}" class="nav-link d-flex align-items-center">
                    <i class="bi bi-person fs-5 me-2"></i>
                    <span>Perfil</span>
                </a>
            </li>
            <li class="nav-item mb-2">
                <a href="{{ route('examenes.index') }}" class="nav-link d-flex align-items-center">
                    <i class="bi bi-person fs-5 me-2"></i>
                    <span>Examenes</span>
                </a>
            </li>
            <li class="nav-item mb-2">
                <a href="{{ route('preguntas.index') }}" class="nav-link d-flex align-items-center">
                    <i class="bi bi-person fs-5 me-2"></i>
                    <span>Preguntas</span>
                </a>
            </li>
        </ul>
    </div>
</div>
