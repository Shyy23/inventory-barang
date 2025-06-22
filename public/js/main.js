class Sidebar {
    constructor(toggleBtnId, sidebarId, overlayId, menuBtnId, closeBtnId) {
        // Ambil elemen DOM yang diperlukan
        this.toggleButton = document.getElementById(toggleBtnId);
        this.sidebar = document.getElementById(sidebarId);
        this.overlay = document.getElementById(overlayId);
        this.menuBtn = document.getElementById(menuBtnId);
        this.closeBtn = document.getElementById(closeBtnId);
        this.dropdownButtons = this.sidebar.querySelectorAll(".dropdown__btn");

        // Binding event listeners
        this.init();
    }

    // Inisialisasi event listeners
    init() {
        this.toggleButton.addEventListener("click", () => this.toggleSidebar());
        this.menuBtn.addEventListener("click", () => this.showSidebar());
        this.closeBtn.addEventListener("click", () => this.hideSidebar());
        this.overlay.addEventListener("click", () => this.hideSidebar());
        document.addEventListener("keydown", (event) =>
            this.handleKeydown(event),
        );
        this.dropdownButtons.forEach((button) => {
            button.addEventListener("click", (e) =>
                this.toggleSubMenu(e.currentTarget),
            );
        });
        window.addEventListener("resize", () => this.handleResize());
    }

    // Fungsi untuk toggle sidebar (menutup/membuka sidebar)
    toggleSidebar() {
        this.sidebar.classList.toggle("close");
        this.toggleButton.classList.toggle("rotate");
        this.closeAllSubMenus();
    }

    // Fungsi untuk toggle submenu
    toggleSubMenu(button) {
        const submenu = button.nextElementSibling;
        const isOpening = !submenu.classList.contains("show");

        this.closeAllSubMenus();

        if (isOpening) {
            submenu.classList.add("show");
            button.classList.add("rotate");

            // Jika sidebar dalam mode tertutup (desktop), buka sidebar
            if (this.sidebar.classList.contains("close")) {
                this.toggleSidebar();
            }
        }
    }

    // Fungsi untuk menutup semua submenu yang sedang terbuka
    closeAllSubMenus() {
        this.dropdownButtons.forEach((button) => {
            button.classList.remove("rotate");
            button.nextElementSibling.classList.remove("show");
        });
    }

    // Fungsi untuk menampilkan sidebar (digunakan pada tampilan mobile)
    showSidebar() {
        this.sidebar.classList.add("active");
        this.overlay.classList.add("active");
    }

    // Fungsi untuk menyembunyikan sidebar
    hideSidebar() {
        this.sidebar.classList.remove("active");
        this.overlay.classList.remove("active");
    }

    // Handle keydown (Escape key)
    handleKeydown(event) {
        if (
            event.key === "Escape" &&
            this.sidebar.classList.contains("active")
        ) {
            this.hideSidebar();
        }
    }

    // Handle resize dengan debounce
    handleResize() {
        let resizeTimeout;
        clearTimeout(resizeTimeout);
        resizeTimeout = setTimeout(() => {
            if (window.innerWidth <= 1620) {
                this.sidebar.classList.remove("active", "close");
                this.overlay.classList.remove("active");
            } else {
                this.overlay.classList.remove("active");
            }
        }, 100);
    }
}

class DynamicIconHandler {
    static config = {
        status: {
            selector: ".status__icon",
            dataAttr: "data-status",
            iconMap: {
                borrowed: {
                    classes: ["fa-clock", "purple"],
                    tooltip: "Dipinjam",
                },
                returned: {
                    classes: ["fa-check-circle", "green"],
                    tooltip: "Dikembalikan",
                },
                damaged: {
                    classes: ["fa-triangle-exclamation", "red"],
                    tooltip: "Rusak",
                },
                pending: {
                    classes: ["fa-circle-exclamation", "yellow"],
                    tooltip: "Tertunda",
                },
                rejected: {
                    classes: ["fa-circle-xmark", "red"],
                    tooltip: "Ditolak",
                },
            },
        },
        stock: {
            selector: ".item-stock",
            dataAttr: "data-stock",
            iconMap: {
                0: { class: "fa-circle-xmark red", tooltip: "Stok Habis" },
                5: {
                    class: "fa-triangle-exclamation red",
                    tooltip: "Stok Hampir Habis",
                },
                10: {
                    class: "fa-circle-exclamation yellow",
                    tooltip: "Stok Menipis",
                },
                default: {
                    class: "fa-check-circle green",
                    tooltip: "Stok Aman",
                },
            },
        },
        gender: {
            selector: ".gender-student",
            dataAttr: "data-gender",
            iconMap: {
                male: {
                    class: "fa-mars blue", // Tambahkan class warna jika diperlukan
                    tooltip: "Laki-laki",
                },
                female: {
                    class: "fa-venus pink", // Tambahkan class warna jika diperlukan
                    tooltip: "Perempuan",
                },
                unknown: {
                    class: "fa-question",
                    tooltip: "Tidak Diketahui",
                },
            },
        },
    };

    constructor(containerSelector) {
        this.container = document.querySelector(containerSelector);
        if (!this.container) return;

        this.init();
        this.setupObserver();
    }

    init() {
        this.updateIcons("status");
        this.updateIcons("stock");
        this.updateIcons("gender");
    }

    updateIcons(type) {
        const { selector, dataAttr, iconMap } = DynamicIconHandler.config[type];

        this.container.querySelectorAll(selector).forEach((element) => {
            const rawValue = element.getAttribute(dataAttr); // Ambil nilai mentah

            let value = NaN;
            if (type === "stock") {
                value = parseInt(rawValue, 10);
                if (isNaN(value)) {
                    console.warn(`Invalid stock value for element:`, element);
                    value = 0; // Fallback ke 0 jika invalid
                }
            } else {
                value = rawValue;
            }

            const icon = element.querySelector("i");
            const tooltip = element.querySelector("[data-tooltip]");

            this.applyIconConfig(type, value, icon, tooltip);
        });
    }
    applyIconConfig(type, value, icon, tooltip) {
        const config = this.getConfig(type, value);

        // Update icon class
        icon.className = `fas ${type === "status" ? config.classes.join(" ") : config.class}`;

        // Update tooltip attribute
        if (tooltip) {
            tooltip.setAttribute("data-tooltip", config.tooltip);
        }
    }
    getConfig(type, value) {
        if (type === "stock") {
            if (value === 0) return DynamicIconHandler.config.stock.iconMap[0]; // Stok Habis
            if (value <= 5) return DynamicIconHandler.config.stock.iconMap[5]; // Stok Hampir Habis
            if (value <= 10) return DynamicIconHandler.config.stock.iconMap[10]; // Stok Menipis
            if (value >= 11)
                return DynamicIconHandler.config.stock.iconMap.default; // Stok Aman
            // Jika nilai antara 10 dan 20, gunakan konfigurasi default (atau tambahkan logika khusus)
            return DynamicIconHandler.config.stock.iconMap.default;
        } else if (type === "gender") {
            return DynamicIconHandler.config.gender.iconMap[value] || {};
        }
        return DynamicIconHandler.config.status.iconMap[value] || {};
    }

    setupObserver() {
        const observer = new MutationObserver(() => this.init());
        observer.observe(this.container, {
            childList: true,
            subtree: true,
        });
    }
}

// Atur ikon status setelah DOM selesai dimuat
document.addEventListener("DOMContentLoaded", () => {
    new DynamicIconHandler(".card-items-scroll");
    new DynamicIconHandler(".stock-info-item"); // Untuk stok barang
    new DynamicIconHandler(".student-list");
    new DynamicIconHandler("#aktivitasTerbaru");
    new Sidebar("toggle-btn", "sidebar", "overlay", "menu-btn", "close-btn");

    SwalHelper.handleConfirmation(
        "logout",
        "formLogout",
        "Apakah Anda yakin ingin logout?",
        "Anda akan keluar dari sesi ini.",
        "Ya, logout!",
    );
});
