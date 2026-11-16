<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Equipo de estudiantes responsable del Sistema de Gestión de Tareas de la Clase Práctica 5.">
    <title>Equipo · PWA Práctica 5</title>
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/landing.css') }}" rel="stylesheet">
    <link href="{{ asset('css/team.css') }}" rel="stylesheet">
</head>
<body class="team-page-public">
    <header class="team-header">
        <nav class="team-nav" aria-label="Navegación principal">
            <a class="landing-brand" href="{{ route('home') }}" aria-label="Práctica 5, inicio">
                <span class="landing-brand-mark">P5</span>
                <span><strong>Gestión de Tareas</strong><small>Programación Web Avanzada</small></span>
            </a>

            <div class="team-nav-links">
                <a href="{{ route('home') }}#sistema">Sistema</a>
                <a href="{{ route('home') }}#roles">Roles</a>
                <a class="active" href="{{ route('team') }}" aria-current="page">Equipo</a>
            </div>

            <a class="team-access" href="{{ auth()->check() ? route('dashboard') : route('login') }}">
                {{ auth()->check() ? 'Ir al panel' : 'Iniciar sesión' }} <span aria-hidden="true">→</span>
            </a>
        </nav>
    </header>

    <main>
        <section class="team-intro">
            <div class="team-intro-glow" aria-hidden="true"></div>
            <div class="team-shell team-intro-grid">
                <div class="team-title-block">
                    <p class="team-eyebrow">EQUIPO · CLASE PRÁCTICA 5</p>
                    <h1>Seis personas.<br><em>Una misma dirección.</em></h1>
                </div>
                <div class="team-intro-copy">
                    <span class="team-rule" aria-hidden="true"></span>
                    <p>Un equipo de estudiantes construyendo una experiencia de gestión completa: desde la arquitectura y los permisos hasta la interfaz que conecta cada tarea con su responsable.</p>
                    <a href="#integrantes">Conocer integrantes <span aria-hidden="true">↓</span></a>
                </div>
            </div>
            <div class="team-shell team-intro-meta">
                <span>Universidad Bolivariana del Ecuador</span>
                <span>Programación Web Avanzada</span>
                <span>2026</span>
            </div>
        </section>

        <section class="team-roster" id="integrantes">
            <div class="team-shell">
                <div class="team-roster-heading">
                    <div>
                        <p class="team-eyebrow team-eyebrow-purple">QUIÉNES LO HICIERON POSIBLE</p>
                        <h2>Integrantes del proyecto</h2>
                    </div>
                    <div class="team-total" aria-label="Seis integrantes"><strong>06</strong><span>PERSONAS</span></div>
                    <p>Cada integrante forma parte del desarrollo colaborativo de esta solución académica.</p>
                </div>

                <div class="team-roster-grid">
                    <article class="team-member">
                        <span class="team-member-number">01</span>
                        <span class="team-member-avatar">JF</span>
                        <div><h3>Jesús Rafael Fernández Pérez</h3><p>Integrante del proyecto</p></div>
                    </article>
                    <article class="team-member">
                        <span class="team-member-number">02</span>
                        <span class="team-member-avatar">JM</span>
                        <div><h3>José Andrés Merlin Gamboa</h3><p>Integrante del proyecto</p></div>
                    </article>
                    <article class="team-member">
                        <span class="team-member-number">03</span>
                        <span class="team-member-avatar">JR</span>
                        <div><h3>José Alberto Rosado Domínguez</h3><p>Integrante del proyecto</p></div>
                    </article>
                    <article class="team-member">
                        <span class="team-member-number">04</span>
                        <span class="team-member-avatar">TP</span>
                        <div><h3>Terry Steven Ponce Farías</h3><p>Integrante del proyecto</p></div>
                    </article>
                    <article class="team-member">
                        <span class="team-member-number">05</span>
                        <span class="team-member-avatar">EV</span>
                        <div><h3>Elkin Daniel Velastegui Zambrano</h3><p>Integrante del proyecto</p></div>
                    </article>
                    <article class="team-member">
                        <span class="team-member-number">06</span>
                        <span class="team-member-avatar">ZZ</span>
                        <div><h3>Zahid Joel Zambrano Moreira</h3><p>Integrante del proyecto</p></div>
                    </article>
                </div>
            </div>
        </section>

        <section class="team-principles">
            <div class="team-shell team-principles-grid">
                <div>
                    <p class="team-eyebrow">NUESTRA FORMA DE TRABAJAR</p>
                    <h2>Construir en equipo también es <em>hacer visible el proceso.</em></h2>
                </div>
                <ol>
                    <li><span>01</span><div><strong>Organización</strong><p>Objetivos, proyectos y tareas con un lugar definido.</p></div></li>
                    <li><span>02</span><div><strong>Colaboración</strong><p>Responsabilidades distribuidas y avance compartido.</p></div></li>
                    <li><span>03</span><div><strong>Verificación</strong><p>Permisos y flujos revisados antes de cada entrega.</p></div></li>
                </ol>
            </div>
        </section>

        <section class="team-closing">
            <div class="team-shell team-closing-inner">
                <div><p class="team-eyebrow team-eyebrow-purple">CONOCE EL RESULTADO</p><h2>Un sistema creado<br>como <em>equipo.</em></h2></div>
                <div>
                    <p>Explora la propuesta completa y descubre cómo cada rol participa en el trabajo.</p>
                    <a class="team-closing-button" href="{{ route('home') }}">Volver al proyecto <span aria-hidden="true">→</span></a>
                </div>
            </div>
        </section>
    </main>

    <footer class="team-footer">
        <div class="team-shell team-footer-inner">
            <a class="landing-brand" href="{{ route('home') }}"><span class="landing-brand-mark">P5</span><span><strong>Gestión de Tareas</strong><small>Clase Práctica 5</small></span></a>
            <p>Universidad Bolivariana del Ecuador · Programación Web Avanzada · 2026</p>
        </div>
    </footer>
</body>
</html>
