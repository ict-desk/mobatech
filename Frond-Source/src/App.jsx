import { useEffect, useState } from "react";
import Header from "./components/Header.jsx";
import Hero from "./components/Hero.jsx";
import Sections from "./components/Sections.jsx";
import Vacatures from "./pages/Vacatures.jsx";
import Machines from "./pages/Machines.jsx";
import Footer from "./components/Footer.jsx";
import ContactForm from "./components/ContactForm.jsx";

function getRoute() {
  if (typeof window === "undefined") return { page: "home", target: "" };

  const path = window.location.pathname;
  const hash = window.location.hash
    ? window.location.hash.replace("#", "")
    : "";

  // Supports both /vacatures and hash route /#vacatures.
  // Hash routing works on every static Linux hosting setup without extra rewrite rules.
  if (
    path.startsWith("/vacatures") ||
    hash === "vacatures" ||
    hash.startsWith("vacature-")
  ) {
    return {
      page: "vacatures",
      target: hash.startsWith("vacature-") ? hash : "",
    };
  }

  if (path.startsWith("/aanbod") || hash === "aanbod") {
    return { page: "aanbod", target: "" };
  }

  if (hash === "full-contact" || hash.startsWith("full-contact?")) {
    return { page: "full-contact", target: "" };
  }

  return { page: "home", target: hash };
}

export default function App() {
  const [route, setRoute] = useState(getRoute());

  useEffect(() => {
    window.scrollTo({
      top: 0,
      behavior: "smooth",
    });
  }, [route.page, route.target]);

  useEffect(() => {
    const update = () => setRoute(getRoute());
    window.addEventListener("popstate", update);
    window.addEventListener("hashchange", update);
    return () => {
      window.removeEventListener("popstate", update);
      window.removeEventListener("hashchange", update);
    };
  }, []);

const isVacatures = route.page === "vacatures";
  const isAanbod = route.page === "aanbod";
  const isFullContact = route.page === "full-contact";

  return (
    <div className="site-shell">
      <Header currentPage={isVacatures ? "vacatures" : "home"} />
      <main>
        {isVacatures ? (
          <Vacatures />
        ) : isAanbod ? (
          <Machines />
        ) : isFullContact ? (
          <section className="section contact-section">
            <div className="container">
              <p className="eyebrow">Contact</p>

              <h1>Interesse in een machine</h1>

              <ContactForm subject="Interesse in een machine" />
            </div>
          </section>
        ) : (
          <>
            <Hero />
            <Sections />
          </>
        )}
      </main>
      <Footer />
    </div>
  );
}
