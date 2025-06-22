import {
    AddCategoryForm,
    CategoryFilter,
    DeleteCategoryForm,
    EditCategoryForm,
} from "./../class/Category.js";
import { Modal } from "../handler/Modal.js";
import { ClearFilter } from "../handler/Filter.js";
import ToggleHandler from "../handler/ToggleHandler.js";

document.addEventListener("DOMContentLoaded", () => {
    new CategoryFilter();
    new DeleteCategoryForm();
    new EditCategoryForm();
    new AddCategoryForm();
    new ToggleHandler();
    new ClearFilter(["search"]);
    new Modal(
        "addCategoryModal",
        "addCategoryContainerModal",
        "showCategoryModal",
        "closeCategoryModal",
    );
    new Modal(
        "deleteCategoryModal",
        "deleteCategoryContainerModal",
        "showDeleteCategoryModal",
        "closeDeleteCategoryModal",
    );
    new Modal(
        "editCategoryModal",
        "editCategoryContainerModal",
        "showEditCategoryModal",
        "closeEditCategoryModal",
    );
    SwalHelper.handleConfirmation(
        "deleteCategoryButton",
        "deleteCategoryForm",
        "Apakah Anda Yakin?",
        "Data ini akan dihapus secara permanen",
    );
    SwalHelper.handleConfirmation(
        "editCategoryButton",
        "editCategoryForm",
        "Apakah Anda Yakin diubah?",
        "Pastikan anda sudah yakin!",
    );
});
