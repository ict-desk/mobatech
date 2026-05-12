import { useEffect } from 'react'

const vacatures = [
  {
    id: 'vacature-administrateur',
    label: 'Vacature',
    title: 'Administrateur / Financieel Administratief Medewerker m/v',
    meta: ['Locatie: Heesch', 'Parttime: 24–32 uur', 'Salaris: €2.900 – €3.400 bruto per maand o.b.v. fulltime'],
    intro: 'Ben jij een nauwkeurige en zelfstandig werkende administrateur met MKB-ervaring? Werk je graag in een praktisch en technisch bedrijf en zorg je ervoor dat de financiële administratie overzichtelijk en correct blijft? Dan zijn wij bij Mobatech Holland BV op zoek naar jou.',
    sections: [
      ['Wat ga je doen?', [
        'Het boeken van internationale en Nederlandse inkoop- en verkoopfacturen.',
        'Het verwerken van bankmutaties.',
        'Het beheren van de debiteuren- en crediteurenadministratie.',
        'Het verzorgen en controleren van facturatie.',
        'Het bijhouden van de contractadministratie.',
        'Het voorbereiden van administratieve gegevens voor accountant en jaarwerk.',
        'Diverse administratieve werkzaamheden met Exact Online.'
      ]],
      ['Wie zoeken wij?', [
        'MBO+ of HBO werk- en denkniveau in financiële richting.',
        'Minimaal 6 jaar ervaring in een vergelijkbare administratieve functie.',
        'Ervaring met financiële administratie en grootboek.',
        'Ervaring met Exact Online is een pré.',
        'Nauwkeurig, gestructureerd, zelfstandig en proactief.',
        'Bij voorkeur woonachtig in de regio Heesch, Oss, Uden, Veghel of Den Bosch.'
      ]],
      ['Wat bieden wij jou?', [
        'Een parttime functie van 24–32 uur per week.',
        'Een salaris van €2.900 – €3.400 bruto per maand o.b.v. fulltime.',
        'Een afwisselende administratieve functie.',
        'Een informele werksfeer met korte lijnen.',
        'Werken in een stabiel technisch bedrijf met meer dan 25 jaar ervaring.'
      ]]
    ],
    side: ['Heesch', '24–32 uur', '6+ jaar ervaring', 'Exact Online pré']
  },
  {
    id: 'vacature-allround-monteur',
    label: 'Vacature',
    title: 'Allround Monteur',
    meta: ['Locatie: Heesch', 'Landelijk / regionaal werkend', 'Dienstverband: Fulltime'],
    intro: 'Ben jij die monteur die het zat is om een nummer te zijn? Bij Mobatech Holland werk je in een klein en hecht team waar iedereen elkaar kent en waar jouw vakmanschap écht gewaardeerd wordt.',
    sections: [
      ['Wat ga je doen?', [
        'Onderhoud, reparaties en keuringen van houtbewerkingsmachines.',
        'Installeren en inbedrijfstellen van nieuwe én gebruikte machines.',
        'Het oplossen van storingen, zowel mechanisch als elektrisch.',
        'Meedenken met klanten en maatwerk leveren.',
        'Werken op locatie én in onze eigen werkplaats.'
      ]],
      ['Wat vragen we van jou?', [
        'Minimaal 5 tot 7 jaar ervaring als monteur in een technische omgeving.',
        'Opleiding richting werktuigbouwkunde, elektrotechniek of mechatronica.',
        'Brede technische kennis, mechanisch én elektrisch.',
        'Zelfstandigheid en oplossingsgericht denken.',
        'Rijbewijs B.',
        'Zin om onderdeel te worden van een leuk en klein team.'
      ]],
      ['Wat bieden wij jou?', [
        'Werken in een hecht en informeel team waar je geen nummer bent.',
        'Afwisselend werk: van onderhoud tot installatie en van storingen tot maatwerk.',
        'Vrijheid en verantwoordelijkheid: wij vertrouwen op jouw vakmanschap.',
        'Een goed uitgeruste bedrijfsbus en kwaliteitsgereedschap.',
        'Marktconform salaris en goede voorwaarden.',
        'Korte lijnen, directe waardering en een werkgever die echt naar je luistert.'
      ]]
    ],
    side: ['Heesch', 'Fulltime', '5–7 jaar ervaring', 'Rijbewijs B']
  }
]

function VacancyIcon() {
  return (
    <svg viewBox="0 0 24 24" aria-hidden="true">
      <path d="M10.8 2.4h2.4l.8 3.1c.6.2 1.1.4 1.6.7l2.8-1.6 1.7 1.7-1.6 2.8c.3.5.5 1 .7 1.6l3.1.8v2.4l-3.1.8c-.2.6-.4 1.1-.7 1.6l1.6 2.8-1.7 1.7-2.8-1.6c-.5.3-1 .5-1.6.7l-.8 3.1h-2.4l-.8-3.1c-.6-.2-1.1-.4-1.6-.7l-2.8 1.6-1.7-1.7 1.6-2.8c-.3-.5-.5-1-.7-1.6l-3.1-.8v-2.4l3.1-.8c.2-.6.4-1.1.7-1.6L3.9 6.3l1.7-1.7 2.8 1.6c.5-.3 1-.5 1.6-.7l.8-3.1Z" />
      <circle cx="12" cy="12" r="3.2" fill="white" />
    </svg>
  )
}

function VacancyArticle({ vacature }) {
  return (
    <article id={vacature.id} className="vacancy-article">
      <div className="vacancy-title-row">
        <div className="vacancy-icon"><VacancyIcon /></div>
        <div>
          <p className="eyebrow">{vacature.label}</p>
          <h2>{vacature.title}</h2>
        </div>
      </div>
      <div className="vacancy-meta-row">
        {vacature.meta.map((item) => <span key={item}>{item}</span>)}
      </div>
      <p className="vacancy-intro">{vacature.intro}</p>
      <div className="vacancy-content-grid">
        <div className="vacancy-copy">
          {vacature.sections.map(([title, bullets]) => (
            <section key={title}>
              <h3>{title}</h3>
              <ul>
                {bullets.map((bullet) => <li key={bullet}>{bullet}</li>)}
              </ul>
            </section>
          ))}
        </div>
        <aside className="vacancy-side-card">
          {vacature.side.map((item) => <span key={item}>{item}</span>)}
        </aside>
      </div>
    </article>
  )
}

export default function Vacatures() {
  useEffect(() => {
    const hash = window.location.hash?.replace('#', '')
    if (hash && hash.startsWith('vacature-')) {
      setTimeout(() => document.getElementById(hash)?.scrollIntoView({ behavior: 'smooth', block: 'start' }), 140)
    }
  }, [])

  return (
    <>
      <section className="vacancy-hero">
        <div className="vacancy-hero-inner">
          <p className="hero-kicker">Vacatures · Heesch</p>
          <h1>Werken voor <span>Mobatech</span></h1>
          <p>Bouw mee aan sterke oplossingen in techniek, service en houtbewerkingsmachines.</p>
          <div className="hero-actions">
            <a href="/#vacature-administrateur" className="btn btn-primary">Administrateur</a>
            <a href="/#vacature-allround-monteur" className="btn btn-outline">Allround Monteur</a>
          </div>
        </div>
      </section>

      <section className="section vacancies-page-section">
        <div className="container vacancies-layout">
          <aside className="vacancy-nav-card">
            <h2>Vacatures</h2>
            <a href="/#vacature-administrateur">Administrateur</a>
            <a href="/#vacature-allround-monteur">Allround Monteur</a>
          </aside>
          <div className="vacancies-list">
            {vacatures.map((vacature) => <VacancyArticle key={vacature.id} vacature={vacature} />)}
          </div>
        </div>
      </section>

      <section className="vacancy-cta">
        <div className="container vacancy-cta-inner">
          <div>
            <p className="eyebrow">Interesse?</p>
            <h2>Stuur je CV en motivatie.</h2>
            <p>Mail naar <a href="mailto:info@mobatech.nl">info@mobatech.nl</a> of neem telefonisch contact op voor meer informatie.</p>
          </div>
          <a href="/#contact" className="btn btn-primary">Neem contact op</a>
        </div>
      </section>
    </>
  )
}
