document.getElementById("searchProduct").addEventListener("click", () => {
    const productName = document.getElementById("productName").value.trim();

    if (!productName) {
        alert("Por favor, ingrese un nombre de producto.");
        return;
    }

    const encodedProductName = encodeURIComponent(productName);
    const searchURL = `https://go.drugbank.com/unearth/q?searcher=drugs&query=${encodedProductName}&button=`;

    window.open(searchURL, "_blank");

    const modal = bootstrap.Modal.getInstance(document.getElementById("searchModal"));
    modal.hide();
});
