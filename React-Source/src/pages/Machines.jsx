import { useEffect, useState } from "react";

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

 function hasValue(value) {
    return (
      value !== null &&
      value !== undefined &&
      String(value).trim() !== "" &&
      String(value).trim().toLowerCase() !== "geen"
    );
  }

export default function Machines() {
  const [selectedCategory, setSelectedCategory] = useState(null);
  const [selectedMachine, setSelectedMachine] = useState(null);
  const [selectedImage, setSelectedImage] = useState(null);
  const [machines, setMachines] = useState([]);
  const [categories, setCategories] = useState([]);

  useEffect(() => {
    fetch("/api/v0/machines")
      .then((response) => response.json())
      .then((data) => {
        const mappedMachines = data.map((machine) => ({
          ...machine,

          images:
            machine.images && machine.images.length > 0
              ? machine.images
              : ["/NoImage.png"],

          stockStatus: machine.stock_status,
          featured: machine.is_featured,
          shortDescription: machine.short_description,
          extraInfo: machine.extra_info,
        }));

        setMachines(mappedMachines);
      });

    fetch("/api/v0/machine-categories")
      .then((response) => response.json())
      .then((data) => {
        setCategories(data);
      });
  }, []);

  const visibleMachines = machines.filter(
    (machine) => machine.stockStatus !== "outofstock",
  );

  const featuredMachines = visibleMachines.filter(
    (machine) => machine.featured,
  );

  const displayedMachines = selectedCategory
    ? visibleMachines.filter((machine) => machine.category === selectedCategory)
    : featuredMachines;

  const sectionTitle = selectedCategory
    ? selectedCategory
    : "Uitgelicht aanbod";

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
                  {hasValue(selectedMachine.brand) && (
                      <span>Merk: {selectedMachine.brand}</span>
                    )}

                    {hasValue(selectedMachine.category) && (
                      <span>Categorie: {selectedMachine.category}</span>
                    )}

                    {hasValue(selectedMachine.condition) && (
                      <span>Conditie: {selectedMachine.condition}</span>
                    )}

                    {hasValue(selectedMachine.year) && (
                      <span>Bouwjaar: {selectedMachine.year}</span>
                    )}

                    {hasValue(selectedMachine.material) && (
                      <span>Geschikt voor: {selectedMachine.material}</span>
                    )}
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
          <h1 className="machines-title machines-title-single">
            Actueel aanbod.
          </h1>

          <p className="machines-intro">
            Bekijk de actuele selectie nieuwe en gebruikte
            houtbewerkingsmachines. Kies links een categorie of bekijk het
            uitgelichte aanbod.
          </p>

          <div className="offer-layout">
            <aside className="offer-sidebar">
              <div className="category-box offer-sidebar-box">
                <h3>Categorieën</h3>

                <div className="category-sidebar-list">
                  {categories.map((category) => (
                    <button
                      key={category.id}
                      type="button"
                      className={
                        selectedCategory === category.value
                          ? "category-choice active"
                          : "category-choice"
                      }
                      onClick={() => {
                        setSelectedCategory(category.value);
                        window.scrollTo({ top: 0, behavior: "smooth" });
                      }}
                    >
                      <i>
                        <img
                          src={`/storage/${
                            category.icon_image || "icons/default.svg"
                          }`}
                          alt=""
                        />
                      </i>

                      <b>{category.lbl_text || category.title}</b>
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
                    Er zijn momenteel geen machines beschikbaar binnen deze
                    selectie.
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

                      {hasValue(machine.brand) && (
                        <>
                          <strong>Merk:</strong> {machine.brand}
                          <br />
                        </>
                      )}

                      {hasValue(machine.year) && (
                        <>
                          <strong>Bouwjaar:</strong> {machine.year}
                          <br />
                        </>
                      )}

                      {hasValue(machine.condition) && (
                        <>
                          <strong>Conditie:</strong> {machine.condition}
                        </>
                      )}

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
