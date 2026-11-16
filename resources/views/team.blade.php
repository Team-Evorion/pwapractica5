<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Equipo de estudiantes responsable del Sistema de Gestión de Tareas de la Clase Práctica 5.">
    <title>Equipo · PWA Práctica 5</title>
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/team.css') }}" rel="stylesheet">
    <script src="{{ asset('js/public-pages.js') }}" defer></script>
</head>
<body class="team-page">
    <header class="team-header">
        <nav class="team-nav" aria-label="Navegación principal">
            <a class="team-brand" href="{{ route('home') }}" aria-label="Práctica 5, inicio"><span class="team-brand-mark">P5</span><span><strong>Gestión de Tareas</strong><small>Programación Web Avanzada</small></span></a>
            <div class="team-nav-links"><a href="{{ route('home') }}#sistema">Sistema</a><a href="{{ route('roles') }}">Roles</a><a class="active" href="{{ route('team') }}" aria-current="page">Equipo</a></div>
            <a class="team-access" href="{{ auth()->check() ? route('dashboard') : route('login') }}">{{ auth()->check() ? 'Ir al panel' : 'Iniciar sesión' }} <span aria-hidden="true">→</span></a>
        </nav>
    </header>

    <main>
        <section class="team-hero">
            <div class="team-noise" aria-hidden="true"></div>
            <div class="team-shell team-hero-grid">
                <div class="team-hero-copy" data-reveal>
                    <p class="team-kicker">EQUIPO · CLASE PRÁCTICA 5</p>
                    <h1>Seis miradas.<br><em>Un solo proyecto.</em></h1>
                    <p class="team-lead">Una solución académica construida de forma colaborativa, donde cada aporte ayuda a convertir una idea en una experiencia funcional.</p>
                    <a class="team-hero-link" href="#integrantes">Descubrir al equipo <span aria-hidden="true">↘</span></a>
                </div>
                <div class="team-collage" data-reveal data-reveal-delay="1" aria-label="Composición con los seis integrantes">
                    <span class="team-collage-word" aria-hidden="true">EQUIPO</span>
                    <div class="team-chip team-chip-1"><small>01</small><strong>JF</strong></div><div class="team-chip team-chip-2"><small>02</small><strong>JM</strong></div><div class="team-chip team-chip-3"><small>03</small><strong>JR</strong></div>
                    <div class="team-chip team-chip-4"><small>04</small><strong>TP</strong></div><div class="team-chip team-chip-5"><small>05</small><strong>EV</strong></div><div class="team-chip team-chip-6"><small>06</small><strong>ZZ</strong></div>
                    <div class="team-collage-core"><strong>06</strong><span>INTEGRANTES</span></div>
                </div>
            </div>
            <div class="team-shell team-hero-meta" data-reveal><span>Universidad Bolivariana del Ecuador</span><span>Programación Web Avanzada</span><span>2026</span></div>
        </section>

        <div class="team-ticker" aria-hidden="true"><div>DISEÑO <i>✦</i> DESARROLLO <i>✦</i> COLABORACIÓN <i>✦</i> VERIFICACIÓN <i>✦</i> DISEÑO <i>✦</i> DESARROLLO <i>✦</i> COLABORACIÓN <i>✦</i> VERIFICACIÓN <i>✦</i></div></div>

        <section class="team-roster" id="integrantes">
            <div class="team-shell">
                <div class="team-roster-heading" data-reveal><div><p class="team-kicker team-kicker-warm">LAS PERSONAS DETRÁS DEL PROYECTO</p><h2>Una idea compartida,<br><em>seis aportes reales.</em></h2></div><p>La identidad del proyecto nace de un trabajo conjunto: organizar, construir, revisar y mejorar hasta que cada pieza encuentre su lugar.</p></div>
                <div class="team-roster-grid">
                    <article class="team-member" data-reveal><span class="team-member-number">01</span><span class="team-member-avatar">JF</span><div><h3>Jesús Rafael Fernández Pérez</h3><p>Integrante del proyecto</p></div></article>
                    <article class="team-member" data-reveal data-reveal-delay="1"><span class="team-member-number">02</span><span class="team-member-avatar">JM</span><div><h3>José Andrés Merlin Gamboa</h3><p>Integrante del proyecto</p></div></article>
                    <article class="team-member" data-reveal><span class="team-member-number">03</span><span class="team-member-avatar">JR</span><div><h3>José Alberto Rosado Domínguez</h3><p>Integrante del proyecto</p></div></article>
                    <article class="team-member" data-reveal data-reveal-delay="1"><span class="team-member-number">04</span><span class="team-member-avatar">TP</span><div><h3>Terry Steven Ponce Farías</h3><p>Integrante del proyecto</p></div></article>
                    <article class="team-member" data-reveal><span class="team-member-number">05</span><span class="team-member-avatar">EV</span><div><h3>Elkin Daniel Velastegui Zambrano</h3><p>Integrante del proyecto</p></div></article>
                    <article class="team-member" data-reveal data-reveal-delay="1"><span class="team-member-number">06</span><span class="team-member-avatar">ZZ</span><div><h3>Zahid Joel Zambrano Moreira</h3><p>Integrante del proyecto</p></div></article>
                </div>
            </div>
        </section>

        <section class="team-method"><div class="team-shell team-method-grid"><div class="team-method-title" data-reveal><p class="team-kicker">NUESTRA FORMA DE AVANZAR</p><h2>El trabajo se vuelve visible cuando <em>todos empujan.</em></h2></div><div class="team-method-steps" data-reveal data-reveal-delay="1"><article><span>01</span><div><h3>Ordenar</h3><p>Definimos objetivos, proyectos y tareas con un propósito claro.</p></div></article><article><span>02</span><div><h3>Construir</h3><p>Convertimos responsabilidades individuales en progreso compartido.</p></div></article><article><span>03</span><div><h3>Comprobar</h3><p>Revisamos permisos, flujos y resultados antes de la entrega.</p></div></article></div></div></section>

        <section class="team-closing"><div class="team-shell team-closing-inner"><div data-reveal><p class="team-kicker">EL RESULTADO</p><h2>Hecho en equipo.<br><em>Listo para usarse.</em></h2></div><div data-reveal data-reveal-delay="1"><p>Explora el sistema y descubre cómo las personas, los proyectos y las tareas se conectan en una misma experiencia.</p><a href="{{ route('home') }}">Volver al proyecto <span aria-hidden="true">→</span></a></div></div></section>
    </main>

    <footer class="team-footer"><div class="team-shell team-footer-inner"><a class="team-brand" href="{{ route('home') }}"><span class="team-brand-mark">P5</span><span><strong>Gestión de Tareas</strong><small>Clase Práctica 5</small></span></a><p>Universidad Bolivariana del Ecuador · 2026</p></div></footer>
</body>
</html>
