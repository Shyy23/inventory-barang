class Registration {
    constructor() {
        this.registerButton = document.getElementById("daftarButton");
        this.studentForm = document.getElementById("studentForm");
        this.guestButton = document.getElementById("guestButton");
        this.inputName = document.getElementById("nameRegister");
        this.inputEmail = document.getElementById("emailRegister");
        this.inputPassword = document.getElementById("passwordRegister");
        this.backButton = document.getElementById("backButton");
        this.initializeEventListeners();
    }

    initializeEventListeners() {
        this.registerButton?.addEventListener(
            "click",
            this.handleRegister.bind(this),
        );
        this.guestButton?.addEventListener(
            "click",
            this.handleGuest.bind(this),
        );
        this.studentForm?.addEventListener(
            "submit",
            this.handleStudent.bind(this),
        );
        this.backButton?.addEventListener("click", this.handleBack.bind(this));
    }

    handleBack() {
        // Enable step 1 inputs
        this.inputName.disabled = false;
        this.inputEmail.disabled = false;
        this.inputPassword.disabled = false;

        // Animate step transition
        document
            .querySelector(".step-2")
            .classList.add("translate-y-4", "opacity-0");
        setTimeout(() => {
            document.querySelector(".step-1").classList.remove("hidden");
            document.querySelector(".step-2").classList.add("hidden");
        }, 300);
    }
    handleRegister() {
        const formData = {
            name: this.inputName.value,
            email: this.inputEmail.value,
            password: this.inputPassword.value,
        };

        if (!this.validateInitialForm(formData)) return;

        // Disable step 1 inputs
        this.inputName.disabled = true;
        this.inputEmail.disabled = true;
        this.inputPassword.disabled = true;

        // Show step 2
        document
            .querySelector(".step-1")
            .classList.add("translate-y-4", "opacity-0");
        setTimeout(() => {
            document.querySelector(".step-1").classList.add("hidden");
            document.querySelector(".step-2").classList.remove("hidden");
            document.getElementById("student_name").value =
                this.inputName.value;
            document
                .querySelector(".step-2")
                .classList.remove("translate-y-4", "opacity-0");
        }, 300);
    }

    validateInitialForm({ name, email, password }) {
        if (!name || !email || !password) {
            SwalHelper.showError({
                title: "Oops....",
                text: "Harap isi semua kolom!",
            });
            return false;
        }

        return true;
    }

    showStudentModal(name) {
        this.studentModal?.classList.replace("hidden", "block");
        document.getElementById("student_name").value = name;
    }

    handleGuest() {
        const formData = {
            name: this.inputName.value,
            email: this.inputEmail.value,
            password: this.inputPassword.value,
            is_guest: true,
        };

        this.sendData(formData);
    }

    handleStudent(e) {
        e.preventDefault();
        const formData = new FormData(this.studentForm);

        const data = {
            name: this.inputName.value,
            email: this.inputEmail.value,
            password: this.inputPassword.value,
            nisn: formData.get("nisn"),
            student_name: formData.get("student_name"),
            gender: formData.get("gender"),
            class_id: formData.get("class_id"),
            phone_number: formData.get("phone_number"),
            address: formData.get("address"),
        };

        this.sendData(data);
    }

    async sendData(data) {
        try {
            const response = await fetch(route("register"), {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": document.querySelector(
                        'meta[name="csrf-token"]',
                    ).content,
                    Accept: "application/json",
                },
                body: this.createFormData(data),
            });

            await this.handleResponse(response);
        } catch (error) {
            this.handleError(error);
        }
    }

    createFormData(data) {
        const formData = new FormData();
        Object.entries(data).forEach(([key, value]) => {
            formData.append(key, value);
        });
        return formData;
    }

    async handleResponse(response) {
        if (response.ok) {
            await SwalHelper.showSuccess({
                text: "Pendaftaran Berhasil",
            });
            window.location.href = route("dashboard");
        } else {
            const errorData = await response.json();
            this.handleApiError(errorData);
        }
    }

    handleApiError(errorData) {
        if (errorData.errors) {
            let errorMessages = Object.values(errorData.errors)
                .map((messages) => messages.join("<br>"))
                .join("<br><br>");

            SwalHelper.showError({
                title: "Oops...",
                html: `<strong>Validasi Gagal!</strong><br>${errorMessages}`,
            });
        } else {
            SwalHelper.showError({
                title: "Oops...",
                text:
                    errorData.message ||
                    "Terjadi kesalahan, silakan coba lagi!",
            });
        }
    }

    handleError(error) {
        console.error("Error", error);
        SwalHelper.showError({
            title: "Oops...",
            text: "Terjadi Kesalahan. Silakan coba lagi!",
        });
    }
}

// Initialize

document.addEventListener("DOMContentLoaded", () => {
    new Registration();
});
