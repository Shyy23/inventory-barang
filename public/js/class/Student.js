import BaseFormHandler from "../handler/BaseFormHandler.js";
import BaseFilter from "../handler/Filter.js";

export class DeleteStudentForm extends BaseFormHandler {
    constructor() {
        super(
            "deleteStudentForm",
            "closeDeleteStudentModal",
            "deleteStudentModal",
            'input[name="students[]"]',
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
export class EditStudentForm extends BaseFormHandler {
    constructor() {
        super(
            "editStudentForm",
            "closeEditStudentModal",
            "editStudentModal",
            'input[name^="students["][type="checkbox"]',
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

export class StudentFilter extends BaseFilter {
    constructor() {
        super({
            route: window.Laravel?.routes?.studentsIndex,
            itemsContainerSelector: ".student-list",
            paginationContainerSelector: "#pagination-wrapper",
            searchInputSelector: 'input[name="search"]',
            clearButtonSelector: "#clearFilterSelection",
        });
    }
    // Override: Ambil parameter filter (hanya search)
    getFilterParams() {
        const params = new URLSearchParams();

        // Tambahkan search jika ada nilai
        if (this.searchInput && this.searchInput.value.trim()) {
            params.set("search", this.searchInput.value.trim());
        }

        return params;
    }
    updateContent(data) {
        // Update konten
        this.itemsContainer.innerHTML = data.html;

        // Update pagination
        if (this.paginationContainer) {
            this.paginationContainer.innerHTML = data.pagination;
        }

        // Jalankan ulang DynamicIconHandler
        this.runDynamicIconHandler();
    }
    runDynamicIconHandler() {
        // Pastikan elemen sudah ada
        const studentList = document.querySelector(".student-list");
        if (!studentList) return;

        // Jalankan handler untuk gender icon
        new DynamicIconHandler(".student-list");
    }
    // Override: Pulihkan nilai input dari URL
    restoreInputState() {
        const urlParams = new URLSearchParams(window.location.search);
        const search = urlParams.get("search");

        if (search && this.searchInput) {
            this.searchInput.value = search;
        }
    }

    // Override: Reset input filter
    resetInputs() {
        if (this.searchInput) {
            this.searchInput.value = ""; // Kosongkan input pencarian
        }
    }
}
