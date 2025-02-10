// Ambil elemen DOM yang diperlukan

const toggleButton = document.getElementById("toggle-btn");
const sidebar = document.getElementById("sidebar");
const overlay = document.getElementById("overlay");
const menuBtn = document.getElementById("menu-btn");
const closeBtn = document.getElementById("close-btn");

// Fungsi untuk toggle sidebar (menutup/membuka sidebar)
const toggleSidebar = () => {
    sidebar.classList.toggle("close");
    toggleButton.classList.toggle("rotate");
    closeAllSubMenus();
};

// Fungsi untuk toggle submenu
const toggleSubMenu = (button) => {
    const submenu = button.nextElementSibling;
    if (!submenu.classList.contains("show")) {
        closeAllSubMenus();
    }
    submenu.classList.toggle("show");
    button.classList.toggle("rotate");

    // Jika sidebar dalam kondisi tertutup, buka sidebar terlebih dahulu
    if (sidebar.classList.contains("close")) {
        sidebar.classList.toggle("close");
        toggleButton.classList.toggle("rotate");
    }
};

// Fungsi untuk menutup semua submenu yang sedang terbuka
const closeAllSubMenus = () => {
    const openSubmenus = sidebar.getElementsByClassName("show");
    Array.from(openSubmenus).forEach((submenu) => {
        submenu.classList.remove("show");
        if (submenu.previousElementSibling) {
            submenu.previousElementSibling.classList.remove("rotate");
        }
    });
};

// Fungsi untuk menampilkan sidebar (digunakan pada tampilan mobile)
const showSidebar = () => {
    sidebar.classList.add("active");
    overlay.classList.add("active");
};

// Fungsi untuk menyembunyikan sidebar
const hideSidebar = () => {
    sidebar.classList.remove("active");
    overlay.classList.remove("active");
};

// Pasang event listener untuk tombol menu, tombol close, dan overlay
menuBtn.addEventListener("click", showSidebar);
closeBtn.addEventListener("click", hideSidebar);
overlay.addEventListener("click", hideSidebar);

// Tutup sidebar ketika tombol Escape ditekan
document.addEventListener("keydown", (event) => {
    if (event.key === "Escape" && sidebar.classList.contains("active")) {
        hideSidebar();
    }
});

// Fungsi untuk menangani perubahan ukuran layar
const handleResize = () => {
    if (window.innerWidth <= 1240) {
        // Pada tampilan kecil, pastikan sidebar dan overlay tidak aktif dan submenu ditutup
        sidebar.classList.remove("active", "close");
        overlay.classList.remove("active");
    } else {
        // Pada tampilan besar, pastikan overlay tidak aktif
        overlay.classList.remove("active");
    }
};

window.addEventListener("resize", handleResize);

// Atur ikon status setelah DOM selesai dimuat
document.addEventListener("DOMContentLoaded", () => {
    const items = document.querySelectorAll(".item-stock");
    const statusIcons = document.querySelectorAll(".status__icon");

    // Objek konfigurasi untuk status
    const statusConfig = {
        borrowed: { classes: ["fa-clock", "purple"], tooltip: "Dipinjam" },
        returned: {
            classes: ["fa-check-circle", "green"],
            tooltip: "Dikembalikan",
        },
        damaged: {
            classes: ["fa-triangle-exclamation", "red"],
            tooltip: "Rusak",
        },
        delayed: {
            classes: ["fa-circle-exclamation", "yellow"],
            tooltip: "Tertunda",
        },
    };

    statusIcons.forEach((icon) => {
        const status = icon.getAttribute("data-status");
        const iconElement = icon.querySelector("i");
        const tooltipElement = icon.querySelector(".status__tooltip");

        if (statusConfig[status]) {
            iconElement.classList.add(...statusConfig[status].classes);
            tooltipElement.textContent = statusConfig[status].tooltip;
        }
    });

    items.forEach((item) => {
        const stock = parseInt(item.getAttribute("data-stock"));
        const icon = item.querySelector(".icon-stock");

        if (stock < 5) {
            icon.classList.add("fa-triangle-exclamation", "red");
            icon.setAttribute("title", "Stok Hampir Habis");
        } else if (stock < 10) {
            icon.classList.add("fa-circle-exclamation", "yellow");
            icon.setAttribute("title", "Stok Menipis");
        } else {
            icon.classList.add("fa-check-circle", "green");
            icon.setAttribute("title", "Stok Aman");
        }
    });
});
