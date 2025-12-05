document.addEventListener("DOMContentLoaded", function () {
    const selectTri = document.getElementById("tri-select");
    const selectCat = document.getElementById("filtre-categorie-select");

    // ---------------- Détection de la page et du conteneur ----------------
    let containerSelector;
    if (window.location.pathname.includes("/finissants")) {
        containerSelector = "#liste-projet-finissant";
    } else if (window.location.pathname.includes("/arcade")) {
        containerSelector = "#liste-projet-arcade";
    } else if (window.location.pathname.includes("/graphisme")) {
        containerSelector = "#liste-projet-graphisme";
    }

    const container = document.querySelector(containerSelector);
    if (!container) return;

    const allProjects = Array.from(container.querySelectorAll("article")); // tous les projets

    function sortAndFilterProjects(order = "random") {
        let projects = [...allProjects];

        // ---------------- FILTRAGE (uniquement si selectCat existe) ----------------
        if (selectCat && selectCat.value && selectCat.value !== "all") {
            const selectedCat = selectCat.value.toString().trim();
            projects = projects.filter(p => {
                const cats = (p.dataset.filtre || "").split(",").map(c => c.trim());
                return cats.includes(selectedCat);
            });
        }

        // ---------------- TRI ----------------
        if (order === "asc") {
            projects.sort((a, b) => {
                const titleA = a.querySelector("h2")?.textContent.toLowerCase() || "";
                const titleB = b.querySelector("h2")?.textContent.toLowerCase() || "";
                return titleA.localeCompare(titleB);
            });
        } else if (order === "desc") {
            projects.sort((a, b) => {
                const titleA = a.querySelector("h2")?.textContent.toLowerCase() || "";
                const titleB = b.querySelector("h2")?.textContent.toLowerCase() || "";
                return titleB.localeCompare(titleA);
            });
        } else if (order === "random") {
            for (let i = projects.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                [projects[i], projects[j]] = [projects[j], projects[i]];
            }
        }

        // ---------------- REINJECTION ----------------
        container.innerHTML = "";
        if (projects.length === 0) {
            const msg = document.createElement("p");
            msg.textContent = "Aucun projet disponible pour cette catégorie.";
            container.appendChild(msg);
        } else {
            projects.forEach(proj => container.appendChild(proj));
        }
    }

    // ---------------- ÉVÉNEMENTS ----------------
    if (selectTri) {
        selectTri.addEventListener("change", function () {
            sortAndFilterProjects(this.value);

            const url = new URL(window.location.href);
            if (this.value === "random") url.searchParams.delete("tri");
            else url.searchParams.set("tri", this.value);
            history.pushState({}, "", url);
        });
    }

    if (selectCat) {
        selectCat.addEventListener("change", function () {
            const tri = selectTri ? selectTri.value : "random";
            sortAndFilterProjects(tri);

            const url = new URL(window.location.href);
            if (this.value === "all") url.searchParams.delete("cat");
            else url.searchParams.set("cat", this.value);
            history.pushState({}, "", url);
        });
    }
});
