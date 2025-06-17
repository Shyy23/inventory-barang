import BaseFormHandler from "../handler/BaseFormHandler.js";
import BaseFilter from "../handler/Filter.js";

export class AddLocationForm extends BaseFormHandler {
    constructor() {
        super("addLocationForm", "closeLocationModal", "addLocationModal");
    }

    resetForm() {
        if (this.form) {
            super.resetForm();
        }
    }
}

export class DeleteLocationForm extends BaseFormHandler {
    constructor() {
        super(
            "deleteLocationForm",
            "closeDeleteLocationModal",
            "deleteLocationModal",
            'input[name="locations[]"]',
        );
    }

    resetForm() {
        if (this.checkboxes) {
            this.checkboxes.forEach((checkbox) => {
                checkbox.checked = false;
                checkbox
                    .closest(".unit-card")
                    ?.classList.replace("opacity-100", "opacity-50");
            });
        }
    }
}

export class EditLocationForm extends BaseFormHandler {
    constructor() {
        super(
            "editLocationForm",
            "closeEditLocationModal",
            "editLocationModal",
            'input[name^="locations["][type="checkbox"]',
        );
    }
    resetForm() {
        super.resetForm();
        if (this.checkboxes) {
            this.checkboxes.forEach((checkbox) => {
                // Pastikan checkbox unchecked
                checkbox.checked = false;

                // Update UI state
                const card = checkbox.closest(".unit-card");
                card?.classList.replace("opacity-100", "opacity-50");

                // Reset nilai input ke data awal
                const textInputs = card?.querySelectorAll('input[type="text"]');
                textInputs?.forEach((input) => {
                    input.value = input.dataset.initialValue;
                });

                // Paksa update disabled state via toggle handler
                checkbox.dispatchEvent(new Event("change"));
            });
        }
    }
}

// Filtering Location
export class LocationFilter extends BaseFilter {
    constructor() {
        super({
            route: window.Laravel?.routes?.locationsIndex,
            itemsContainerSelector: ".card-items-scroll",
            paginationContainerSelector: "#pagination-wrapper",
            searchInputSelector: 'input[name="search"]',
            clearButtonSelector: "#clearFilterTypeSelection",
        });
    }

    init() {
        super.init();
        this.radios = document.querySelectorAll(
            'input[type="radio"][name="type"]',
        );

        // Inisialisasi khusus lokasi
        if (this.itemsContainer) {
            this.initRadios();
        }
    }

    initRadios() {
        this.radios.forEach((radio) => {
            radio.addEventListener("change", () => this.handleFilter());
        });
    }

    getFilterParams() {
        const params = new URLSearchParams();
        const selected = Array.from(this.radios).find((r) => r.checked);

        if (selected) params.set("type", selected.value);
        if (this.searchInput && this.searchInput.value.trim()) {
            params.set("search", this.searchInput.value.trim());
        }

        return params;
    }

    restoreInputState() {
        const urlParams = new URLSearchParams(window.location.search);
        const type = urlParams.get("type");

        if (type) {
            this.radios.forEach((radio) => {
                radio.checked = radio.value === type;
            });
        }
    }

    resetInputs() {
        this.radios.forEach((radio) => (radio.checked = false));
        if (this.searchInput) this.searchInput.value = "";
    }
}
