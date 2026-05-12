export default function Hero() {
  return (
    <section id="home" className="hero">
      <div className="hero-overlay" />
      <div className="hero-content">
        <div className="hero-panel">
          <p className="hero-kicker">Vanuit Heesch · actief in heel Nederland</p>
          <h1 className="hero-title">
            <span className="hero-title-desktop">Houtbewerkingsmachines,</span>
            <span className="hero-title-mobile">
              <span>Houtbewerkings-</span>
              <span>machines,</span>
            </span>
            <span className="hero-title-second">onderhoud <strong>&amp;</strong> montage</span>
          </h1>
          <p className="hero-text">
            Mobatech Holland B.V. is specialist in nieuwe en gebruikte houtbewerkingsmachines, onderhoud, storingsdienst, machinekeuringen en complete werkplaatsoplossingen voor professionele houtbewerkers.
          </p>
          <div className="hero-actions">
            <a href="#diensten" className="btn btn-primary">Bekijk onze diensten <span>→</span></a>
            <a href="#contact" className="btn btn-outline">Neem contact op</a>
            <a href="/#vacatures" className="btn btn-outline hero-job-btn">Werken voor Mobatech</a>
          </div>
        </div>
      </div>
    </section>
  )
}
