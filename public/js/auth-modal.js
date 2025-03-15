function showAuthModal(tab = "login") {
    const modal = document.getElementById("authModal");
    const containerModal = document.getElementById("containerModal");

    modal.classList.remove("hidden");
    modal.classList.add("modal-show");
    setTimeout(() => {
        containerModal.classList.add("active");
    }, 50);

    // Update activeTab pada komponen Alpine modal
    const modalComponent = Alpine.$data(modal);
    if (modalComponent) {
        modalComponent.activeTab = tab;
    }
}
function closeModal() {
    const modal = document.getElementById("authModal");
    const containerModal = document.getElementById("containerModal");

    // Nonaktifkan animasi
    containerModal.classList.remove("active");
    modal.classList.remove("bg-black/50");

    // Sembunyikan modal setelah animasi selesai
    setTimeout(() => {
        // Reset ke step 1
        document
            .querySelector(".step-1")
            .classList.remove("hidden", "translate-y-4", "opacity-0");
        document.querySelector(".step-2").classList.add("hidden");
        // Reset form
        document.getElementById("initialRegisterForm").reset();
        document.getElementById("studentForm").reset();
        document.getElementById("loginForm").reset();
        modal.classList.remove("modal-show");
        modal.classList.add("hidden");
    }, 300); // Sesuaikan dengan durasi animasi
}

function hideAuthModal() {
    document.getElementById("authModal").classList.add("hidden");
}
