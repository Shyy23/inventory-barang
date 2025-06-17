export default class BaseFilter {
    constructor(config) {
        this.route = config.route;
        this.itemsContainerSelector = config.itemsContainerSelector;

        this.paginationContainerSelector = config.paginationContainerSelector;
        this.searchInputSelector = config.searchInputSelector;
        this.clearButtonSelector = config.clearButtonSelector;

        this.init();
        this.restoreStateFromURL();
    }

    init() {
        // Init DOM
        this.itemsContainer = document.querySelector(
            this.itemsContainerSelector,
        );
        this.paginationContainer = document.querySelector(
            this.paginationContainerSelector,
        );
        this.searchInput = document.querySelector(this.searchInputSelector);
        this.clearButton = document.querySelector(this.clearButtonSelector);
        this.debounceTimeout = null;

        if (!this.itemsContainer) return;

        if (this.searchInput) {
            this.searchInput.addEventListener("input", () =>
                this.handleDebounceFilter(),
            );
        }

        // Event Listener untuk tombol clear
        if (this.clearButton) {
            this.clearButton.addEventListener("click", (e) => {
                e.preventDefault();
                this.clearFilters();
            });
        }
    }

    handleDebounceFilter() {
        clearTimeout(this.debounceTimeout);
        this.debounceTimeout = setTimeout(() => {
            this.handleFilter();
        }, 500);
    }

    // ------------ METODE YANG HARUS DIIMPLEMENTASI TURUNAN ------------
    getFilterParams() {
        throw new Error("Method getFilterParams must be implemented");
    }

    restoreInputState() {
        throw new Error("Method restoreInputState must be implemented");
    }

    resetInputs() {
        throw new Error("Method resetInputs must be implemented");
    }
    // -----------------------------------------------------------------

    handleFilter() {
        const params = this.getFilterParams();
        this.showLoading();

        fetch(`${this.route}?${params}`, {
            headers: {
                "X-Requested-With": "XMLHttpRequest",
                Accept: "application/json",
            },
        })
            .then((response) => response.json())
            .then((data) => {
                this.updateContent(data);
                this.updateURL(params);
            })
            .catch((error) => console.error("Error", error))
            .finally(() => this.hideLoading());
    }
    updateContent(data) {
        // Update konten utama
        this.itemsContainer.innerHTML = data.html;

        // Update pagination
        if (this.paginationContainer) {
            this.paginationContainer.innerHTML = data.pagination;
        }
    }
    updateURL(params = "") {
        const url = new URL(window.location);
        url.search = params;
        window.history.pushState({}, "", url);
    }
    restoreStateFromURL() {
        if (this.searchInput) {
            const search = new URLSearchParams(window.location.search).get(
                "search",
            );
            if (search) this.searchInput.value = search;
        }
        this.restoreInputState();
    }

    clearFilters() {
        this.resetInputs();
        this.handleFilter();
        this.updateURL();
    }

    showLoading() {
        this.itemsContainer.classList.add("loading");
    }

    hideLoading() {
        this.itemsContainer.classList.remove("loading");
    }
}

export class ClearFilter {
    constructor(searchParams = ["search"]) {
        // DOM Elements
        this.clearButton = document.getElementById("clearFilterSelection");

        // List of search parameters to clear from the URL
        this.searchParams = Array.isArray(searchParams) ? searchParams : [];

        // Initialize only if the clear button exists and there are parameters to clear
        if (this.clearButton && this.searchParams.length > 0) {
            this.init();
        }
    }

    init() {
        // Attach event listener to the clear button
        this.clearButton.addEventListener("click", () => this.clearFilters());
    }

    clearFilters() {
        // Clear specified search parameters from the URL
        this.updateURL();

        // Optionally, you can trigger a reload or reapply filters here
        window.location.reload();
    }

    updateURL() {
        const url = new URL(window.location);

        // Loop through the list of search parameters to clear
        this.searchParams.forEach((param) => {
            url.searchParams.delete(param);
        });

        // Update the browser history with the modified URL
        window.history.pushState({}, "", url);
    }
}
