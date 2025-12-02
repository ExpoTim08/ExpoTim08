document.addEventListener("DOMContentLoaded", function() {
    const selectTri = document.getElementById("filter-select");
    const urlParams = new URLSearchParams(window.location.search);
    const triActuel = urlParams.get("tri");

    if (triActuel) selectTri.value = triActuel;

    selectTri.addEventListener("change", function() {
        const tri = this.value;
        const url = new URL(window.location.href);
        if (tri === "random") {
            url.searchParams.delete("tri"); // random si pas de tri
        } else {
            url.searchParams.set("tri", tri);
        }
        window.location.href = url.toString();
    });
});
