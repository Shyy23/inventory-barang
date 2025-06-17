import { EditMode } from "./../class/ItemDetailHandler.js";
import { LoanForm } from "./../class/LoanHandler.js";
import { Modal } from "../handler/Modal.js";
import ImagePreview from "../handler/ImagePreview.js";
import { DeleteUnitForm, UnitHandler } from "./../class/UnitHandler.js";
import Dropdown from "../handler/Dropdown.js";

/** ===========  CLASS INIT ================  */
document.addEventListener("DOMContentLoaded", () => {
    new EditMode("editToggle", "closeEditItem", "infoEdit");
    // Main image preview
    new ImagePreview("#imageInput", "#imagePreview");
    // Unit images preview (handle semua input dengan class unit-image-input)
    new ImagePreview(
        "#rightEdit .unit-image-input",
        "#rightEdit .unit-image-preview",
    );
    new UnitHandler(); // Inisialisasi instance untuk toggle
    new LoanForm();
    new Modal(
        "loanModal",
        "loanModalContainer",
        "showLoanModal",
        "closeLoanModal",
    );

    const deleteUnitModal = document.getElementById("deleteUnitModal");
    if (deleteUnitModal) {
        // Inisialisasi Dropdown
        new Dropdown(".dropdown");
        Dropdown.initGlobalListeners();
        new DeleteUnitForm();
        new Modal(
            "deleteUnitModal",
            "deleteUnitContainerModal",
            "showUnitDeleteModal",
            "closeUnitDeleteModal",
        );
        SwalHelper.handleConfirmation(
            "deleteUnitButton",
            "deleteUnitForm",
            "Apakah Anda Yakin?",
            "Data ini akan dihapus secara permanen",
        );
    }

    /** ===========  ALERT CONFIRM ================  */

    SwalHelper.handleConfirmation(
        "deleteItemButton",
        "deleteItemForm",
        "Apakah Anda Yakin?",
        "Data ini akan dihapus secara permanen",
    );
    SwalHelper.handleConfirmation(
        "editBarang",
        "infoEdit",
        "Apakah Anda Yakin diubah?",
        "Pastikan anda sudah yakin!",
        "Ya, simpan!",
    );
});
