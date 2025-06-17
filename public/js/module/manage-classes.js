import {
    AddClassForm,
    ClassFilter,
    DeleteClassForm,
    EditClassForm,
} from "../class/ClassTable.js";
import { Modal } from "../handler/Modal.js";
import ToggleHandler from "../handler/ToggleHandler.js";

document.addEventListener("DOMContentLoaded", () => {
    new ClassFilter();
    new AddClassForm();
    new DeleteClassForm();
    new EditClassForm();
    new ToggleHandler();
    new Modal(
        "addClassModal",
        "addClassContainerModal",
        "showClassModal",
        "closeClassModal",
    );
    new Modal(
        "editClassModal",
        "editClassContainerModal",
        "showEditClassModal",
        "closeEditClassModal",
    );
    new Modal(
        "deleteClassModal",
        "deleteClassContainerModal",
        "showDeleteClassModal",
        "closeDeleteClassModal",
    );

    SwalHelper.handleConfirmation(
        "deleteClassButton",
        "deleteClassForm",
        "Apakah Anda Yakin?",
        "Data ini akan dihapus secara permanen",
    );
    SwalHelper.handleConfirmation(
        "editClassButton",
        "editClassForm",
        "Apakah Anda Yakin diubah?",
        "Pastikan anda sudah yakin!",
    );
});
