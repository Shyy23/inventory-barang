export default class Dropdown {
    static dropdownInstances = [];

    constructor(containerSelector) {
        this.container = document.querySelector(containerSelector);
        this.toggle = this.container.querySelector(".dropdown-toggle");
        this.menu = this.container.querySelector(".dropdown-menu");
        this.initialize();
        Dropdown.dropdownInstances.push(this);
    }

    initialize() {
        // Event listener untuk toggle
        this.toggle.addEventListener("change", () => this.handleToggle());

        // Event listener untuk item menu
        this.menu.querySelectorAll("button").forEach((button) => {
            button.addEventListener("click", () => this.close());
        });
    }

    handleToggle() {
        if (this.toggle.checked) {
            Dropdown.closeAll(this);
        }
    }

    close() {
        this.toggle.checked = false;
        this.menu.classList.remove("visible", "opacity-100");
        this.menu.classList.add("invisible", "opacity-0");
    }

    static closeAll(excludeInstance = null) {
        this.dropdownInstances.forEach((instance) => {
            if (instance !== excludeInstance) {
                instance.close();
            }
        });
    }

    static initGlobalListeners() {
        // Tutup dropdown saat klik di luar
        document.addEventListener("click", (e) => {
            if (!e.target.closest(".dropdown")) {
                this.closeAll();
            }
        });

        // Handle escape key
        document.addEventListener("keydown", (e) => {
            if (e.key === "Escape") {
                this.closeAll();
            }
        });
    }
}
