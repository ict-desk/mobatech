import { useState } from 'react'

const navItems = [
  ['Home', '/#home'],
  ['Over ons', '/#over-ons'],
  ['Diensten', '/#diensten'],
  ['Machines', '/#machines'],
  ['Service', '/#service'],
  ['Keuringen', '/#keuringen'],
  ['Onderdelen', '/#onderdelen'],
]

export default function Header({ currentPage = 'home' }) {
  const [open, setOpen] = useState(false)
  const [contactOpen, setContactOpen] = useState(false)

  return (
    <header className="site-header">
      <div className="header-inner">
        <a href="/#home" className="brand" aria-label="Mobatech Holland home">
          <img src="/logo-header.png" alt="Mobatech Holland B.V." />
        </a>

        <nav className="desktop-nav" aria-label="Hoofdnavigatie">
          {navItems.map(([label, href]) => <a key={label} href={href}>{label}</a>)}
          <div className="nav-dropdown">
            <button className="nav-dropdown-button" type="button" onClick={() => setContactOpen(!contactOpen)} aria-expanded={contactOpen}>
              Contact <span>⌄</span>
            </button>
            {contactOpen && (
              <div className="nav-dropdown-menu">
                <a href="/#contact" onClick={() => setContactOpen(false)}>Contact</a>
                <a href="/#vacatures" onClick={() => setContactOpen(false)}>Vacatures</a>
              </div>
            )}
          </div>
        </nav>

        <a className="header-call" href="tel:+31412450425">Bel direct</a>

        <button className="menu-button" type="button" onClick={() => setOpen(!open)} aria-label="Menu openen/sluiten" aria-expanded={open}>
          <span />
          <span />
          <span />
        </button>
      </div>

      {open && (
        <nav className="mobile-nav" aria-label="Mobiele navigatie">
          {navItems.map(([label, href]) => (
            <a key={label} href={href} onClick={() => setOpen(false)}>{label}</a>
          ))}
          <a href="/#contact" onClick={() => setOpen(false)}>Contact</a>
          <a href="/#vacatures" onClick={() => setOpen(false)}>Vacatures</a>
          <a href="tel:+31412450425" className="mobile-call" onClick={() => setOpen(false)}>Bel direct</a>
        </nav>
      )}
    </header>
  )
}
