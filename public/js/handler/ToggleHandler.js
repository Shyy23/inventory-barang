export default class ToggleHandler {
    constructor() {
        this.setupToggleListeners();
    }

    setupToggleListeners() {
        document.querySelectorAll(".unit-checkbox").forEach((checkbox) => {
            checkbox.addEventListener("change", this.handleToggle);
            checkbox.dispatchEvent(new Event("change")); // Trigger initial state
        });
    }

    handleToggle(event) {
        const checkbox = event.target;
        const card = checkbox.closest(".unit-card");

        // Toggle opacity
        card?.classList.toggle("opacity-100", checkbox.checked);
        card?.classList.toggle("opacity-50", !checkbox.checked);

        // Toggle disabled state untuk input lain
        const inputs = card?.querySelectorAll(
            "input:not(.unit-checkbox), select, textarea",
        );
        inputs?.forEach((input) => {
            input.disabled = !checkbox.checked;
        });
    }
}
