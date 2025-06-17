import BaseFormHandler from "../handler/BaseFormHandler.js";
import BaseFilter from "../handler/Filter.js";

/** ===========  EDIT MODE ================  */
export class EditMode {
    constructor(showEditMode, closeEditMode, formEdit) {
        this.editToggle = document.getElementById(showEditMode);
        this.closeEditMode = document.getElementById(closeEditMode);
        this.displayElements = document.querySelectorAll(
            "#imageDisplay, #infoDisplay, #rightDisplay",
        );
        this.editElements = document.querySelectorAll(
            "#imageEdit, #infoEdit , #rightEdit",
        );
        this.editForm = document.getElementById(formEdit);

        // Simpan nilai awal
        this.originalFormData = new FormData(this.editForm);
        // gambar Utama
        this.originalImage = document.querySelector("#imageDisplay img").src;
        // Periksa apakah #rightEdit ada
        const rightEditElement = document.getElementById("rightEdit");
        if (rightEditElement) {
            this.rightEdit = rightEditElement;

            // Simpan nilai awal gambar unit jika #rightEdit ada
            this.originalUnitImages = new Map();
            this.rightEdit.querySelectorAll(".unit-card").forEach((card) => {
                const unitId = card.dataset.unitId;
                const previewImg = card.querySelector(".unit-image-preview");
                this.originalUnitImages.set(unitId, previewImg.src);
            });
        } else {
            // Jika #rightEdit tidak ada, abaikan logika untuk unit card
            this.rightEdit = null;
            this.originalUnitImages = null;
        }

        this.setupListeners();
    }

    enable() {
        document.body.classList.add("edit-mode");
        this.displayElements.forEach((el) =>
            el.classList.replace("block", "hidden"),
        );
        this.editElements.forEach((el) =>
            el.classList.replace("hidden", "block"),
        );
    }
    disable() {
        document.body.classList.remove("edit-mode");
        this.displayElements.forEach((el) =>
            el.classList.replace("hidden", "block"),
        );
        this.editElements.forEach((el) =>
            el.classList.replace("block", "hidden"),
        );

        this.resetForm();
    }

    resetForm() {
        this.editForm.reset();

        // Reset Nilai Select
        const selects = this.editForm.querySelectorAll("select");
        selects.forEach((select) => {
            const originalValue = this.originalFormData.get(select.name);
            select.value = originalValue;
        });
        // Reset Nilai textarea
        const textareas = this.editForm.querySelectorAll("textarea");
        textareas.forEach((textarea) => {
            const originalValue = this.originalFormData.get(textarea.name);
            textarea.value = originalValue;
        });

        // Reset gambar utama
        const imagePreview = document.getElementById("imagePreview");
        imagePreview.src = this.originalImage;
        const fileInput = document.getElementById("imageInput");
        fileInput.value = "";

        // Reset gambar unit card hanya jika #rightEdit ada
        if (this.rightEdit) {
            this.rightEdit.querySelectorAll(".unit-card").forEach((card) => {
                const unitId = card.dataset.unitId;
                const previewImg = card.querySelector(".unit-image-preview");
                previewImg.src = this.originalUnitImages.get(unitId);
            });
        }
    }
    setupListeners() {
        this.editToggle.addEventListener("click", () => this.enable());
        this.closeEditMode.addEventListener("click", () => this.disable());

        document
            .getElementById("imageInput")
            .addEventListener("change", (e) => {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = (event) => {
                        document.getElementById("imagePreview").src =
                            event.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            });
    }
}

// =========== ITEM ADD FORM ================
export class ItemForm extends BaseFormHandler {
    constructor() {
        super("addItemForm", "closeItemModal", "addItemModal");
        this.initializeItemSpecifics();
        this.setupItemListeners();
    }

    initializeItemSpecifics() {
        this.itemNameInput = document.getElementById("item_name");
        this.categorySelect = document.getElementById("category_id");
        this.locationSelect = document.getElementById("location_id");
        this.itemTypeSelect = document.getElementById("item_type");
        this.stockInput = document.getElementById("stock");
        this.descriptionInput = document.getElementById("description");
        this.imageInput = document.getElementById("itemAddImageInput");
        this.imagePreview = document.getElementById("itemAddImagePreview");
        this.stockContainer = document.getElementById("itemAddStockContainer");
    }

    resetForm() {
        super.resetForm(); // Panggil reset dasar

        // Reset tambahan khusus ItemForm
        this.categorySelect.selectedIndex = 0;
        this.locationSelect.selectedIndex = 0;
        this.itemTypeSelect.selectedIndex = 0;
        this.imagePreview.src = "https://placehold.co/100";
        this.itemTypeSelect.dispatchEvent(new Event("change"));
    }

    setupItemListeners() {
        this.itemTypeSelect.addEventListener("change", () =>
            this.toggleStockVisibility(),
        );
    }

    toggleStockVisibility() {
        const isConsumable = this.itemTypeSelect.value === "consumable";
        this.stockContainer.classList.toggle("hidden", !isConsumable);
        this.stockInput.required = isConsumable;
        if (!isConsumable) this.stockInput.value = 0;
    }
}

// Filtering Item
export class ItemFilter extends BaseFilter {
    constructor() {
        super({
            route: window.Laravel?.routes?.itemsIndex,
            itemsContainerSelector: ".card-items-scroll",
            paginationContainerSelector: "#pagination-wrapper",
            searchInputSelector: 'input[name="search"]',
            clearButtonSelector: "#clearFilterSelection",
        });
    }

    init() {
        super.init();
        this.checkboxes = document.querySelectorAll(".category-checkbox");
        this.filterForm = document.getElementById("filterForm");
        this.exportLinks = {
            pdf: null,
            excel: null,
        };
        // Dapatkan referensi ke link ekspor
        this.exportLinks.pdf = document.getElementById("export-pdf");
        this.exportLinks.excel = document.getElementById("export-excel");
        // Inisialisasi khusus item
        if (this.itemsContainer) {
            this.initCheckboxes();
            this.updateExportLinks(); // Perbarui link saat pertama kali load

            // Tambahkan observer untuk perubahan AJAX
            this.setupMutationObserver();
        }
    }

    initCheckboxes() {
        this.checkboxes.forEach((checkbox) => {
            checkbox.addEventListener("change", () => {
                this.handleFilter();
                this.updateExportLinks();
            });
        });
    }

    // Override handleFilter untuk tambahkan update link
    handleFilter() {
        super.handleFilter();
        this.updateExportLinks();
    }

    // Override clearFilters untuk update link
    clearFilters() {
        super.clearFilters();
        this.updateExportLinks();
    }

    updateExportLinks() {
        const params = this.getFilterParams();
        const queryString = params.toString();

        if (this.exportLinks.pdf) {
            this.exportLinks.pdf.href = `${this.exportLinks.pdf.dataset.baseUrl}?${queryString}`;
        }

        if (this.exportLinks.excel) {
            this.exportLinks.excel.href = `${this.exportLinks.excel.dataset.baseUrl}?${queryString}`;
        }
    }
    getFilterParams() {
        const params = new URLSearchParams();
        const selectedCategories = Array.from(this.checkboxes)
            .filter((cb) => cb.checked)
            .map((cb) => cb.value);

        selectedCategories.forEach((category) => {
            params.append("categories[]", category);
        });

        if (this.searchInput && this.searchInput.value.trim()) {
            params.set("search", this.searchInput.value.trim());
        }

        return params;
    }

    restoreInputState() {
        const urlParams = new URLSearchParams(window.location.search);
        const categories = urlParams.getAll("categories[]");

        this.checkboxes.forEach((checkbox) => {
            checkbox.checked = categories.includes(checkbox.value);
        });
    }

    resetInputs() {
        this.checkboxes.forEach((cb) => (cb.checked = false));
        if (this.searchInput) this.searchInput.value = "";
    }
    // Deteksi perubahan konten AJAX
    setupMutationObserver() {
        const observer = new MutationObserver(() => {
            this.updateExportLinks();
        });

        observer.observe(this.itemsContainer, {
            childList: true,
            subtree: true,
        });
    }
}
