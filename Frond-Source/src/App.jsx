import { useEffect, useState } from 'react'
import Header from './components/Header.jsx'
import Hero from './components/Hero.jsx'
import Sections from './components/Sections.jsx'
import Vacatures from './pages/Vacatures.jsx'
import Footer from './components/Footer.jsx'

function getRoute() {
  if (typeof window === 'undefined') return { page: 'home', target: '' }

  const path = window.location.pathname
  const hash = window.location.hash ? window.location.hash.replace('#', '') : ''

  // Supports both /vacatures and hash route /#vacatures.
  // Hash routing works on every static Linux hosting setup without extra rewrite rules.
  if (path.startsWith('/vacatures') || hash === 'vacatures' || hash.startsWith('vacature-')) {
    return { page: 'vacatures', target: hash.startsWith('vacature-') ? hash : '' }
  }

  return { page: 'home', target: hash }
}

export default function App() {
  const [route, setRoute] = useState(getRoute())

  useEffect(() => {
    const update = () => setRoute(getRoute())
    window.addEventListener('popstate', update)
    window.addEventListener('hashchange', update)
    return () => {
      window.removeEventListener('popstate', update)
      window.removeEventListener('hashchange', update)
    }
  }, [])

  useEffect(() => {
    if (!route.target) return
    const timer = setTimeout(() => {
      document.getElementById(route.target)?.scrollIntoView({ behavior: 'smooth', block: 'start' })
    }, 120)
    return () => clearTimeout(timer)
  }, [route])

  const isVacatures = route.page === 'vacatures'

  return (
    <div className="site-shell">
      <Header currentPage={isVacatures ? 'vacatures' : 'home'} />
      <main>
        {isVacatures ? (
          <Vacatures />
        ) : (
          <>
            <Hero />
            <Sections />
          </>
        )}
      </main>
      <Footer />
    </div>
  )
}
