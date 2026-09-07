import { useEffect, useState } from 'react'

const services = [
  ['Machines', 'Nieuwe en gebruikte houtbewerkingsmachines voor professionele werkplaatsen, van zaagmachines tot CNC-bewerkingscentra.'],
  ['Onderhoud & storingsdienst', 'Preventief onderhoud, afstelling, smering, vervanging van slijtdelen en snelle ondersteuning bij storingen.'],
  ['Machinekeuringen', 'Keuring volgens de Richtlijn Arbeidsmiddelen met aandacht voor elektrische én mechanische veiligheid.'],
  ['Montage & verhuizingen', 'Demontage, transport, plaatsing, aansluiting en inbedrijfstelling van machines en complete werkplaatsopstellingen.'],
  ['Onderdelen & gereedschappen', 'Levering van onderdelen, toebehoren en gereedschappen voor uiteenlopende merken en typen houtbewerkingsmachines.'],
  ['Inkoop & inruil', 'Inkoop van gebruikte machines, inruil bij vervanging en overname van complete werkplaatsen.'],
]

const categories = [
  'Zagen', 'CNC-bewerking', 'Schaven & profileren', 'Frezen', 'Boren', 'Schuren & borstelen', 'Afzuiging', 'Combi-machines', 'Opsluiten & persen'
]

function CategoryIcon() {
  return (
    <svg viewBox="0 0 24 24" aria-hidden="true" focusable="false">
      <path d="M10.8 2.4h2.4l.8 3.1c.6.2 1.1.4 1.6.7l2.8-1.6 1.7 1.7-1.6 2.8c.3.5.5 1 .7 1.6l3.1.8v2.4l-3.1.8c-.2.6-.4 1.1-.7 1.6l1.6 2.8-1.7 1.7-2.8-1.6c-.5.3-1 .5-1.6.7l-.8 3.1h-2.4l-.8-3.1c-.6-.2-1.1-.4-1.6-.7l-2.8 1.6-1.7-1.7 1.6-2.8c-.3-.5-.5-1-.7-1.6l-3.1-.8v-2.4l3.1-.8c.2-.6.4-1.1.7-1.6L3.9 6.3l1.7-1.7 2.8 1.6c.5-.3 1-.5 1.6-.7l.8-3.1Z" />
      <circle cx="12" cy="12" r="3.2" fill="white" />
    </svg>
  )
}

export default function Sections() {
  const [contactMessage, setContactMessage] = useState('')
  const [isSending, setIsSending] = useState(false)

  const handleContactSubmit = async (event) => {
    event.preventDefault()

    setContactMessage('')
    setIsSending(true)

    const form = event.currentTarget
    const formData = new FormData(form)

    try {
      const response = await fetch('/api/contact', {
        method: 'POST',
        headers: {
          Accept: 'application/json',
        },
        body: formData,
      })

      const result = await response.json()

      if (response.ok && result.success) {
        setContactMessage('Bedankt, uw aanvraag is verzonden. Wij nemen zo snel mogelijk contact met u op.')
        form.reset()
      } else if (response.status === 429) {
        setContactMessage('U heeft kort achter elkaar meerdere berichten verstuurd. Probeer het over een uur nog eens of bel ons op +31 (0) 412 450 425.')
      } else if (result.message) {
        setContactMessage(result.message)
      } else {
        setContactMessage('Verzenden is niet gelukt. Probeer het later opnieuw of neem telefonisch contact op.')
      }
    } catch (error) {
      setContactMessage('Verzenden is niet gelukt. Probeer het later opnieuw of neem telefonisch contact op.')
    }

    setIsSending(false)
  }

  return (
    <>
      <section id="over-ons" className="section section-soft over-section">
        <div className="container split">
          <div>
            <p className="eyebrow">Over Mobatech</p>
            <h2>Technische kennis met een praktische aanpak.</h2>
          </div>
          <div className="rich-text">
            <p>Mobatech Holland B.V. is gevestigd in Heesch en ondersteunt bedrijven in de houtbewerking met levering, onderhoud en montage van professionele houtbewerkingsmachines.</p>
            <p>Als niet-merkgebonden partner denken wij mee vanuit de praktijk: welke machine past bij uw productie, hoe blijft uw machinepark betrouwbaar en veilig, en hoe beperken we stilstand tot een minimum?</p>
            <div className="checks checks-light">
              <span>Meer dan 25 jaar branche-ervaring</span>
              <span>Niet merkgebonden advies</span>
              <span>Eigen technische service</span>
              <span>Persoonlijk en oplossingsgericht</span>
            </div>
            <div className="home-vacancies">
              <h3>Wij zoeken de volgende collega&apos;s</h3>
              <div className="home-vacancy-grid">
                <a className="home-vacancy-card" href="/#vacature-administrateur">
                  <span className="vacancy-card-kicker">Vacature</span>
                  <strong>Administrateur / Financieel Administratief Medewerker</strong>
                  <small>24–32 uur · Heesch</small>
                  <em>Lees meer →</em>
                </a>
                <a className="home-vacancy-card" href="/#vacature-allround-monteur">
                  <span className="vacancy-card-kicker">Vacature</span>
                  <strong>Allround Monteur</strong>
                  <small>Fulltime · Heesch / regionaal</small>
                  <em>Lees meer →</em>
                </a>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section id="diensten" className="section services-section">
        <div className="container services-heading-grid">
          <div>
            <p className="eyebrow">Diensten</p>
            <h2>Alles voor een betrouwbaar machinepark.</h2>
            <p className="section-intro">Van aankoopadvies tot onderhoud en van machinekeuring tot verhuizing: Mobatech ondersteunt uw werkplaats met technische kennis en praktische uitvoering.</p>
          </div>
          <div className="services-logo-card" aria-hidden="true">
            <img src="/logo-full.png" alt="" />
          </div>
        </div>
        <div className="container">
          <div className="cards">
            {services.map(([title, text]) => (
              <article className="card" key={title}>
                <div className="card-mark">⚙</div>
                <h3>{title}</h3>
                <p>{text}</p>
              </article>
            ))}
          </div>
        </div>
      </section>

      <section id="machines" className="section section-soft">
        <div className="container two-col machines-grid">
          <div>
            <p className="eyebrow">Machines</p>
            <h2 className="machines-title">
              <span>Nieuwe en gebruikte</span>
              <span>houtbewerkings-</span>
              <span>machines.</span>
            </h2>
            <p>Mobatech levert houtbewerkingsmachines in verschillende prijs- en kwaliteitsklassen. Wij adviseren onafhankelijk en kijken naar capaciteit, toepassing, veiligheid en toekomstbestendigheid van uw machinepark.</p>
            <p>Informeer naar onze actuele voorraad of bespreek uw specifieke zoekopdracht met ons team.</p>
          </div>
          <div className="category-box">
            <h3>Machinecategorieën</h3>
            <div className="category-grid category-grid-icons">
              {categories.map((cat) => (
                <span key={cat}><i><CategoryIcon /></i><b>{cat}</b></span>
              ))}
            </div>
          </div>
        </div>
      </section>

      <section id="service" className="section">
        <div className="container two-col equal-panels">
          <article id="keuringen" className="info-panel">
            <div>
              <p className="eyebrow">Service & onderhoud</p>
              <h2>Voorkom stilstand door preventief onderhoud.</h2>
              <p>Stationaire houtbewerkingsmachines functioneren het best wanneer zij periodiek worden onderhouden. Tijdens onderhoud controleren wij onder andere geleidingen, snaren, bewegende delen, elektrische componenten en veiligheidsvoorzieningen.</p>
            </div>
            <a href="#contact" className="panel-link">Vraag informatie aan <span>→</span></a>
          </article>
          <article className="info-panel">
            <div>
              <p className="eyebrow">Keuringen</p>
              <h2>Veilig werken met goedgekeurde machines.</h2>
              <p>Mobatech voert machinekeuringen uit met aandacht voor alle relevante veiligheidsaspecten. De keuring kijkt breder dan alleen elektrische laagspanning en behandelt ook mechanische veiligheid.</p>
            </div>
            <a href="#contact" className="panel-link">Vraag informatie aan <span>→</span></a>
          </article>
        </div>
      </section>

      <section id="onderdelen" className="section section-dark">
        <div className="container split">
          <div>
            <p className="eyebrow">Onderdelen</p>
            <h2>Onderdelen voor alle merken.</h2>
          </div>
          <div className="rich-text">
            <p>Mobatech levert onderdelen en toebehoren voor stationaire houtbewerkingsmachines. Ook bij oudere machines denken wij mee over passende onderdelen, alternatieven of montage op locatie.</p>
            <div className="checks checks-dark">
              <span>Formaatzagen</span><span>Lintzagen</span><span>CNC-machines</span><span>Vlak- en vandiktebanken</span><span>Afzuiginstallaties</span><span>Freesmachines</span>
            </div>
          </div>
        </div>
      </section>

      <section id="contact" className="section contact-section">
        <div className="container two-col">
          <div>
            <p className="eyebrow">Contact</p>
            <h2>Bespreek uw machinepark met Mobatech.</h2>
            <p>Heeft u een vraag over machines, onderhoud, keuringen, onderdelen of montage? Neem contact op met Mobatech Holland B.V. in Heesch.</p>
            <div className="contact-list">
              <span>Cereslaan 4a, 5384 VT Heesch</span>
              <a href="tel:+31412450425">+31 (0) 412 450 425</a>
              <a href="mailto:info@mobatech.nl">info@mobatech.nl</a>
            </div>
          </div>

          <form className="contact-form" onSubmit={handleContactSubmit} acceptCharset="UTF-8">
            {contactMessage && <div className="form-success">{contactMessage}</div>}

            <input type="hidden" name="form_name" value="Mobatech contactformulier" />
            <input className="hp-field" type="text" name="website" tabIndex="-1" autoComplete="off" aria-hidden="true" />
            <input name="naam" placeholder="Naam" required />
            <input name="email" type="email" placeholder="E-mailadres" required />
            <input name="telefoon" placeholder="Telefoon" />
            <textarea name="bericht" placeholder="Waarmee kunnen wij u helpen?" required />
            <button type="submit" disabled={isSending}>
              {isSending ? 'Bezig met verzenden...' : 'Verstuur aanvraag'}
            </button>
            
          </form>
        </div>
      </section>
    </>
  )
}