document.addEventListener("DOMContentLoaded", () => {

    /* =========================================================
       TOGGLE SIDEBAR (DESKTOP & MOBILE)
    ========================================================= */
    const menuToggle  = document.getElementById("menu-toggle");
    const sidebar     = document.querySelector(".sidebar");
    const mainContent = document.querySelector(".main-content");
    const topbar      = document.querySelector(".topbar");

    if (menuToggle && sidebar) {
        menuToggle.addEventListener("click", () => {

            // MOBILE
            if (window.innerWidth <= 768) {
                sidebar.classList.toggle("show");
                return;
            }

            // DESKTOP
            sidebar.classList.toggle("collapsed");
            mainContent?.classList.toggle("collapsed");
            topbar?.classList.toggle("collapsed");
        });
    }


    /* =========================================================
       CLOSE SIDEBAR MOBILE KETIKA KLIK KONTEN
    ========================================================= */
    document.addEventListener("click", (e) => {
        if (window.innerWidth <= 768 && sidebar?.classList.contains("show")) {
            if (!sidebar.contains(e.target) && !menuToggle.contains(e.target)) {
                sidebar.classList.remove("show");
            }
        }
    });


    /* =========================================================
       PROFILE DROPDOWN
    ========================================================= */
    const profileIcon = document.getElementById("profileIcon");
    const dropdownMenu = document.getElementById("dropdownMenu");

    if (profileIcon && dropdownMenu) {
        profileIcon.addEventListener("click", e => {
            e.stopPropagation();
            dropdownMenu.classList.toggle("show");
        });

        document.addEventListener("click", () => {
            dropdownMenu.classList.remove("show");
        });
    }


    /* =========================================================
       NOTIFIKASI
    ========================================================= */
    const notifBtn = document.getElementById("notifBtn");
    const notifDropdown = document.getElementById("notifDropdown");

    if (notifBtn && notifDropdown) {
        notifBtn.addEventListener("click", e => {
            e.stopPropagation();
            notifDropdown.classList.toggle("show");
            fetch("../admin/notif_read.php");
        });

        document.addEventListener("click", () => {
            notifDropdown.classList.remove("show");
        });
    }


    /* =========================================================
       MENU USER (SIDEBAR)
    ========================================================= */
    const toggleUser = document.getElementById("toggleUser");
    if (toggleUser) {
        const menuGroup = toggleUser.closest(".menu-group");
        toggleUser.addEventListener("click", () => {
            menuGroup.classList.toggle("active");
        });
    }


    /* =========================================================
       ANIMASI ANGKA
    ========================================================= */
    document.querySelectorAll(".count").forEach(el => {
        const target = parseInt(el.dataset.value);
        if (!target) return;

        let current = 0;
        const step = Math.max(1, Math.floor(1200 / target));

        const interval = setInterval(() => {
            current++;
            el.textContent = current;
            if (current >= target) clearInterval(interval);
        }, step);
    });


    /* =========================================================
       FADE IN
    ========================================================= */
    document.querySelectorAll(".fade-in").forEach((el, i) => {
        el.style.animationDelay = `${i * 0.15}s`;
        el.classList.add("show");
    });

});
