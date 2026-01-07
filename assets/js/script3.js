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
        if (
            window.innerWidth <= 768 &&
            sidebar?.classList.contains("show")
        ) {
            if (
                !sidebar.contains(e.target) &&
                !menuToggle.contains(e.target)
            ) {
                sidebar.classList.remove("show");
            }
        }
    });

    /* =========================================================
       PROFILE DROPDOWN
    ========================================================= */
    const profileIcon  = document.getElementById("profileIcon");
    const dropdownMenu = document.getElementById("dropdownMenu");

    if (profileIcon && dropdownMenu) {
        profileIcon.addEventListener("click", (e) => {
            e.stopPropagation();
            dropdownMenu.classList.toggle("show");
        });

        document.addEventListener("click", () => {
            dropdownMenu.classList.remove("show");
        });
    }

    /* =========================================================
       NOTIFIKASI (DROPDOWN + READ)
    ========================================================= */
    const notifBtn       = document.getElementById("notifBtn");
    const notifDropdown  = document.getElementById("notifDropdown");

    if (notifBtn && notifDropdown) {
        notifBtn.addEventListener("click", (e) => {
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
       ANIMASI ANGKA (COUNTER)
    ========================================================= */
    document.querySelectorAll(".count").forEach((el) => {
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
       FADE IN ANIMATION
    ========================================================= */
    document.querySelectorAll(".fade-in").forEach((el, i) => {
        el.style.animationDelay = `${i * 0.15}s`;
        el.classList.add("show");
    });

});

/* =========================================================
   MODAL DETAIL (GENERIC)
========================================================= */
function openDetail(nama, deskripsi, syarat, periode, buka, tutup, status) {

    console.log("Modal dipanggil"); // DEBUG

    const modal = document.getElementById("modalDetail");
    if (!modal) {
        console.error("modalDetail tidak ditemukan");
        return;
    }

    document.getElementById("detailNama").innerText       = nama;
    document.getElementById("detailDeskripsi").innerHTML = deskripsi || "-";
    document.getElementById("detailSyarat").innerHTML    = syarat || "-";
    document.getElementById("detailPeriode").innerText   = periode || "-";
    document.getElementById("detailTanggal").innerText   = buka + " - " + tutup;
    document.getElementById("detailStatus").innerText    = status;

    modal.classList.add("show");
}

function closeDetail() {
    document.getElementById("modalDetail").classList.remove("show");
}

/* =========================================================
   NOTIFIKASI (VERSI DISPLAY BLOCK)
========================================================= */
const notifBtn = document.getElementById("notifBtn");
const notifDropdown = document.getElementById("notifDropdown");

if (notifBtn) {
    notifBtn.addEventListener("click", (e) => {
        e.stopPropagation();
        notifDropdown.style.display =
            notifDropdown.style.display === "block" ? "none" : "block";
    });

    window.addEventListener("click", () => {
        notifDropdown.style.display = "none";
    });
}

/* =========================================================
   MODAL BEASISWA
========================================================= */
const modal = document.getElementById("modalBeasiswa");

function openBeasiswa(judul, deskripsi, syarat, periode, tglBuka, tglTutup) {
    document.getElementById("bJudul").innerText      = judul;
    document.getElementById("bDeskripsi").innerHTML = deskripsi;
    document.getElementById("bSyarat").innerHTML    = syarat;
    document.getElementById("bPeriode").innerText   = periode;
    document.getElementById("bTanggal").innerText   = tglBuka + " - " + tglTutup;

    modal.classList.add("show");
    modal.style.display = "block";
}

/* Tutup hanya via tombol */
function closeBeasiswa() {
    modal.classList.remove("show");
    modal.style.display = "none";
}

/* ESC boleh nutup */
document.addEventListener("keydown", (e) => {
    if (e.key === "Escape" && modal.classList.contains("show")) {
        closeBeasiswa();
    }
});

/* =========================================================
   PREVIEW FOTO
========================================================= */
function previewFoto(input) {
    const file    = input.files[0];
    const preview = document.getElementById("previewImg");

    if (file) {
        const reader = new FileReader();
        reader.onload = (e) => {
            if (preview.tagName === "IMG") {
                preview.src = e.target.result;
            }
        };
        reader.readAsDataURL(file);
    }
}

/* =========================================================
   MODAL CUSTOM
========================================================= */
function openModal(id) {
    const modal = document.getElementById(id);
    if (!modal) return;

    modal.classList.add("active");
    document.body.style.overflow = "hidden";
}

function closeModal(id) {
    const modal = document.getElementById(id);
    if (!modal) return;

    modal.classList.remove("active");
    document.body.style.overflow = "";
}

document.addEventListener("keydown", (e) => {
    if (e.key === "Escape") {
        document
            .querySelectorAll(".modal-custom.active")
            .forEach((m) => m.classList.remove("active"));

        document.body.style.overflow = "";
    }
});


/* =========================================================
   TOGGLE PASSWORD
========================================================= */
function togglePassword(icon) {
    const input = icon.previousElementSibling;
    input.type = input.type === "password" ? "text" : "password";
    icon.classList.toggle("fa-eye");
    icon.classList.toggle("fa-eye-slash");
}

/* =========================================================
   PASSWORD STRENGTH
========================================================= */
function checkStrength(val) {
    const strength = document.getElementById("strength");
    const confirm  = document.querySelector('input[name="konfirmasi"]');

    if (val.length < 6) {
        strength.textContent = "Password lemah";
        strength.className = "strength weak";
    } else if (/[0-9]/.test(val) && /[a-zA-Z]/.test(val)) {
        strength.textContent = "Password kuat";
        strength.className = "strength strong";
    } else {
        strength.textContent = "Password sedang";
        strength.className = "strength medium";
    }

    // validasi konfirmasi password (tanpa ubah UI)
    if (confirm && confirm.value !== "" && confirm.value !== val) {
        confirm.setCustomValidity("Password tidak cocok");
    } else if (confirm) {
        confirm.setCustomValidity("");
    }
}

