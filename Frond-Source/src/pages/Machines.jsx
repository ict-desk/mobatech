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

  const filteredMachines = selectedCategory
    ? machines.filter(
        (machine) =>
          machine.category === selectedCategory &&
          machine.stockStatus === "op_voorraad",
      )
    : [];

  const openMachine = (machine) => {
    setSelectedMachine(machine);
    setSelectedImage(machine.images[0]);
  };

  if (selectedMachine) {
    return (
      <main>
        <section className="section section-soft">
          <div className="container two-col machines-grid">
            <div>
              <button
                type="button"
                className="back-button"
                onClick={() => {
                  setSelectedMachine(null);
                  setSelectedImage(null);
                }}
                aria-label="Terug naar machine overzicht"
              >
                ←
              </button>

              <p className="eyebrow">Te koop</p>

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
    <main>
      <section className="section section-soft">
        <div className="container two-col machines-grid">
          <div>
            <p className="eyebrow">Te koop</p>

            <h1 className="machines-title">
              <span>Machines</span>
              <span>op voorraad.</span>
            </h1>

            <p>
              Bekijk de actuele selectie nieuwe en gebruikte
              houtbewerkingsmachines. Kies een categorie om de beschikbare
              machines te tonen.
            </p>
          </div>

          <div className="category-box">
            <h3>Machinecategorieën</h3>

            <div className="category-grid category-grid-icons">
              {categories.map((category) => (
                <button
                  key={category}
                  type="button"
                  className={
                    selectedCategory === category
                      ? "category-choice active"
                      : "category-choice"
                  }
                  onClick={() => setSelectedCategory(category)}
                >
                  <i>
                    <CategoryIcon />
                  </i>

                  <b>{category}</b>
                </button>
              ))}
            </div>
          </div>
        </div>
      </section>

      {selectedCategory && (
        <section className="section">
          <div className="container">
            <p className="eyebrow">Beschikbaar</p>

            <h2>Machines in categorie: {selectedCategory}</h2>

            {filteredMachines.length === 0 ? (
              <p>
                Er zijn momenteel geen machines op voorraad in deze categorie.
              </p>
            ) : (
              <div className="cards">
                {filteredMachines.map((machine) => (
                  <article className="card machine-card" key={machine.id}>
                    <button
                      type="button"
                      className="machine-card-image-button"
                      onClick={() => openMachine(machine)}
                    >
                      <img src={machine.images[0]} alt={machine.title} />
                    </button>

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
          </div>
        </section>
      )}
    </main>
  );
}