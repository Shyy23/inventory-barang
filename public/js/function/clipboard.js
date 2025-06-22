function copyPhoneNumber(phoneNumber) {
    navigator.clipboard
        .writeText(phoneNumber)
        .then(() => {
            SwalHelper.showSuccess({
                title: "Berhasil!",
                text: "Nomor berhasil dicopy ke clipboard",
            });
        })
        .catch((err) => {
            console.error("Gagal menyalin teks:", err);
            SwalHelper.showError({
                title: "Gagal!",
                text: "Tidak dapat menyalin nomor ke clipboard",
            });
        });
}
