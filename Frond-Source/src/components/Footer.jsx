export default function Footer() {
  return (
    <footer className="site-footer">
      <div className="container footer-inner">
        <div className="footer-brand">
          <a href="/bpanel">
          <img src="/logo-full.png" alt="Mobatech Holland B.V." />
          </a>
        </div>
        <div className="footer-text">
          <strong>Mobatech Holland B.V.</strong>
          <span>Houtbewerkingsmachines, onderhoud & montage</span>
          <small>© {new Date().getFullYear()} Mobatech Holland B.V. Alle rechten voorbehouden.</small>
        </div>
      </div>
    </footer>
  )
}
