<div class="sidebar border border-right col-md-3 col-lg-2 p-0 bg-body-tertiary">
    <div class="offcanvas-md offcanvas-end bg-body-tertiary" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="sidebarMenuLabel">Controle de pontos</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">
            <ul class="nav flex-column">
                <li class="nav-item">
                <a class="nav-link d-flex align-items-center gap-2 active" aria-current="page" href="#">
                    <svg class="bi"><use xlink:href="#house-fill"/></svg>
                    Dashboard
                </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2" href="{{ route('saldos.index') }}">
                        <svg class="bi"><use xlink:href="#graph-up"/></svg>
                        Saldos
                    </a>
                </li>
                <li class="nav-item">
                <a class="nav-link d-flex align-items-center gap-2" href="{{ route('programas.index') }}">
                    <svg class="bi"><use xlink:href="#graph-up"/></svg>
                    Programas
                </a>
                </li>
            </ul>

            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-body-secondary text-uppercase">
                <span>Programas</span>
                    <a class="link-secondary" href="#" aria-label="Add a new report">
                        <svg class="bi"><use xlink:href="#plus-circle"/></svg>
                    </a>
            </h6>
            <ul class="nav flex-column mb-auto">
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2" href="#">
                        <svg class="bi"><use xlink:href="#file-earmark-text"/></svg>
                        American Airlines
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2" href="#">
                        <svg class="bi"><use xlink:href="#file-earmark-text"/></svg>
                        Latam
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2" href="#">
                        <svg class="bi"><use xlink:href="#file-earmark-text"/></svg>
                        Miles&Go
                    </a>
                </li>
            </ul>

            <hr class="my-3">

            <ul class="nav flex-column mb-auto">
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2" href="#">
                        <svg class="bi"><use xlink:href="#gear-wide-connected"/></svg>
                        Configurações
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2" href="#">
                        <svg class="bi"><use xlink:href="#door-closed"/></svg>
                        Sair
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>