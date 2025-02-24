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
// Fungsi untuk menampilkan/menyembunyikan sidebar
const toggleActive = (isActive) => {
    sidebar.classList.toggle("active", isActive);
    overlay.classList.toggle("active", isActive);
};

menuBtn.addEventListener("click", () => toggleActive(true));
closeBtn.addEventListener("click", () => toggleActive(false));
overlay.addEventListener("click", () => toggleActive(false));

document.addEventListener("keydown", (event) => {
    if (event.key === "Escape" && sidebar.classList.contains("active")) {
        toggleActive(false);
    }
});

// Handle resize dengan debounce
let resizeTimeout;
const handleResize = () => {
    clearTimeout(resizeTimeout);
    resizeTimeout = setTimeout(() => {
        if (window.innerWidth <= 1240) {
            sidebar.classList.remove("active", "close");
            overlay.classList.remove("active");
        } else {
            overlay.classList.remove("active");
        }
    }, 100);
};
window.addEventListener("resize", handleResize);

window.addEventListener("resize", handleResize);

// Atur ikon status setelah DOM selesai dimuat
document.addEventListener("DOMContentLoaded", () => {
    const items = document.querySelectorAll(".item-stock");
    const statusIcons = document.querySelectorAll(".status__icon");

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

    document
        .getElementById("logout")
        .addEventListener("click", function (event) {
            event.preventDefault(); // Mencegah form terkirim langsung

            Swal.fire({
                title: "Apakah Anda yakin ingin logout?",
                text: "Anda akan keluar dari sesi ini.",
                icon: "warning",
                iconColor: "rgba(238, 62, 100, 1)",
                color: "rgba(194, 194, 217, 1)",
                background: "rgba(30, 30, 45, 1)",
                showCancelButton: true,
                confirmButtonColor: "rgba(40, 156, 46, 1)",
                cancelButtonColor: "rgba(238, 62, 100, 1)",
                confirmButtonText: "Ya, Logout!",
                cancelButtonText: "Batal",
            }).then((result) => {
                if (result.isConfirmed) {
                    document.querySelector("form.w-full").submit(); // Kirim form logout
                }
            });
        });
});
