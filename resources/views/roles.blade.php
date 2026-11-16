<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Conoce los roles y permisos del Sistema de Gestión de Tareas de la Clase Práctica 5.">
    <title>Roles y permisos · PWA Práctica 5</title>
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/landing.css') }}" rel="stylesheet">
    <link href="{{ asset('css/roles.css') }}" rel="stylesheet">
    <script src="{{ asset('js/public-pages.js') }}" defer></script>
</head>
<body class="roles-page">
    <header class="roles-header">
        <nav class="roles-nav" aria-label="Navegación principal">
            <a class="roles-brand" href="{{ route('home') }}" aria-label="Práctica 5, inicio">
                <span class="roles-brand-mark">P5</span>
                <span><strong>Gestión de Tareas</strong><small>Programación Web Avanzada</small></span>
            </a>
            <div class="roles-nav-links">
                <a href="{{ route('home') }}#sistema">Sistema</a>
                <a class="active" href="{{ route('roles') }}" aria-current="page">Roles</a>
                <a href="{{ route('team') }}">Equipo</a>
            </div>
            <a class="roles-access" href="{{ auth()->check() ? route('dashboard') : route('login') }}">
                {{ auth()->check() ? 'Ir al panel' : 'Iniciar sesión' }} <span aria-hidden="true">→</span>
            </a>
        </nav>
    </header>

    <main>
        <section class="roles-hero">
            <div class="roles-blob roles-blob-one" aria-hidden="true"></div>
            <div class="roles-blob roles-blob-two" aria-hidden="true"></div>
            <div class="roles-shell roles-hero-grid">
                <div class="roles-hero-copy" data-reveal>
                    <p class="roles-eyebrow">PERMISOS CON PROPÓSITO</p>
                    <h1>Tres formas de participar.<br><em>Un mismo objetivo.</em></h1>
                    <p>Cada persona recibe las herramientas que necesita para actuar con claridad, sin perder de vista el trabajo del equipo.</p>
                    <div class="roles-hero-actions">
                        <a class="roles-button roles-button-primary" href="#recorrido">Descubrir los roles <span aria-hidden="true">↓</span></a>
                        <a class="roles-button roles-button-quiet" href="{{ auth()->check() ? route('dashboard') : route('login') }}">Entrar al sistema <span aria-hidden="true">↗</span></a>
                    </div>
                </div>

                <div class="roles-orbit" aria-label="Tres roles conectados" data-reveal data-reveal-delay="1">
                    <span class="roles-orbit-ring roles-orbit-ring-one" aria-hidden="true"></span>
                    <span class="roles-orbit-ring roles-orbit-ring-two" aria-hidden="true"></span>
                    <div class="roles-orbit-center"><strong>03</strong><small>ROLES</small></div>
                    <div class="roles-orbit-node roles-orbit-admin"><span>01</span><strong>Admin</strong></div>
                    <div class="roles-orbit-node roles-orbit-manager"><span>02</span><strong>Gerente</strong></div>
                    <div class="roles-orbit-node roles-orbit-member"><span>03</span><strong>Miembro</strong></div>
                </div>
            </div>
            <div class="roles-shell roles-hero-foot">
                <span>Control</span><i></i><span>Coordinación</span><i></i><span>Ejecución</span>
            </div>
        </section>

        <section class="roles-journey" id="recorrido">
            <div class="roles-shell">
                <div class="roles-section-heading" data-reveal>
                    <div><p class="roles-eyebrow roles-eyebrow-warm">UN RECORRIDO POR EL SISTEMA</p><h2>El acceso cambia.<br><em>La dirección se mantiene.</em></h2></div>
                    <p>Los permisos acompañan la responsabilidad de cada rol y mantienen protegidas las decisiones del proyecto.</p>
                </div>

                <div class="roles-stations">
                    <article class="role-station role-station-admin" data-reveal>
                        <div class="role-station-number"><span>01</span><small>CONTROL GLOBAL</small></div>
                        <div class="role-station-copy"><p class="roles-eyebrow">ADMINISTRACIÓN</p><h3>Administrador</h3><p>Prepara el entorno donde trabaja todo el equipo. Define cuentas, organiza proyectos y conserva una visión completa del sistema.</p></div>
                        <ul><li>Gestiona usuarios y roles</li><li>Crea y configura proyectos</li><li>Supervisa indicadores generales</li></ul>
                        <span class="role-station-symbol" aria-hidden="true">A</span>
                    </article>

                    <article class="role-station role-station-manager" data-reveal>
                        <div class="role-station-number"><span>02</span><small>COORDINACIÓN</small></div>
                        <div class="role-station-copy"><p class="roles-eyebrow">DIRECCIÓN DE PROYECTO</p><h3>Gerente de proyecto</h3><p>Transforma objetivos en trabajo concreto. Reúne integrantes, distribuye tareas y acompaña el avance del proyecto asignado.</p></div>
                        <ul><li>Consulta sus proyectos</li><li>Crea y asigna tareas</li><li>Coordina estados y responsables</li></ul>
                        <span class="role-station-symbol" aria-hidden="true">G</span>
                    </article>

                    <article class="role-station role-station-member" data-reveal>
                        <div class="role-station-number"><span>03</span><small>EJECUCIÓN</small></div>
                        <div class="role-station-copy"><p class="roles-eyebrow">TRABAJO EN EQUIPO</p><h3>Miembro del equipo</h3><p>Se concentra en las tareas que le corresponden. Actualiza su progreso y hace visible el estado real de cada entrega.</p></div>
                        <ul><li>Ve proyectos relacionados</li><li>Consulta tareas asignadas</li><li>Actualiza el estado de su trabajo</li></ul>
                        <span class="role-station-symbol" aria-hidden="true">M</span>
                    </article>
                </div>
            </div>
        </section>

        <section class="roles-flow">
            <div class="roles-shell roles-flow-grid">
                <div data-reveal>
                    <p class="roles-eyebrow">UNA CADENA DE RESPONSABILIDAD</p>
                    <h2>Una decisión abre paso a la siguiente.</h2>
                </div>
                <div class="roles-flow-track" data-reveal data-reveal-delay="1">
                    <article><span>01</span><strong>El administrador organiza</strong><p>Define el espacio y asigna el alcance inicial.</p></article>
                    <article><span>02</span><strong>El gerente coordina</strong><p>Convierte el proyecto en tareas realizables.</p></article>
                    <article><span>03</span><strong>El miembro avanza</strong><p>Ejecuta y comunica el progreso del trabajo.</p></article>
                </div>
            </div>
        </section>

        <section class="roles-closing">
            <div class="roles-shell roles-closing-inner" data-reveal>
                <div><p class="roles-eyebrow roles-eyebrow-warm">EL ROL CORRECTO, EN EL MOMENTO CORRECTO</p><h2>Menos ruido.<br><em>Más claridad.</em></h2></div>
                <div><p>Ingresa con una cuenta de demostración y comprueba cómo cambia la experiencia para cada integrante.</p><a class="roles-button roles-button-dark" href="{{ auth()->check() ? route('dashboard') : route('login') }}">Explorar el sistema <span aria-hidden="true">→</span></a></div>
            </div>
        </section>
    </main>

    <footer class="roles-footer">
        <div class="roles-shell roles-footer-inner">
            <a class="roles-brand" href="{{ route('home') }}"><span class="roles-brand-mark">P5</span><span><strong>Gestión de Tareas</strong><small>Clase Práctica 5</small></span></a>
            <p>Universidad Bolivariana del Ecuador · Programación Web Avanzada · 2026</p>
        </div>
    </footer>
</body>
</html>
