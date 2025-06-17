import BaseFormHandler from "../handler/BaseFormHandler.js";

/** ===========  LOAN FORM ================  */
export class LoanForm extends BaseFormHandler {
    constructor() {
        super("loanForm", "closeLoanModal", "loanModal");
        this.initializeLoanSpecifics();
        this.setupLoanListeners();
    }

    initializeLoanSpecifics() {
        this.loanType = document.getElementById("loanType");
        this.step1 = document.getElementById("step1");
        this.step2 = document.getElementById("step2");
        this.nextBtn = document.getElementById("nextBtn");
        this.prevBtn = document.getElementById("prevBtn");
        this.submitIndividu = document.getElementById("submitIndividu");
        this.loanItemId = document.getElementById("loanItemInputId");
        this.itemType = document.getElementById("loanItemType");
        this.dataType = this.itemType.getAttribute("data-type");

        if (this.dataType === "unit") {
            this.unitRadios = document.querySelectorAll(
                'input[name="unit_data"]',
            );
            this.selectedUnitId = document.getElementById("selectedUnitId");
        }
    }
    handleLoanTypeChange() {
        const isKelas = this.loanType.value === "kelas";
        this.toggleNextButton(isKelas);
        this.toggleSubmitButton(!isKelas);
    }

    handleUnitSelection(radio) {
        const unitData = JSON.parse(radio.value);

        // Update Hidden Inputs
        this.selectedUnitId.value = unitData.unit_id;
    }
    toggleNextButton(show) {
        this.nextBtn.classList.toggle("hidden", !show);
        this.nextBtn.classList.toggle("block", show);
    }
    toggleSubmitButton(show) {
        this.submitIndividu.classList.toggle("hidden", !show);
        this.submitIndividu.classList.toggle("block", show);
    }
    showStep2() {
        this.step1.classList.add("hidden");
        this.step2.classList.remove("hidden");
        this.step2.classList.add("grid");
    }
    showStep1() {
        this.step2.classList.remove("grid");
        this.step2.classList.add("hidden");
        this.step1.classList.remove("hidden");
    }

    updateStockLimit(e) {
        const maxStock =
            e.target.option[e.target.selectedIndex].getAttribute("data-stock");
        document.getElementById("loanInputQuantity").max = maxStock;
    }

    resetForm() {
        super.resetForm();
        this.showStep1();
        if (this.dataType === "unit") {
            this.unitRadios.forEach((radio) => {
                radio.checked = false;
                radio
                    .closest(".unit-card")
                    ?.classList.remove(
                        "peer-checked:border-[--primary-clr]",
                        "peer-checked:ring-2",
                    );
            });
            this.selectedUnitId.value = "";
            document.querySelectorAll(".fa-check-circle").forEach((icon) => {
                icon.classList.add("hidden");
            });
        }

        // Reset tampilan tombol
        this.submitIndividu.classList.replace("hidden", "block");
        this.nextBtn.classList.replace("block", "hidden");
    }

    setupLoanListeners() {
        this.loanType.addEventListener("change", () =>
            this.handleLoanTypeChange(),
        );
        this.nextBtn.addEventListener("click", () => this.showStep2());
        this.prevBtn.addEventListener("click", () => this.showStep1());
        this.loanItemId.addEventListener("change", (e) =>
            this.updateStockLimit(e),
        );

        // Hanya tambahkan listener jika item_type adalah unit
        if (this.dataType === "unit") {
            this.unitRadios.forEach((radio) => {
                radio.addEventListener("change", (e) => {
                    if (e.target.checked) {
                        this.handleUnitSelection(e.target);
                    }
                });
            });
        }
    }
}
