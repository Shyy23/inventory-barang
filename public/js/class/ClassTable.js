import BaseFormHandler from "../handler/BaseFormHandler.js";
import BaseFilter from "../handler/Filter.js";

export class AddClassForm extends BaseFormHandler {
    constructor() {
        super("addClassForm", "closeClassModal", "addClassModal");
    }

    resetForm() {
        if (this.form) {
            super.resetForm();
        }
    }
}
export class DeleteClassForm extends BaseFormHandler {
    constructor() {
        super(
            "deleteClassForm",
            "closeDeleteClassModal",
            "deleteClassModal",
            'input[name="classes[]"]',
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
export class EditClassForm extends BaseFormHandler {
    constructor() {
        super(
            "editClassForm",
            "closeEditClassModal",
            "editClassModal",
            'input[name^="classes["][type="checkbox"]',
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
export class ClassFilter extends BaseFilter {
    constructor() {
        super({
            route: window.Laravel?.routes?.classesIndex,
            itemsContainerSelector: ".card-items-scroll",
            paginationContainerSelector: "#pagination-wrapper",
            searchInputSelector: 'input[name="search"]',
            clearButtonSelector: "#clearFilterLevelSelection",
        });
    }

    init() {
        super.init();
        this.checkboxes = document.querySelectorAll(".category-checkbox");
        this.filterForm = document.getElementById("filterLevelClassForm");

        // Inisialisasi khusus class
        if (this.itemsContainer) {
            this.initCheckboxes();
        }
    }
    initCheckboxes() {
        this.checkboxes.forEach((checkbox) => {
            checkbox.addEventListener("change", () => {
                this.handleFilter();
            });
        });
    }
    getFilterParams() {
        const params = new URLSearchParams();
        const selectedLevels = Array.from(this.checkboxes)
            .filter((cb) => cb.checked)
            .map((cb) => cb.value);

        selectedLevels.forEach((level) => {
            params.append("levels[]", level);
        });

        if (this.searchInput && this.searchInput.value.trim()) {
            params.set("search", this.searchInput.value.trim());
        }

        return params;
    }
    restoreInputState() {
        const urlParams = new URLSearchParams(window.location.search);
        const levels = urlParams.getAll("levels[]");

        this.checkboxes.forEach((checkbox) => {
            checkbox.checked = levels.includes(checkbox.value);
        });
    }
    resetInputs() {
        this.checkboxes.forEach((cb) => (cb.checked = false));
        if (this.searchInput) this.searchInput.value = "";
    }
}
