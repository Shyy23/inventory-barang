class SwalHelper {
    static defaultConfig = {
        color: "rgba(194,194,217,1)",
        background: "rgba(30,30,45,1)",
    };

    static themeColors = {
        success: {
            iconColor: "rgba(40,156,46,1)",
            confirmButtonColor: "rgba(40,156,46,1)",
        },
        info: {
            iconColor: "rgba(54,162,235,1)",
            confirmButtonColor: "rgba(54,162,235,1)",
        },
        warning: {
            iconColor: "rgba(238, 62, 100, 1)",
            confirmButtonColor: "rgba(40,156,46,1)",
            cancelButtonColor: 'rgba(238, 62, 100, 1)',
        },
        error: {
            iconColor: "rgba(238,62,100,1)",
            confirmButtonColor: "rgba(40,156,46,1)",
        },
    };
    static showSuccess(config) {
        return Swal.fire({
            icon: "success",
            showConfirmButton: false,
            timer: 1500,
            ...this.defaultConfig,
            ...this.themeColors.success,
            ...config,
        });
    }

    static showError(config) {
        return Swal.fire({
            icon: "error",
            ...this.defaultConfig,
            ...this.themeColors.error,
            ...config,
        });
    }

    static showWarning(config) {
        return Swal.fire({
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Ya, Lanjutkan!",
            cancelButtonText: "Batal",
            ...this.defaultConfig,
            ...this.themeColors.warning,
            ...config,
        });
    }

    static showInfo(config = {}) {
        return Swal.fire({
            icon: "info",
            ...this.defaultConfig,
            ...this.themeColors.info,
            ...config,
        });
    }
    
    static handleConfirmation(buttonId,formId,title,text,confirmText = 'Ya, lanjutkan'){
        document.getElementById(buttonId).addEventListener('click', (event) => {
            event.preventDefault();

            SwalHelper.showWarning({
                title: title,
                text: text,
                confirmButtonText: confirmText,
            }).then((result) => {
                if(result.isConfirmed){
                    document.getElementById(formId).submit();
                }
            })
        })
    }
}



