document.addEventListener("DOMContentLoaded", function() {
    const selectTri = document.getElementById("tri-projets");

    selectTri.addEventListener("change", function() {
        const order = this.value;
        const url = new URL(window.location.href);

        url.searchParams.set("order", order);

        window.location.href = url.toString();
    });
});
