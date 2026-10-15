(function () {
  "use strict";

  // Menú móvil
  const toggle = document.querySelector(".menu-toggle");
  const nav = document.getElementById("nav");
  if (toggle && nav) {
    toggle.addEventListener("click", () => {
      const abierto = nav.classList.toggle("open");
      toggle.setAttribute("aria-expanded", String(abierto));
    });
  }

  // Resaltado de sintaxis
  if (window.hljs) window.hljs.highlightAll();

  // Botones "Copiar"
  document.querySelectorAll(".copy").forEach((boton) => {
    boton.addEventListener("click", async () => {
      const codigo = boton.closest(".code")?.querySelector("code")?.innerText ?? "";
      try {
        await navigator.clipboard.writeText(codigo);
        boton.textContent = "¡Copiado!";
      } catch (_) {
        boton.textContent = "No se pudo";
      }
      setTimeout(() => (boton.textContent = "Copiar"), 1600);
    });
  });

  // Sección actual en la tabla de contenido
  const enlaces = [...document.querySelectorAll(".toc a")];
  if (enlaces.length && "IntersectionObserver" in window) {
    const porId = new Map(enlaces.map((a) => [a.getAttribute("href").slice(1), a]));
    const observador = new IntersectionObserver(
      (entradas) => {
        entradas.forEach((e) => {
          if (e.isIntersecting) {
            enlaces.forEach((a) => a.classList.remove("current"));
            porId.get(e.target.id)?.classList.add("current");
          }
        });
      },
      { rootMargin: "-20% 0px -70% 0px" }
    );
    document.querySelectorAll(".concept").forEach((s) => observador.observe(s));
  }
})();
