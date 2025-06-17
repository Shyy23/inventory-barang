import { ItemFilter, ItemForm } from "./../class/ItemDetailHandler.js";
import { Modal } from "../handler/Modal.js";
import { UnitForm } from "./../class/UnitHandler.js";

import Dropdown from "../handler/Dropdown.js";
import ImagePreview from "../handler/ImagePreview.js";

// Initialize Class
document.addEventListener("DOMContentLoaded", function () {
    new ImagePreview("#itemAddImageInput", "#itemAddImagePreview");
    new ImagePreview("#itemAddImageUnitInput", "#itemAddImageUnitPreview");
    new ItemFilter();
    new UnitForm();
    new ItemForm();
    new Modal(
        "addUnitModal",
        "addUnitContainerModal",
        "openUnitModal",
        "closeUnitModal",
    );
    new Modal(
        "addItemModal",
        "addItemContainerModal",
        "openItemModal",
        "closeItemModal",
    );
    // Inisialisasi global listeners
    Dropdown.initGlobalListeners();

    // Inisialisasi semua dropdown di halaman
    document.querySelectorAll(".dropdown").forEach((container) => {
        new Dropdown(`#${container.id}`);
    });
    function confirmExport(event, format) {
        event.preventDefault();

        // Tampilkan konfirmasi SweetAlert
        SwalHelper.showWarning({
            title: "Apakah Anda yakin?",
            text: `Anda akan mencetak file dalam format ${format.toUpperCase()}.`,
            confirmButtonText: "Ya, cetak!",
        }).then((result) => {
            if (result.isConfirmed) {
                // Tampilkan notifikasi sukses
                SwalHelper.showSuccess({
                    title: "Berhasil!",
                    text: `File berhasil diekspor ke format ${format.toUpperCase()}.`,
                });

                // Redirect ke URL unduhan file
                window.location.href = event.target.closest("a").href;
            }
        });
    }

    // Handler untuk ekspor PDF
    document
        .getElementById("export-pdf")
        .addEventListener("click", function (event) {
            confirmExport(event, "pdf");
        });

    // Handler untuk ekspor Excel
    document
        .getElementById("export-excel")
        .addEventListener("click", function (event) {
            confirmExport(event, "excel");
        });
});
