import BaseFormHandler from "../handler/BaseFormHandler.js";

// Unit Add Form
// =========== UNIT ADD FORM ================
export class UnitForm extends BaseFormHandler {
    constructor() {
        super("addUnitForm", "closeUnitModal", "addUnitModal");
        this.initializeUnitSpecifics();
        this.setupUnitListeners();
    }

    initializeUnitSpecifics() {
        this.itemSelect = document.getElementById("item_id");
        this.unitNameInput = document.getElementById("unit_name");
        this.imageInput = document.getElementById("itemAddImageUnitInput");
        this.imagePreview = document.getElementById("itemAddImageUnitPreview");
        this.hiddenItemName = document.getElementById("item_name_hidden");
    }

    resetForm() {
        super.resetForm();
        this.itemSelect.selectedIndex = 0;
        this.imagePreview.src = "https://placehold.co/100";
        this.hiddenItemName.value = "";
    }

    setupUnitListeners() {
        this.itemSelect.addEventListener("change", () => {
            const selectedOption =
                this.itemSelect.options[this.itemSelect.selectedIndex];
            this.hiddenItemName.value = selectedOption.text;
        });
    }
}

export class DeleteUnitForm extends BaseFormHandler {
    constructor() {
        super(
            "deleteUnitForm",
            "closeUnitDeleteModal",
            "deleteUnitModal",
            'input[name="item-units[]"]',
        );
    }

    resetForm() {
        super.resetForm();
        this.checkboxes.forEach((checkbox) => {
            checkbox.checked = false;
            checkbox
                .closest(".unit-card")
                ?.classList.replace("opacity-100", "opacity-50");
        });
    }
}
/** ===========  Unit Handler ================  */
export class UnitHandler {
    constructor() {
        this.setupFormAssociation();
        this.setupToggleListeners();
    }

    // Instance method (tanpa static)
    setupFormAssociation() {
        document
            .querySelectorAll("#rightEdit input, #rightEdit select")
            .forEach((input) => {
                if (!input.hasAttribute("form")) {
                    input.setAttribute("form", "infoEdit");
                }
            });
    }

    setupToggleListeners() {
        document.querySelectorAll(".unit-checkbox").forEach((checkbox) => {
            checkbox.addEventListener("change", this.handleToggle.bind(this));
            checkbox.dispatchEvent(new Event("change"));
        });
    }

    handleToggle(event) {
        const checkbox = event.target;
        const card = checkbox.closest(".unit-card");
        card.classList.toggle("opacity-100", checkbox.checked);
        card.classList.toggle("opacity-50", !checkbox.checked);

        const inputs = card.querySelectorAll(
            "input:not(.unit-checkbox), select, textarea",
        );
        inputs.forEach((input) => {
            input.disabled = !checkbox.checked;
            input.classList.toggle("select-none", !checkbox.checked);
        });
    }
}
