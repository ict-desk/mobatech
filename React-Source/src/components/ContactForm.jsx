import { useEffect, useState } from 'react'

export default function ContactForm({
  subject = 'Contactformulier Mobatech',
  buttonText = 'Verstuur aanvraag',
}) {
  const [message, setMessage] = useState('')
  const [formSubject, setFormSubject] = useState(subject)

  useEffect(() => {
    const hash = window.location.hash.replace('#', '')

    if (!hash.includes('?')) {
      return
    }

    const queryString = hash.split('?')[1]
    const params = new URLSearchParams(queryString)
    const subjectParam = params.get('subject')

    if (subjectParam) {
      setFormSubject(subjectParam)
    }
  }, [])

  const handleSubmit = (event) => {
    event.preventDefault()

    setMessage('Formulier is ingevuld. Verzenden wordt later gekoppeld aan Laravel.')
  }

  return (
    <form className="contact-form" onSubmit={handleSubmit} acceptCharset="UTF-8">
      {message && <div className="form-success">{message}</div>}

      <input type="hidden" name="form_name" value="Mobatech contactformulier" />

      <div className="contact-subject-field">
        <label>Onderwerp</label>

        <input
          type="text"
          name="subject"
          value={formSubject}
          readOnly
        />
      </div>

      <input name="naam" placeholder="Naam" required />
      <input name="email" type="email" placeholder="E-mailadres" required />
      <input name="telefoon" placeholder="Telefoon" />

      <textarea
        name="bericht"
        placeholder="Uw bericht"
        required
      />

      <button type="submit">
        {buttonText}
      </button>
    </form>
  )
}