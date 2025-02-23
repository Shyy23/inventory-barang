function showAuthModal(tab = "login") {
    const modal = document.getElementById("authModal");

    const containerModal = document.getElementById("containerModal");
    modal.classList.remove("hidden");
    modal.classList.add("modal-show");
    setTimeout(() => {
        containerModal.classList.add(
            "opacity-100",
            "scale-100",
            "translate-y-0",
        );
    }, 50);
    // Set active tab (jika menggunakan Alpine.js)
    Alpine.data("authModal", () => ({
        activeTab: tab,
    }));
}
function closeModal() {
    const modal = document.getElementById("authModal");
    const containerModal = document.getElementById("containerModal");

    // Nonaktifkan animasi
    containerModal.classList.remove(
        "opacity-100",
        "scale-100",
        "translate-y-0",
    );

    // Sembunyikan modal setelah animasi selesai
    setTimeout(() => {
        modal.classList.remove("modal-show");
        modal.classList.add("hidden");
    }, 300); // Sesuaikan dengan durasi animasi
}

function hideAuthModal() {
    document.getElementById("authModal").classList.add("hidden");
}
