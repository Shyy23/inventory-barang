<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
    <head>
        <!--===== Meta Tag =====-->
        <meta charset="UTF-8" />
        <meta name="keywords" content="Web Inventory, Manajemen Barang, RPL " />
        <meta
            name="description"
            content="Inventory Barang jurusan RPL SMKN 4 Padalarang"
        />
        <meta name="author" content="Syahrul Hidayatulloh" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <!--===== Title =====-->
        <title>@yield("title", "Inventory-barang")</title>

        <!--===== Favicon =====-->
        <link
            rel="shortcut icon"
            href="{{ asset("assets/icons/default.ico") }}"
            type="image/x-icon"
        />

        <!--===== ICON CDN =====-->
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/iconify/2.0.0/iconify.min.js"></script>

        <!--===== Styles / Scripts =====-->
        @if (file_exists(public_path("build/manifest.json")) || file_exists(public_path("hot")))
            @vite(["resources/css/app.css", "resources/js/app.js"])
        @else
            <link rel="stylesheet" href="{{ asset("css/app.css") }}" />
        @endif
    </head>

    <body
        class="grid min-h-dvh bg-[--body-clr] font-nunito text-[1rem] leading-[1.5] text-[--text-clr]"
    >
        <div id="app">
            <!--========== SIDEBAR START ==========-->
            <div id="sidebar">
                <div
                    class="sidebar__wrapper active fixed bottom-0 top-0 z-10 h-screen w-[300px] bg-[--container-clr]"
                >
                    <div
                        class="sidebar__header relative p-[2rem_2rem_1rem] text-[2rem] font-bold"
                    >
                        <!-- Logo dan toggle Tema -->
                        <div class="flex items-center justify-between">
                            <div class="logo">
                                <a href="#">
                                    <img
                                        class="h-[20px]"
                                        src="{{ asset("assets/svg/logo.svg") }}"
                                        alt="Logo"
                                    />
                                </a>
                            </div>
                            <div
                                class="theme__toggle mt-2 flex items-center gap-2 text-[--title-clr]"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                                    aria-hidden="true"
                                    role="img"
                                    class="iconify iconify--system-uicons"
                                    width="20"
                                    height="20"
                                    preserveAspectRatio="xMidYMid meet"
                                    viewBox="0 0 21 21"
                                >
                                    <g
                                        fill="none"
                                        fill-rule="evenodd"
                                        stroke="currentColor"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                    >
                                        <path
                                            d="M10.5 14.5c2.219 0 4-1.763 4-3.982a4.003 4.003 0 0 0-4-4.018c-2.219 0-4 1.781-4 4c0 2.219 1.781 4 4 4zM4.136 4.136L5.55 5.55m9.9 9.9l1.414 1.414M1.5 10.5h2m14 0h2M4.135 16.863L5.55 15.45m9.899-9.9l1.414-1.415M10.5 19.5v-2m0-14v-2"
                                            opacity=".3"
                                        ></path>
                                        <g transform="translate(-210 -1)">
                                            <path
                                                d="M220.5 2.5v2m6.5.5l-1.5 1.5"
                                            ></path>
                                            <circle
                                                cx="220.5"
                                                cy="11.5"
                                                r="4"
                                            ></circle>
                                            <path
                                                d="m214 5l1.5 1.5m5 14v-2m6.5-.5l-1.5-1.5M214 18l1.5-1.5m-4-5h2m14 0h2"
                                            ></path>
                                        </g>
                                    </g>
                                </svg>
                                <div class="form-check form-switch fs-6">
                                    <input
                                        class="form-check-input relative me-0 mt-[.15em] h-[1.2em] w-[1.2em] shrink-0 cursor-pointer appearance-none align-top"
                                        type="checkbox"
                                        id="toggle-dark"
                                        style="cursor: pointer"
                                    />
                                    <label class="form-check-label"></label>
                                </div>
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                                    aria-hidden="true"
                                    role="img"
                                    class="iconify iconify--mdi"
                                    width="20"
                                    height="20"
                                    preserveAspectRatio="xMidYMid meet"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        fill="currentColor"
                                        d="m17.75 4.09l-2.53 1.94l.91 3.06l-2.63-1.81l-2.63 1.81l.91-3.06l-2.53-1.94L12.44 4l1.06-3l1.06 3l3.19.09m3.5 6.91l-1.64 1.25l.59 1.98l-1.7-1.17l-1.7 1.17l.59-1.98L15.75 11l2.06-.05L18.5 9l.69 1.95l2.06.05m-2.28 4.95c.83-.08 1.72 1.1 1.19 1.85c-.32.45-.66.87-1.08 1.27C15.17 23 8.84 23 4.94 19.07c-3.91-3.9-3.91-10.24 0-14.14c.4-.4.82-.76 1.27-1.08c.75-.53 1.93.36 1.85 1.19c-.27 2.86.69 5.83 2.89 8.02a9.96 9.96 0 0 0 8.02 2.89m-1.64 2.02a12.08 12.08 0 0 1-7.8-3.47c-2.17-2.19-3.33-5-3.49-7.82c-2.81 3.14-2.7 7.96.31 10.98c3.02 3.01 7.84 3.12 10.98.31Z"
                                    ></path>
                                </svg>
                            </div>
                            <div
                                class="sidebar__toggle__x absolute right-[1.75rem] top-[0.25rem] hidden"
                            ></div>
                        </div>
                    </div>
                    <!--========== NAVIGATION START ==========-->
                    <nav class="sidebar__menu"></nav>
                    <!--========== NAVIGATION END ==========-->
                </div>
            </div>
            <!--========== SIDEBAR END ==========-->
            <!--========== MAIN CONTENT START ==========-->
            <main id="main" class="main">
                @yield("content")
            </main>
            <!--========== MAIN CONTENT END ==========-->
            <!--========== FOOTER START ==========-->
            <footer id="footer" class="footer"></footer>
            <!--========== FOOTER END ==========-->
        </div>

        <!-- Main Js -->
        <script
            src="{{ asset("js/main.js") }}"
            type="text/javascript"
            defer
        ></script>
    </body>
</html>
