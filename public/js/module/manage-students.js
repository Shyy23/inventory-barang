import {
    DeleteStudentForm,
    EditStudentForm,
    StudentFilter,
} from "../class/Student.js";
import { Modal } from "../handler/Modal.js";
import ToggleHandler from "../handler/ToggleHandler.js";

document.addEventListener("DOMContentLoaded", () => {
    new StudentFilter();
    new ToggleHandler();
    new DeleteStudentForm();
    new EditStudentForm();
    new Modal(
        "editStudentModal",
        "editStudentContainerModal",
        "showEditStudentModal",
        "closeEditStudentModal",
    );
    new Modal(
        "deleteStudentModal",
        "deleteStudentContainerModal",
        "showDeleteStudentModal",
        "closeDeleteStudentModal",
    );
    new Modal(
        "infoClassModal",
        "infoClassContainerModal",
        "showInfoClassModal",
        "closeInfoClassModal",
    );
    SwalHelper.handleConfirmation(
        "deleteStudentButton",
        "deleteStudentForm",
        "Apakah Anda Yakin?",
        "Data ini akan dihapus secara permanen",
    );
    SwalHelper.handleConfirmation(
        "editStudentButton",
        "editStudentForm",
        "Apakah Anda Yakin diubah?",
        "Pastikan anda sudah yakin!",
    );
});
