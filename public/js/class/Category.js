import BaseFormHandler from "../handler/BaseFormHandler.js";

// Delete Category Handler
export class DeleteCategoryForm extends BaseFormHandler {
    constructor() {
        super(
            "deleteCategoryForm",
            "closeDeleteCategoryModal",
            "deleteCategoryModal",
            'input[name="categories[]"]',
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

// Edit Category Handler
export class EditCategoryForm extends BaseFormHandler {
    constructor() {
        super(
            "editCategoryForm",
            "closeEditCategoryModal",
            "editCategoryModal",
            'input[name^="categories["][type="checkbox"]',
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

// Add Category Handler
export class AddCategoryForm extends BaseFormHandler {
    constructor() {
        super("addCategoryForm", "closeCategoryModal", "addCategoryModal");
    }

    resetForm() {
        if (this.form) {
            super.resetForm();
        }
    }
}
