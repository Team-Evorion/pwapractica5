<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Sistema académico de gestión de proyectos, tareas y permisos desarrollado para la Clase Práctica 5 de Programación Web Avanzada.">
    <title>Gestión de Tareas · PWA Práctica 5</title>
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/landing.css') }}" rel="stylesheet">
</head>
<body class="landing-page">
    <header class="landing-header">
        <nav class="landing-nav" aria-label="Navegación principal">
            <a class="landing-brand" href="#inicio" aria-label="Práctica 5, inicio">
                <span class="landing-brand-mark">P5</span>
                <span><strong>Gestión de Tareas</strong><small>Programación Web Avanzada</small></span>
            </a>

            <div class="landing-links">
                <a href="#sistema">Sistema</a>
                <a href="#roles">Roles</a>
                <a href="{{ route('team') }}">Equipo</a>
            </div>

            <a class="landing-access" href="{{ auth()->check() ? route('dashboard') : route('login') }}">
                {{ auth()->check() ? 'Ir al panel' : 'Iniciar sesión' }} <span aria-hidden="true">→</span>
            </a>
        </nav>
    </header>

    <main>
        <section class="landing-hero" id="inicio">
            <div class="landing-orb landing-orb-one" aria-hidden="true"></div>
            <div class="landing-orb landing-orb-two" aria-hidden="true"></div>
            <div class="landing-container landing-hero-grid">
                <div class="landing-hero-copy">
                    <p class="landing-kicker">Clase Práctica 5 · UBE · 2026</p>
                    <h1>Gestión clara para <em>equipos que avanzan.</em></h1>
                    <p class="landing-lead">Un sistema web donde proyectos, tareas y permisos conviven en un mismo flujo. Cada integrante encuentra exactamente lo que necesita para convertir el trabajo del equipo en resultados visibles.</p>
                    <div class="landing-actions">
                        <a class="landing-button landing-button-primary" href="{{ auth()->check() ? route('dashboard') : route('login') }}">
                            {{ auth()->check() ? 'Abrir mi panel' : 'Explorar el sistema' }} <span aria-hidden="true">↗</span>
                        </a>
                        <a class="landing-button landing-button-ghost" href="#sistema">Conocer el proyecto <span aria-hidden="true">↓</span></a>
                    </div>
                    <div class="landing-hero-meta" aria-label="Tecnologías principales">
                        <span>Laravel 13</span><span>Bootstrap 5</span><span>PHP 8.4</span><span>JavaScript</span>
                    </div>
                </div>

                <div class="product-window" aria-label="Vista resumida del sistema">
                    <div class="product-window-bar">
                        <span class="product-window-brand"><b>P5</b> Resumen del equipo</span>
                        <span class="product-window-status"><i></i> Operativo</span>
                    </div>
                    <div class="product-window-body">
                        <div class="product-welcome">
                            <div><small>PANEL DE TRABAJO</small><strong>Todo bajo control.</strong></div>
                            <span>Esta semana</span>
                        </div>
                        <div class="product-stats">
                            <article><span>Proyectos</span><strong>01</strong><small>Equipo activo</small></article>
                            <article><span>Tareas</span><strong>02</strong><small>Seguimiento real</small></article>
                            <article class="is-accent"><span>Avance</span><strong>50%</strong><small>En progreso</small></article>
                        </div>
                        <div class="product-activity">
                            <div class="product-activity-title"><strong>Actividad reciente</strong><span>Estado</span></div>
                            <div class="product-task"><i class="task-dot task-dot-purple"></i><span><b>Diseñar panel principal</b><small>Portal académico UBE</small></span><em>En proceso</em></div>
                            <div class="product-task"><i class="task-dot task-dot-green"></i><span><b>Validar permisos por rol</b><small>Control de accesos</small></span><em class="is-done">Revisado</em></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="landing-proof" aria-label="Características principales">
            <div class="landing-container proof-grid">
                <div><strong>03</strong><span>roles conectados</span></div>
                <div><strong>100%</strong><span>experiencia responsive</span></div>
                <div><strong>01</strong><span>flujo de trabajo seguro</span></div>
                <p>Arquitectura preparada para organizar, supervisar y entregar.</p>
            </div>
        </section>

        <section class="landing-section system-section" id="sistema">
            <div class="landing-container">
                <div class="section-intro split-intro">
                    <div><p class="landing-kicker landing-kicker-purple">DEL PROYECTO A LA ENTREGA</p><h2>Un flujo simple.<br><em>Responsabilidades claras.</em></h2></div>
                    <p>La plataforma reúne las decisiones importantes del equipo sin mezclar permisos. Cada acción conserva el contexto del proyecto y respeta el alcance de cada usuario.</p>
                </div>

                <div class="workflow-grid">
                    <article class="workflow-card">
                        <span class="workflow-number">01</span>
                        <div class="workflow-icon" aria-hidden="true">◇</div>
                        <h3>Organiza el proyecto</h3>
                        <p>Define responsables, incorpora miembros y concentra la información esencial en un solo espacio.</p>
                        <small>ESTRUCTURA</small>
                    </article>
                    <article class="workflow-card workflow-card-featured">
                        <span class="workflow-number">02</span>
                        <div class="workflow-icon" aria-hidden="true">✓</div>
                        <h3>Asigna y acompaña</h3>
                        <p>Convierte objetivos en tareas concretas, establece responsables y sigue cada cambio de estado.</p>
                        <small>SEGUIMIENTO</small>
                    </article>
                    <article class="workflow-card">
                        <span class="workflow-number">03</span>
                        <div class="workflow-icon" aria-hidden="true">↗</div>
                        <h3>Visualiza el avance</h3>
                        <p>Consulta indicadores, actividad reciente y resultados visibles según el rol que desempeñas.</p>
                        <small>RESULTADOS</small>
                    </article>
                </div>
            </div>
        </section>

        <section class="landing-section roles-section" id="roles">
            <div class="landing-container roles-layout">
                <div class="roles-copy">
                    <p class="landing-kicker">PERMISOS CON PROPÓSITO</p>
                    <h2>Cada rol ve lo necesario. <em>Nada más, nada menos.</em></h2>
                    <p>El sistema aplica autorización en cada operación para proteger la información y mantener el trabajo distribuido con claridad.</p>
                    <a class="text-link" href="{{ auth()->check() ? route('dashboard') : route('login') }}">Ver la experiencia completa <span aria-hidden="true">→</span></a>
                </div>
                <div class="role-stack">
                    <article class="role-row">
                        <span class="role-index">01</span>
                        <div><h3>Administrador</h3><p>Configura usuarios, roles y proyectos; supervisa el estado general del sistema.</p></div>
                        <span class="role-tag">Control global</span>
                    </article>
                    <article class="role-row">
                        <span class="role-index">02</span>
                        <div><h3>Gerente de proyecto</h3><p>Coordina integrantes, crea tareas y conduce el avance de los proyectos asignados.</p></div>
                        <span class="role-tag">Coordinación</span>
                    </article>
                    <article class="role-row">
                        <span class="role-index">03</span>
                        <div><h3>Miembro del equipo</h3><p>Consulta sus tareas, actualiza estados y mantiene visible su progreso.</p></div>
                        <span class="role-tag">Ejecución</span>
                    </article>
                </div>
            </div>
        </section>

        <section class="landing-cta">
            <div class="landing-container landing-cta-inner">
                <div><p class="landing-kicker">EL TRABAJO EMPIEZA AQUÍ</p><h2>Convierte la organización<br>en <em>avance real.</em></h2></div>
                <a class="landing-button landing-button-light" href="{{ auth()->check() ? route('dashboard') : route('login') }}">
                    {{ auth()->check() ? 'Continuar al panel' : 'Ingresar al sistema' }} <span aria-hidden="true">→</span>
                </a>
            </div>
        </section>
    </main>

    <footer class="landing-footer">
        <div class="landing-container landing-footer-inner">
            <a class="landing-brand landing-brand-footer" href="#inicio"><span class="landing-brand-mark">P5</span><span><strong>Gestión de Tareas</strong><small>Clase Práctica 5</small></span></a>
            <p>Universidad Bolivariana del Ecuador<br>Programación Web Avanzada · 2026</p>
            <div><a href="#sistema">Sistema</a><a href="#roles">Roles</a><a href="{{ route('team') }}">Equipo</a></div>
        </div>
    </footer>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
