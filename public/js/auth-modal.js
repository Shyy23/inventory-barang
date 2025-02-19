function showAuthModal(tab = "login") {
    const modal = document.getElementById("authModal");
    modal.classList.remove("hidden");
    modal.classList.add("modal-show");

    // Set active tab (jika menggunakan Alpine.js)
    Alpine.data("authModal", () => ({
        activeTab: tab,
    }));
}

function hideAuthModal() {
    document.getElementById("authModal").classList.add("hidden");
}
