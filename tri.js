document.addEventListener("DOMContentLoaded", function() {
    const selectTri = document.getElementById("tri-select");

    if (!selectTri) return;

    selectTri.addEventListener("change", function() {
        const tri = this.value;

        fetch(TriAjax.ajaxurl, {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded",
            },
            body: new URLSearchParams({
                action: "arcade_tri",
                tri: tri,
                nonce: TriAjax.nonce
            })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                document.querySelector("#liste-projet-arcade").innerHTML = data.data;

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
