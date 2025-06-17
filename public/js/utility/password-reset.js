// Di awal file password-reset.js
axios.defaults.headers.common["X-CSRF-TOKEN"] = document.querySelector(
    'meta[name="csrf-token"]',
).content;
axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

document.addEventListener("alpine:init", () => {
    Alpine.data("passwordReset", () => ({
        step: 1,
        email: "",
        code: "",
        password: "",
        password_confirmation: "",
        isSending: false,

        async sendCode() {
            this.isSending = true;
            try {
                const response = await axios.post(routes.sendResetCode, {
                    email: this.email,
                });

                if (response.data.success) {
                    this.step = 2;
                    SwalHelper.showSuccess({
                        text: "Kode verifikasi telah dikirim ke email Anda",
                        timer: 3000,
                    });
                }
            } catch (error) {
                SwalHelper.showError({
                    text: error.response?.data?.message || "Terjadi kesalahan",
                });
            }
            this.isSending = false;
        },

        async verifyCode() {
            try {
                const response = await axios.post(window.routes.verifyCode, {
                    email: this.email,
                    code: this.code,
                });

                if (response.data.success) {
                    this.step = 3;
                }
            } catch (error) {
                SwalHelper.showError({
                    text: error.response?.data?.message || "Kode tidak valid",
                });
            }
        },

        async resetPassword() {
            try {
                const response = await axios.post(window.routes.resetPassword, {
                    email: this.email,
                    password: this.password,
                    password_confirmation: this.password_confirmation,
                });

                if (response.data.success) {
                    SwalHelper.showSuccess({
                        title: "Sukses!",
                        text: "Password berhasil direset",
                        timer: 3000,
                        willClose: () => {
                            window.location.href = "/";
                        },
                    });
                }
            } catch (error) {
                SwalHelper.showError({
                    title: "Error!",
                    text: error.response?.data?.message || "Terjadi kesalahan",
                });
            }
        },
    }));
});
