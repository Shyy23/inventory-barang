/** ===========  PREVIEW IMAGE ================  */
export default class ImagePreview {
    /**
     * @param {string} inputSelector - CSS selector untuk input file
     * @param {string|null} previewSelector - CSS selector untuk elemen preview (opsional)
     * @param {string|null} containerSelector - CSS selector untuk container preview (opsional)
     */
    constructor(
        inputSelector,
        previewSelector = null,
        containerSelector = null,
    ) {
        this.inputs = document.querySelectorAll(inputSelector);
        this.previewSelector = previewSelector;
        this.containerSelector = containerSelector;

        // Untuk single preview (jika ada selector)
        if (previewSelector) {
            this.preview = document.querySelector(previewSelector);
        }

        this.setupListener();
    }

    setupListener() {
        // Handle single main image (jika ada previewSelector)
        if (this.preview) {
            this.inputs[0].addEventListener("change", (e) => {
                this.handlePreview(e, this.preview);
            });
        }

        // Handle multiple unit images
        this.inputs.forEach((input) => {
            let preview;
            let container = null;

            // Prioritaskan data attributes jika ada
            if (input.dataset.previewTarget) {
                preview = document.getElementById(input.dataset.previewTarget);
                container = input.dataset.previewContainer
                    ? document.getElementById(input.dataset.previewContainer)
                    : null;
            } else {
                // Cari preview dalam parent .unit-card
                const parentDiv = input.closest(".unit-card");
                if (parentDiv) {
                    preview = parentDiv.querySelector(".unit-image-preview");
                    container = parentDiv.querySelector(".preview-container"); // Sesuaikan dengan class container
                }
            }

            // Jika ada preview, tambahkan event listener
            if (preview) {
                input.addEventListener("change", (e) => {
                    this.handlePreview(e, preview, container);
                });
            }
        });
    }

    handlePreview(event, previewElement, containerElement = null) {
        const file = event.target.files[0];

        if (file) {
            const reader = new FileReader();
            reader.onload = (e) => {
                previewElement.src = e.target.result;

                // Tampilkan container jika ada
                if (containerElement) {
                    containerElement.classList.remove("hidden");
                }
            };
            reader.readAsDataURL(file);
        } else {
            // Reset ke kondisi awal jika tidak ada file
            previewElement.src = "";
            if (containerElement) {
                containerElement.classList.add("hidden");
            }
        }
    }
}
