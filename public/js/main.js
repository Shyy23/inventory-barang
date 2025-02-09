const toggleButton = document.getElementById("toggle-btn");
const sidebar = document.getElementById("sidebar");
const overlay = document.getElementById("overlay");
const menuBtn = document.getElementById("menu-btn");
const closeBtn = document.getElementById("close-btn");
function toggleSidebar() {
    sidebar.classList.toggle("close");
    toggleButton.classList.toggle("rotate");

    closeAllSubMenus();
}
function toggleSubMenu(button) {
    if (!button.nextElementSibling.classList.contains("show")) {
        closeAllSubMenus();
    }
    button.nextElementSibling.classList.toggle("show");
    button.classList.toggle("rotate");

    if (sidebar.classList.contains("close")) {
        sidebar.classList.toggle("close");
        toggleButton.classList.toggle("rotate");
    }
}

function closeAllSubMenus() {
    Array.from(sidebar.getElementsByClassName("show")).forEach((ul) => {
        ul.classList.remove("show");
        ul.classList.previousElementSibling.classList.remove("rotate");
    });
}

function showSidebar() {
    sidebar.classList.add("active");
    overlay.classList.add("active");
}

function hideSidebar() {
    sidebar.classList.remove("active");
    overlay.classList.remove("active");
}

menuBtn.addEventListener("click", showSidebar);
closeBtn.addEventListener("click", hideSidebar);
overlay.addEventListener("click", hideSidebar);

document.addEventListener("keydown", (event) => {
    if (event.key === "Escape" && sidebar.classList.contains("active")) {
        hideSidebar();
    }
});

window.addEventListener("resize", () => {
    if (window.innerWidth <= 1240) {
        sidebar.classList.remove("active");
        overlay.classList.remove("active");
        if (sidebar.classList.contains("close")) {
            sidebar.classList.remove("close");
        }
        if (!sidebar.classList.contains("active")) {
            overlay.classList.remove("active");
        }
    }
});

window.addEventListener("resize", () => {
    if (window.innerWidth >= 1240 && overlay.classList.contains("active")) {
        overlay.classList.remove("active");
    }
});
const toggleDark = document.getElementById;

document.addEventListener("DOMContentLoaded", function () {
    const statusIcons = document.querySelectorAll(".status__icon");

    statusIcons.forEach((icon) => {
        const status = icon.getAttribute("data-status");
        const iconElement = icon.querySelector("i");
        const tooltipElelement = icon.querySelector(".status__tooltip");

        switch (status) {
            case "borrowed":
                iconElement.classList.add("fa-clock", "purple");
                tooltipElelement.textContent = "Dipinjam";
                break;
            case "returned":
                iconElement.classList.add("fa-check-circle", "green");
                tooltipElelement.textContent = "Dikembalikan";

                break;
            case "damaged":
                iconElement.classList.add("fa-triangle-exclamation", "red");
                tooltipElelement.textContent = "Rusak";

                break;
            case "delayed":
                iconElement.classList.add("fa-circle-exclamation", "yellow");
                tooltipElelement.textContent = "Tertunda";
                break;
        }
    });
});
