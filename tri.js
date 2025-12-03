document.addEventListener("DOMContentLoaded", function() {
    const selectTri = document.getElementById("tri-select");
    const selectCat = document.getElementById("filtre-categorie-select");

    // Si on est sur la page finissants, on doit gérer aussi le filtre catégorie
    if (selectCat) {
        selectCat.addEventListener("change", function() {
            const tri = selectTri ? selectTri.value : "random";
            const cat = this.value;
            triggerFinissantsFilter(tri, cat);
        });
    }

    if (!selectTri) return;

    selectTri.addEventListener("change", function() {
        const tri = this.value;
        
        // Déterminer l'action AJAX et le sélecteur en fonction de la page
        let action = "arcade_tri";
        let selector = "#liste-projet-arcade";
        
        if (window.location.pathname.includes('/graphisme')) {
            action = "graphisme_tri";
            selector = "#liste-projet-graphisme";
        } else if (window.location.pathname.includes('/finissants')) {
            action = "finissants_tri";
            selector = "#liste-projet-finissant";
            
            // Pour finissants, passer aussi la catégorie
            const cat = selectCat ? selectCat.value : "";
            triggerFinissantsFilter(tri, cat);
            return;
        }

        fetch(TriAjax.ajaxurl, {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded",
            },
            body: new URLSearchParams({
                action: action,
                tri: tri,
                nonce: TriAjax.nonce
            })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                document.querySelector(selector).innerHTML = data.data;

                // Mise à jour URL
                const url = new URL(window.location.href);
                if (tri === "random") url.searchParams.delete("tri");
                else url.searchParams.set("tri", tri);
                history.pushState({}, "", url);
            }
        })
        .catch(err => console.error("Erreur AJAX tri :", err));
    });
});

// Fonction dédiée pour finissants (gère tri + catégorie)
function triggerFinissantsFilter(tri, cat) {
    const selector = "#liste-projet-finissant";
    
    fetch(TriAjax.ajaxurl, {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded",
        },
        body: new URLSearchParams({
            action: "finissants_tri",
            tri: tri,
            cat: cat,
            nonce: TriAjax.nonce
        })
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            document.querySelector(selector).innerHTML = data.data;

            // Mise à jour URL
            const url = new URL(window.location.href);
            if (tri === "random") url.searchParams.delete("tri");
            else url.searchParams.set("tri", tri);
            
            if (cat === "") url.searchParams.delete("cat");
            else url.searchParams.set("cat", cat);
            
            history.pushState({}, "", url);
        }
    })
    .catch(err => console.error("Erreur AJAX filtre finissants :", err));
}
