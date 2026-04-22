<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>RioNero | Asesoría y Acompañamiento para Vivienda</title>
  <meta name="description" content="RioNero entrega asesoría y acompañamiento para construcción, ampliación de viviendas y gestión de subsidios SERVIU." />
  <style>
    :root {
      --primary: #0f172a;
      --secondary: #1e293b;
      --accent: #2563eb;
      --accent-2: #38bdf8;
      --light: #f8fafc;
      --muted: #64748b;
      --white: #ffffff;
      --border: #e2e8f0;
      --success: #16a34a;
      --shadow: 0 20px 40px rgba(15, 23, 42, 0.12);
      --max: 1180px;
    }

    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    html {
      scroll-behavior: smooth;
    }

    body {
      font-family: Arial, Helvetica, sans-serif;
      background: var(--light);
      color: var(--primary);
      line-height: 1.6;
    }

    a {
      text-decoration: none;
      color: inherit;
    }

    img {
      max-width: 100%;
      display: block;
    }

    .container {
      width: min(92%, var(--max));
      margin: 0 auto;
    }

    .topbar {
      background: rgba(255,255,255,0.9);
      backdrop-filter: blur(10px);
      border-bottom: 1px solid rgba(226,232,240,0.8);
      position: sticky;
      top: 0;
      z-index: 1000;
    }

    .nav {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 18px 0;
      gap: 24px;
    }

    .brand {
      display: flex;
      align-items: center;
      gap: 12px;
      font-weight: 800;
      font-size: 1.35rem;
      letter-spacing: 0.3px;
    }

    .brand-mark {
      width: 42px;
      height: 42px;
      border-radius: 14px;
      background: linear-gradient(135deg, var(--accent), var(--primary));
      color: var(--white);
      display: grid;
      place-items: center;
      box-shadow: var(--shadow);
      font-weight: 800;
    }

    .nav-links {
      display: flex;
      gap: 28px;
      color: var(--secondary);
      font-weight: 600;
      flex-wrap: wrap;
    }

    .nav-links a:hover {
      color: var(--accent);
    }

    .btn {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      padding: 14px 22px;
      border-radius: 999px;
      font-weight: 700;
      transition: 0.25s ease;
      border: 2px solid transparent;
      cursor: pointer;
    }

    .btn-primary {
      background: linear-gradient(135deg, var(--accent), var(--accent-2));
      color: var(--white);
      box-shadow: var(--shadow);
    }

    .btn-primary:hover {
      transform: translateY(-2px);
      filter: brightness(1.02);
    }

    .btn-outline {
      border-color: var(--accent);
      color: var(--accent);
      background: transparent;
    }

    .btn-outline:hover {
      background: rgba(37, 99, 235, 0.08);
    }

    .hero {
      padding: 72px 0 56px;
      background:
        radial-gradient(circle at top left, rgba(56,189,248,0.18), transparent 36%),
        radial-gradient(circle at right, rgba(37,99,235,0.15), transparent 28%),
        linear-gradient(180deg, #ffffff 0%, #f8fafc 100%);
    }

    .hero-grid {
      display: grid;
      grid-template-columns: 1.1fr 0.9fr;
      gap: 42px;
      align-items: center;
    }

    .badge {
      display: inline-flex;
      align-items: center;
      gap: 10px;
      background: rgba(37,99,235,0.1);
      color: var(--accent);
      border: 1px solid rgba(37,99,235,0.18);
      padding: 10px 16px;
      border-radius: 999px;
      font-size: 0.95rem;
      font-weight: 700;
      margin-bottom: 18px;
    }

    .hero h1 {
      font-size: clamp(2.2rem, 5vw, 4.4rem);
      line-height: 1.05;
      margin-bottom: 18px;
      letter-spacing: -1px;
    }

    .hero p {
      font-size: 1.08rem;
      color: var(--muted);
      max-width: 700px;
      margin-bottom: 28px;
    }

    .hero-actions {
      display: flex;
      flex-wrap: wrap;
      gap: 14px;
      margin-bottom: 26px;
    }

    .hero-stats {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 16px;
    }

    .stat {
      background: var(--white);
      border: 1px solid var(--border);
      border-radius: 18px;
      padding: 18px;
      box-shadow: 0 10px 25px rgba(15,23,42,0.05);
    }

    .stat strong {
      display: block;
      font-size: 1.4rem;
      margin-bottom: 4px;
    }

    .hero-card {
      background: var(--white);
      border: 1px solid var(--border);
      border-radius: 28px;
      padding: 28px;
      box-shadow: var(--shadow);
      position: relative;
      overflow: hidden;
    }

    .hero-card::before {
      content: "";
      position: absolute;
      inset: 0;
      background: linear-gradient(135deg, rgba(37,99,235,0.08), rgba(56,189,248,0.06));
      pointer-events: none;
    }

    .mini-panel {
      position: relative;
      background: rgba(255,255,255,0.92);
      border: 1px solid var(--border);
      border-radius: 20px;
      padding: 20px;
      margin-bottom: 16px;
    }

    .mini-panel h3 {
      margin-bottom: 10px;
      font-size: 1.1rem;
    }

    .mini-panel ul {
      list-style: none;
      display: grid;
      gap: 10px;
      color: var(--secondary);
    }

    .mini-panel li::before {
      content: "✓";
      color: var(--success);
      font-weight: 800;
      margin-right: 10px;
    }

    section {
      padding: 72px 0;
    }

    .section-header {
      text-align: center;
      max-width: 780px;
      margin: 0 auto 42px;
    }

    .section-header span {
      color: var(--accent);
      font-weight: 800;
      text-transform: uppercase;
      letter-spacing: 1.4px;
      font-size: 0.85rem;
    }

    .section-header h2 {
      font-size: clamp(1.8rem, 4vw, 3rem);
      line-height: 1.1;
      margin: 10px 0 14px;
    }

    .section-header p {
      color: var(--muted);
      font-size: 1.05rem;
    }

    .cards-3 {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 22px;
    }

    .card {
      background: var(--white);
      border: 1px solid var(--border);
      border-radius: 22px;
      padding: 28px;
      box-shadow: 0 12px 28px rgba(15,23,42,0.05);
    }

    .icon {
      width: 58px;
      height: 58px;
      border-radius: 16px;
      display: grid;
      place-items: center;
      font-size: 1.5rem;
      margin-bottom: 18px;
      background: linear-gradient(135deg, rgba(37,99,235,0.12), rgba(56,189,248,0.18));
      color: var(--accent);
      font-weight: 800;
    }

    .card h3 {
      font-size: 1.2rem;
      margin-bottom: 10px;
    }

    .card p {
      color: var(--muted);
    }

    .steps {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 20px;
    }

    .step {
      position: relative;
      background: var(--white);
      border: 1px solid var(--border);
      border-radius: 22px;
      padding: 26px;
      box-shadow: 0 12px 28px rgba(15,23,42,0.04);
    }

    .step-number {
      width: 44px;
      height: 44px;
      border-radius: 999px;
      display: grid;
      place-items: center;
      background: var(--primary);
      color: var(--white);
      font-weight: 800;
      margin-bottom: 16px;
    }

    .step p {
      color: var(--muted);
    }

    .about {
      display: grid;
      grid-template-columns: 0.95fr 1.05fr;
      gap: 28px;
      align-items: center;
    }

    .about-box {
      background: linear-gradient(135deg, var(--primary), var(--secondary));
      color: var(--white);
      border-radius: 28px;
      padding: 34px;
      box-shadow: var(--shadow);
      min-height: 360px;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .about-box h3 {
      font-size: 2rem;
      margin-bottom: 14px;
    }

    .about-box p {
      color: rgba(255,255,255,0.82);
      margin-bottom: 16px;
    }

    .check-grid {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 16px;
    }

    .check-item {
      background: var(--white);
      border: 1px solid var(--border);
      border-radius: 18px;
      padding: 18px;
    }

    .check-item strong {
      display: block;
      margin-bottom: 8px;
    }

    .check-item p {
      color: var(--muted);
      font-size: 0.97rem;
    }

    .cta {
      background: linear-gradient(135deg, var(--primary), #0b2447);
      color: var(--white);
      border-radius: 30px;
      padding: 42px;
      display: flex;
      justify-content: space-between;
      gap: 24px;
      align-items: center;
      box-shadow: var(--shadow);
    }

    .cta p {
      color: rgba(255,255,255,0.82);
      max-width: 700px;
      margin-top: 10px;
    }

    footer {
      padding: 28px 0 40px;
      color: var(--muted);
      font-size: 0.95rem;
    }

    .footer-box {
      display: flex;
      justify-content: space-between;
      gap: 16px;
      border-top: 1px solid var(--border);
      padding-top: 24px;
      flex-wrap: wrap;
    }

    @media (max-width: 1100px) {
      .hero-grid,
      .about,
      .cards-3,
      .steps {
        grid-template-columns: 1fr 1fr;
      }

      .cards-3 .card:last-child,
      .steps .step:last-child {
        grid-column: span 2;
      }
    }

    @media (max-width: 780px) {
      .nav {
        flex-direction: column;
        align-items: flex-start;
      }

      .hero-grid,
      .about,
      .cards-3,
      .steps,
      .hero-stats,
      .check-grid,
      .cta {
        grid-template-columns: 1fr;
        display: grid;
      }

      .cards-3 .card:last-child,
      .steps .step:last-child {
        grid-column: span 1;
      }

      .cta {
        padding: 30px;
      }

      .nav-links {
        gap: 14px;
      }

      .hero {
        padding-top: 46px;
      }
    }
  </style>
</head>
<body>
  <header class="topbar">
    <div class="container nav">
      <a href="http://127.0.0.1:8000/login" class="brand">
        <span class="brand-mark">RN</span>
        <span>RioNero</span>
      </a>

      <nav class="nav-links">
        <a href="#servicios">Servicios</a>
        <a href="#proceso">Proceso</a>
        <a href="#nosotros">Nosotros</a>
        <a href="#contacto">Contacto</a>
      </nav>

      <a href="/login" class="btn btn-primary">Ingresar</a>
    </div>
  </header>

  <main>
    <section class="hero" id="inicio">
      <div class="container hero-grid">
        <div>
          <div class="badge">Asesoría integral para tu vivienda</div>
          <h1>Construimos tu proyecto habitacional con respaldo técnico y gestión de subsidios SERVIU.</h1>
          <p>
            En <strong>RioNero</strong> acompañamos a familias y propietarios en la construcción,
            ampliación y regularización de viviendas, gestionando el proceso técnico y administrativo
            para acceder a los subsidios disponibles a través de SERVIU.
          </p>

          <div class="hero-actions">
            <a href="#contacto" class="btn btn-primary">Quiero asesoría</a>
            <a href="#servicios" class="btn btn-outline">Ver servicios</a>
          </div>

          <div class="hero-stats">
            <div class="stat">
              <strong>100%</strong>
              <span>Acompañamiento personalizado</span>
            </div>
            <div class="stat">
              <strong>SERVIU</strong>
              <span>Gestión de subsidios y trámites</span>
            </div>
            <div class="stat">
              <strong>Inicio a fin</strong>
              <span>Asesoría técnica y documental</span>
            </div>
          </div>
        </div>

        <div class="hero-card">
          <div class="mini-panel">
            <h3>¿En qué te ayudamos?</h3>
            <ul>
              <li>Construcción de viviendas nuevas</li>
              <li>Ampliaciones y mejoras habitacionales</li>
              <li>Postulación y seguimiento de subsidios</li>
              <li>Coordinación técnica y documental</li>
            </ul>
          </div>

          <div class="mini-panel">
            <h3>Tu proyecto con acompañamiento real</h3>
            <p>
              Evaluamos la factibilidad de tu caso, ordenamos antecedentes,
              guiamos la tramitación y te acompañamos durante cada etapa para avanzar con seguridad.
            </p>
          </div>
        </div>
      </div>
    </section>

    <section id="servicios">
      <div class="container">
        <div class="section-header">
          <span>Servicios</span>
          <h2>Soluciones para construir, ampliar y gestionar tu vivienda</h2>
          <p>
            Integramos asesoría técnica, revisión documental y acompañamiento administrativo para que tu proyecto avance con orden y claridad.
          </p>
        </div>

        <div class="cards-3">
          <article class="card">
            <div class="icon">🏠</div>
            <h3>Construcción de viviendas</h3>
            <p>
              Apoyamos proyectos de vivienda desde la evaluación inicial hasta la coordinación de etapas necesarias para su ejecución.
            </p>
          </article>

          <article class="card">
            <div class="icon">📐</div>
            <h3>Ampliaciones y mejoras</h3>
            <p>
              Asesoramos ampliaciones habitacionales, mejoras de espacios y revisión de antecedentes para dar viabilidad al proyecto.
            </p>
          </article>

          <article class="card">
            <div class="icon">📄</div>
            <h3>Gestión de subsidios SERVIU</h3>
            <p>
              Orientamos la postulación, recopilación de documentos y seguimiento del proceso asociado a subsidios disponibles del Estado.
            </p>
          </article>
        </div>
      </div>
    </section>

    <section id="proceso">
      <div class="container">
        <div class="section-header">
          <span>Proceso</span>
          <h2>Así trabajamos contigo</h2>
          <p>
            Un proceso claro, cercano y ordenado para que sepas qué se necesita y en qué etapa se encuentra tu proyecto.
          </p>
        </div>

        <div class="steps">
          <article class="step">
            <div class="step-number">1</div>
            <h3>Evaluación inicial</h3>
            <p>Revisamos tu necesidad, situación de la vivienda y factibilidad de postulación o ejecución del proyecto.</p>
          </article>

          <article class="step">
            <div class="step-number">2</div>
            <h3>Recolección de antecedentes</h3>
            <p>Ordenamos documentos, requisitos técnicos y antecedentes necesarios para avanzar correctamente.</p>
          </article>

          <article class="step">
            <div class="step-number">3</div>
            <h3>Gestión y acompañamiento</h3>
            <p>Realizamos el acompañamiento durante la tramitación y el seguimiento de subsidios o etapas del proyecto.</p>
          </article>

          <article class="step">
            <div class="step-number">4</div>
            <h3>Avance del proyecto</h3>
            <p>Te mantenemos informado y coordinamos los pasos siguientes para que el proyecto continúe de forma ordenada.</p>
          </article>
        </div>
      </div>
    </section>

    <section id="nosotros">
      <div class="container about">
        <div class="about-box">
          <h3>RioNero</h3>
          <p>
            Somos una empresa enfocada en la asesoría y acompañamiento para proyectos habitacionales,
            con una mirada práctica, cercana y orientada a facilitar el acceso a soluciones reales para las familias.
          </p>
          <p>
            Nuestro objetivo es ayudarte a entender el proceso, reunir los antecedentes necesarios y avanzar con apoyo en cada etapa.
          </p>
          <a href="#contacto" class="btn btn-primary" style="width: fit-content;">Hablemos de tu proyecto</a>
        </div>

        <div class="check-grid">
          <article class="check-item">
            <strong>Asesoría cercana</strong>
            <p>Explicamos cada etapa en un lenguaje claro para que tomes decisiones con tranquilidad.</p>
          </article>

          <article class="check-item">
            <strong>Orientación documental</strong>
            <p>Te ayudamos a ordenar requisitos, antecedentes y documentación del proyecto.</p>
          </article>

          <article class="check-item">
            <strong>Enfoque en subsidios</strong>
            <p>Guiamos la revisión y gestión de opciones vinculadas a subsidios habitacionales SERVIU.</p>
          </article>

          <article class="check-item">
            <strong>Acompañamiento integral</strong>
            <p>Te apoyamos desde la evaluación inicial hasta el seguimiento del proceso correspondiente.</p>
          </article>
        </div>
      </div>
    </section>

    <section id="contacto">
      <div class="container">
        <div class="cta">
          <div>
            <h2>¿Quieres revisar tu caso y conocer tus opciones?</h2>
            <p>
              Cuéntanos tu proyecto de construcción o ampliación de vivienda y te ayudaremos a evaluar
              los pasos necesarios, los antecedentes a reunir y la ruta de gestión más adecuada.
            </p>
          </div>
          <div>
            <a href="mailto:contacto@rionero.cl" class="btn btn-primary">contacto@rionero.cl</a>
          </div>
        </div>
      </div>
    </section>
  </main>

  <footer>
    <div class="container footer-box">
      <p><strong>RioNero</strong> · Asesoría y acompañamiento para vivienda</p>
      <p>Construcción · Ampliación · Subsidios SERVIU</p>
    </div>
  </footer>
</body>
</html>
