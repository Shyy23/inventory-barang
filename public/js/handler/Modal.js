/** ===========  LOAN MODAL ================  */
export class Modal {
    constructor(modalId, containerId, showModal, closeModal) {
        this.modal = document.getElementById(modalId);
        this.container = document.getElementById(containerId);
        this.showModal = document.getElementById(showModal);
        this.closeModal = document.getElementById(closeModal);
        this.unitRadios = document.querySelectorAll('input[name="unit_data"]');
        this.setupListeners();
    }

    show() {
        this.modal.classList.remove("hidden");
        setTimeout(() => {
            this.container.classList.add("active"),
                this.modal.classList.add("block", "z-[100]");
        }, 50);
    }

    hide() {
        this.container.classList.remove("hidden", "active");

        setTimeout(() => {
            this.modal.classList.remove("z-[100]");
            this.modal.classList.replace("block", "hidden");
        }, 300);
    }

    setupListeners() {
        this.showModal.addEventListener("click", () => {
            this.show();
        });
        this.closeModal.addEventListener("click", () => {
            this.hide();
        });
        this.modal.addEventListener("click", (e) => {
            if (e.target === this.modal) {
                this.modal();
            }
        });

        document.addEventListener("keydown", (e) => {
            if (
                e.key === "Escape" &&
                !this.modal.classList.contains("hidden")
            ) {
                this.hide();
            }
        });
    }
}
