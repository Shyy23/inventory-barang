function showAuthModal(tab = "login") {
    const modal = document.getElementById("authModal");
    const containerModal = document.getElementById("containerModal");

    modal.classList.remove("hidden");
    modal.classList.add("modal-show", "bg-black/50");

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
    const step1Reg = document.getElementById("step-1-reg");
    const step2Reg = document.getElementById("step-2-reg");
    const forms = [
        document.getElementById("initialRegisterForm"),
        document.getElementById("studentForm"),
        document.getElementById("loginForm"),
    ];

    // Validasi elemen modal
    if (!modal || !containerModal || !step1Reg || !step2Reg) {
        console.error("Error: Required elements for closing modal not found.");
        return;
    }
    // Nonaktifkan animasi
    containerModal.classList.remove("active");
    modal.classList.remove("bg-black/50");

    // Sembunyikan modal setelah animasi selesai
    setTimeout(() => {
        // Reset ke step 1
        step1Reg.classList.remove("hidden", "translate-y-4", "opacity-0");
        step2Reg.classList.add("hidden");
        // Reset form
        forms.forEach((form) => form?.reset());
        modal.classList.remove("modal-show");
        modal.classList.add("hidden");
    }, 300); // Sesuaikan dengan durasi animasi
}

function hideAuthModal() {
    const modal = document.getElementById("authModal");

    // Validasi elemen modal
    if (!modal) {
        console.error("Error: Auth modal element not found.");
        return;
    }

    modal.classList.add("hidden");
}
