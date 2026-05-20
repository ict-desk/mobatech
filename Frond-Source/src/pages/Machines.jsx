import { useState } from "react";

const categories = [
  "Zagen",
  "CNC-bewerking",
  "Schaven & profileren",
  "Frezen",
  "Boren",
  "Schuren & borstelen",
  "Afzuiging",
  "Combi-machines",
  "Opsluiten & persen",
];

const machines = [
  {
    id: 1,
    title: "SCM Formula S 35",
    category: "Zagen",
    brand: "SCM",
    condition: "Gebruikt",
    year: "2021",
    material: "Hout",
    images: ["/machines/example-machine-1.jpg"],
    stockStatus: "op_voorraad",
    listedAt: "2026-05-15",
    isNewSticky: true,
    featured: true,
    shortDescription:
      "Professionele zaagmachine voor nauwkeurig en betrouwbaar zaagwerk.",
    description:
      "Deze SCM zaagmachine is geschikt voor professionele houtbewerking en dagelijks gebruik in een werkplaats.",
    extraInfo: `
      <h3>Extra informatie</h3>

      <p>
        Deze machine verkeert in nette staat en is direct inzetbaar.
      </p>

      <ul>
        <li>380V aansluiting</li>
        <li>Transport mogelijk</li>
        <li>Meer foto's op aanvraag</li>
      </ul>
    `,
  },
  {
    id: 2,
    title: "Altendorf F45",
    category: "Zagen",
    brand: "Altendorf",
    condition: "Gebruikt",
    year: "2019",
    material: "Hout",
    images: ["/machines/example-machine-2.jpg"],
    stockStatus: "op_voorraad",
    listedAt: "2026-05-10",
    isNewSticky: false,
    featured: true,
    shortDescription: "Formaatzaag voor professioneel gebruik.",
    description:
      "Nette gebruikte formaatzaag met sterke constructie en praktische bediening.",
    extraInfo: `
      <h3>Extra informatie</h3>

      <p>
        Deze machine verkeert in nette staat en is direct inzetbaar.
      </p>

      <ul>
        <li>380V aansluiting</li>
        <li>Transport mogelijk</li>
        <li>Meer foto's op aanvraag</li>
      </ul>
    `,
  },
  {
    id: 3,
    title: "Biesse Rover CNC",
    category: "CNC-bewerking",
    brand: "Biesse",
    condition: "Gebruikt",
    year: "2020",
    material: "Hout",
    images: [
      "/machines/example-machine-3.jpg",
      "/machines/example-machine-3-1.jpg",
      "/machines/example-machine-3-2.jpg",
    ],
    stockStatus: "op_voorraad",
    listedAt: "2026-04-20",
    isNewSticky: false,
    featured: false,
    shortDescription: "CNC-bewerkingscentrum voor houtbewerking.",
    description:
      "CNC-machine geschikt voor seriematig werk en nauwkeurige bewerkingen.",
    extraInfo: `
      <h2>Nieuwe functionaliteit opgebouwd</h2>

      <p>
        Dit onderdeel is net toegevoegd aan de website en is bedoeld om de nieuwe
        opbouw, indeling en werking goed te kunnen testen. De tekst is bewust wat
        langer gemaakt, zodat duidelijk zichtbaar wordt hoe de pagina omgaat met
        meerdere regels tekst, langere omschrijvingen en bredere contentblokken.
      </p>

      <p>
        Hiermee kunnen we controleren of de layout netjes blijft werken op desktop,
        tablet en mobiel. Ook is goed te zien of knoppen, afbeeldingen, kaarten,
        filters en detailblokken voldoende ruimte krijgen en visueel netjes blijven
        uitlijnen binnen het ontwerp.
      </p>

      <p>
        Deze tekst kan later eenvoudig worden vervangen door echte inhoud. Voor nu
        dient dit vooral als testinhoud om de structuur, spacing, typografie en
        responsive weergave goed te beoordelen tijdens de verdere ontwikkeling.
      </p>
    `,
  },
];

function isMachineNew(machine) {
  if (machine.isNewSticky) {
    return true;
  }

  if (!machine.listedAt) {
    return false;
  }

  const listedDate = new Date(`${machine.listedAt}T00:00:00`);
  const today = new Date();
  const twoWeeksInMs = 14 * 24 * 60 * 60 * 1000;

  return today.getTime() - listedDate.getTime() <= twoWeeksInMs;
}

function CategoryIcon() {
  return (
    <svg viewBox="0 0 24 24" aria-hidden="true" focusable="false">
      <path d="M10.8 2.4h2.4l.8 3.1c.6.2 1.1.4 1.6.7l2.8-1.6 1.7 1.7-1.6 2.8c.3.5.5 1 .7 1.6l3.1.8v2.4l-3.1.8c-.2.6-.4 1.1-.7 1.6l1.6 2.8-1.7 1.7-2.8-1.6c-.5.3-1 .5-1.6.7l-.8 3.1h-2.4l-.8-3.1c-.6-.2-1.1-.4-1.6-.7l-2.8 1.6-1.7-1.7 1.6-2.8c-.3-.5-.5-1-.7-1.6l-3.1-.8v-2.4l3.1-.8c.2-.6.4-1.1.7-1.6L3.9 6.3l1.7-1.7 2.8 1.6c.5-.3 1-.5 1.6-.7l.8-3.1Z" />
      <circle cx="12" cy="12" r="3.2" fill="white" />
    </svg>
  );
}

export default function Machines() {
  const [selectedCategory, setSelectedCategory] = useState(null);
  const [selectedMachine, setSelectedMachine] = useState(null);
  const [selectedImage, setSelectedImage] = useState(null);

  const visibleMachines = machines.filter(
    (machine) => machine.stockStatus === "op_voorraad",
  );

  const featuredMachines = visibleMachines.filter((machine) => machine.featured);

  const displayedMachines = selectedCategory
    ? visibleMachines.filter((machine) => machine.category === selectedCategory)
    : featuredMachines;

  const sectionTitle = selectedCategory ? selectedCategory : "Uitgelicht aanbod";

  const sectionIntro = selectedCategory
    ? "Bekijk de beschikbare machines binnen deze categorie."
    : "Een selectie uit het actuele aanbod.";

  const openMachine = (machine) => {
    setSelectedMachine(machine);
    setSelectedImage(machine.images[0]);
    window.scrollTo({ top: 0, behavior: "smooth" });
  };

  if (selectedMachine) {
    return (
      <main className="machines-main">
        <section className="section section-soft machines-section">
          <div className="container two-col machines-grid">
            <div>
              <button
                type="button"
                className="back-button"
                onClick={() => {
                  setSelectedMachine(null);
                  setSelectedImage(null);
                  window.scrollTo({ top: 0, behavior: "smooth" });
                }}
                aria-label="Terug naar aanbod overzicht"
              >
                ←
              </button>

              <p className="eyebrow">Aanbod</p>

              <h1 className="machines-title">
                <span>{selectedMachine.title}</span>
              </h1>

              <p>{selectedMachine.description}</p>

              <div className="checks checks-light">
                <span>Merk: {selectedMachine.brand}</span>
                <span>Categorie: {selectedMachine.category}</span>
                <span>Conditie: {selectedMachine.condition}</span>
                <span>Bouwjaar: {selectedMachine.year}</span>
                <span>Geschikt voor: {selectedMachine.material}</span>
              </div>
            </div>

            <div className="category-box machine-detail-image-box">
              <img src={selectedImage} alt={selectedMachine.title} />

              <div className="machine-gallery-thumbs">
                {selectedMachine.images.map((image) => (
                  <button
                    key={image}
                    type="button"
                    className={
                      selectedImage === image
                        ? "machine-thumb active"
                        : "machine-thumb"
                    }
                    onClick={() => setSelectedImage(image)}
                  >
                    <img src={image} alt="" />
                  </button>
                ))}
              </div>
            </div>

            <div
              className="machine-extra-info full-width"
              dangerouslySetInnerHTML={{
                __html: selectedMachine.extraInfo,
              }}
            />

            <a
              className="machine-interest-button"
              href={`/#full-contact?subject=${encodeURIComponent(
                `Interesse in ${selectedMachine.title} - bouwjaar ${selectedMachine.year}`,
              )}`}
            >
              <span>Ik heb interesse</span>
              <span>in deze machine</span>
            </a>
          </div>
        </section>
      </main>
    );
  }

  return (
    <main className="machines-main">
      <section className="section section-soft machines-section">
        <div className="container">
          <h1 className="machines-title machines-title-single">Actueel aanbod.</h1>

          <p className="machines-intro">
            Bekijk de actuele selectie nieuwe en gebruikte houtbewerkingsmachines.
            Kies links een categorie of bekijk het uitgelichte aanbod.
          </p>

          <div className="offer-layout">
            <aside className="offer-sidebar">
              <div className="category-box offer-sidebar-box">
                <h3>Categorieën</h3>

                <div className="category-sidebar-list">
                  {categories.map((category) => (
                    <button
                      key={category}
                      type="button"
                      className={
                        selectedCategory === category
                          ? "category-choice active"
                          : "category-choice"
                      }
                      onClick={() => {
                        setSelectedCategory(category);
                        window.scrollTo({ top: 0, behavior: "smooth" });
                      }}
                    >
                      <i>
                        <CategoryIcon />
                      </i>

                      <b>{category}</b>
                    </button>
                  ))}
                </div>
              </div>
            </aside>

            <section className="offer-content" aria-live="polite">
              <div className="offer-content-header">
                <div>
                  <h2>{sectionTitle}</h2>
                  <p>{sectionIntro}</p>
                </div>
              </div>

              {displayedMachines.length === 0 ? (
                <div className="category-box">
                  <p>
                    Er zijn momenteel geen machines beschikbaar binnen deze selectie.
                  </p>
                </div>
              ) : (
                <div className="cards offer-cards">
                  {displayedMachines.map((machine) => (
                    <article className="card machine-card" key={machine.id}>
                      <button
                        type="button"
                        className="machine-card-image-button"
                        onClick={() => openMachine(machine)}
                      >
                        <img src={machine.images[0]} alt={machine.title} />
                      </button>

                      {isMachineNew(machine) && (
                        <span className="machine-new-badge">Nieuw</span>
                      )}

                      <h3>{machine.title}</h3>

                      <p>{machine.shortDescription}</p>

                      <p>
                        <strong>Merk:</strong> {machine.brand}
                        <br />
                        <strong>Bouwjaar:</strong> {machine.year}
                        <br />
                        <strong>Conditie:</strong> {machine.condition}
                      </p>

                      <button
                        type="button"
                        className="panel-link panel-link-button"
                        onClick={() => openMachine(machine)}
                      >
                        Bekijk machine <span>→</span>
                      </button>
                    </article>
                  ))}
                </div>
              )}
            </section>
          </div>
        </div>
      </section>
    </main>
  );
}
