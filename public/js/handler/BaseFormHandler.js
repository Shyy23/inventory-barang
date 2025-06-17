export default class BaseFormHandler {
    constructor(
        formId,
        closeButtonId = null,
        modalId = null,
        checkboxSelector = null,
    ) {
        this.formId = formId;
        this.closeButtonId = closeButtonId;
        this.modalId = modalId;
        this.checkboxSelector = checkboxSelector;
        this.initialize();
        this.setupListeners();
    }

    initialize() {
        this.form = document.getElementById(this.formId);
        this.closeButton = this.closeButtonId
            ? document.getElementById(this.closeButtonId)
            : null;
        this.modal = this.modalId
            ? document.getElementById(this.modalId)
            : null;

        if (this.checkboxSelector) {
            this.checkboxes = this.form?.querySelectorAll(
                this.checkboxSelector,
            );
        }
    }

    resetForm() {
        // Override dari child
        this.form?.reset();
    }

    setupListeners() {
        this.closeButton?.addEventListener("click", () => this.resetForm());

        // Handle Klik di luar modal
        this.modal?.addEventListener("click", (e) => {
            if (e.target === this.modal) this.resetForm();
        });
    }
}
