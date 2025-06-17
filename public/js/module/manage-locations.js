import {
    AddLocationForm,
    DeleteLocationForm,
    EditLocationForm,
    LocationFilter,
} from "../class/Location.js";
import { Modal } from "../handler/Modal.js";
import ToggleHandler from "../handler/ToggleHandler.js";

document.addEventListener("DOMContentLoaded", () => {
    new LocationFilter();
    new AddLocationForm();
    new DeleteLocationForm();
    new EditLocationForm();
    new ToggleHandler();
    new Modal(
        "addLocationModal",
        "addLocationContainerModal",
        "showLocationModal",
        "closeLocationModal",
    );
    new Modal(
        "deleteLocationModal",
        "deleteLocationContainerModal",
        "showDeleteLocationModal",
        "closeDeleteLocationModal",
    );
    new Modal(
        "editLocationModal",
        "editLocationContainerModal",
        "showEditLocationModal",
        "closeEditLocationModal",
    );

    SwalHelper.handleConfirmation(
        "deleteLocationButton",
        "deleteLocationForm",
        "Apakah Anda Yakin?",
        "Data ini akan dihapus secara permanen",
    );
    SwalHelper.handleConfirmation(
        "editLocationButton",
        "editLocationForm",
        "Apakah Anda Yakin diubah?",
        "Pastikan anda sudah yakin!",
    );
});
