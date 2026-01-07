document.addEventListener("DOMContentLoaded", () => {
<<<<<<< HEAD

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
=======

<<<<<<< HEAD
    /* =========================================================
       TOGGLE SIDEBAR (DESKTOP & MOBILE)
    ========================================================= */
    const menuToggle  = document.getElementById("menu-toggle");
    const sidebar     = document.querySelector(".sidebar");
    const mainContent = document.querySelector(".main-content");
    const topbar      = document.querySelector(".topbar");
=======
if (menuToggle) {
    menuToggle.addEventListener("click", () => {
        sidebar.classList.toggle("collapsed");
        mainContent.classList.toggle("collapsed");
        topbar.classList.toggle("collapsed");
    });
}
>>>>>>> 94ff06b9a02f99b55841fa7af5e6d0ecf2af4f4e

    if (menuToggle && sidebar) {
        menuToggle.addEventListener("click", () => {

            // MOBILE
            if (window.innerWidth <= 768) {
                sidebar.classList.toggle("show");
                return;
            }

<<<<<<< HEAD
            // DESKTOP
            sidebar.classList.toggle("collapsed");
            mainContent?.classList.toggle("collapsed");
            topbar?.classList.toggle("collapsed");
        });
>>>>>>> 53c6f9a8e457679e94882a1fefe69b0301169717
    }
=======
if (profileIcon && dropdownMenu) {
    profileIcon.addEventListener("click", (e) => {
        e.stopPropagation();
        dropdownMenu.classList.toggle("show");
    });

<<<<<<< HEAD
=======
    // Tutup dropdown ketika klik di luar menu
>>>>>>> 9a567987dd90af1392f8d15dfcbd79423ecb4815
    window.addEventListener("click", (e) => {
        if (!profileIcon.contains(e.target) && !dropdownMenu.contains(e.target)) {
            dropdownMenu.classList.remove("show");
        }
<<<<<<< HEAD
=======
    });
}
>>>>>>> 94ff06b9a02f99b55841fa7af5e6d0ecf2af4f4e


<<<<<<< HEAD
/* =========================================================
   TOGGLE PASSWORD
========================================================= */
function togglePassword(icon) {
    const input = icon.previousElementSibling;
    input.type = input.type === "password" ? "text" : "password";
    icon.classList.toggle("fa-eye");
    icon.classList.toggle("fa-eye-slash");
=======
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
>>>>>>> 9a567987dd90af1392f8d15dfcbd79423ecb4815
    });
<<<<<<< HEAD


    /* =========================================================
       FADE IN
    ========================================================= */
=======
>>>>>>> 53c6f9a8e457679e94882a1fefe69b0301169717
}

/* =========================================================
<<<<<<< HEAD
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

=======
   ANIMASI ANGKA
========================================================= */
function animateNumbers() {
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
}
animateNumbers();


/* =========================================================
   FADE IN
========================================================= */
window.addEventListener("load", () => {
>>>>>>> 94ff06b9a02f99b55841fa7af5e6d0ecf2af4f4e
    document.querySelectorAll(".fade-in").forEach((el, i) => {
        el.style.animationDelay = `${i * 0.15}s`;
        el.classList.add("show");
    });

});
<<<<<<< HEAD
=======


<<<<<<< HEAD
document.addEventListener("DOMContentLoaded", () => {

    const canvas = document.getElementById("chartPengumuman");
    if (!canvas || typeof trendLabels === "undefined") return;
=======
/* =========================================================
   CHART.JS — GRAFIK 1: Pengumuman
========================================================= */
const canvas = document.getElementById('chartPengumuman');

if (canvas && typeof grafikLabels !== 'undefined' && typeof grafikData !== 'undefined') {
    new Chart(canvas, {
        type: 'bar',
        data: {
            labels: grafikLabels,
            datasets: [{
                label: 'Jumlah Pengumuman',
                data: grafikData,
                backgroundColor: '#1e3a8a',
                borderRadius: 10,
                barThickness: 22
            }]
        },
        options: {
            indexAxis: 'y',
            responsive: true,
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        label: ctx => `${ctx.raw} pengumuman`
                    }
                }
            },
            scales: {
                x: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0,
                        stepSize: 1
                    },
                    grid: { display: false }
                },
                y: {
                    grid: { display: false }
                }
            }
        }
    });
}
>>>>>>> 9a567987dd90af1392f8d15dfcbd79423ecb4815

    const ctx = canvas.getContext("2d");

    const gradient = ctx.createLinearGradient(0, 0, 0, 320);
    gradient.addColorStop(0, "rgba(37, 99, 235, 0.35)");
    gradient.addColorStop(1, "rgba(37, 99, 235, 0.05)");

    new Chart(ctx, {
        type: "line",
        data: {
            labels: trendLabels,
            datasets: [{
                label: "Jumlah Pengumuman",
                data: trendData,
                fill: true,
                backgroundColor: gradient,
                borderColor: "#2563eb",
                borderWidth: 3,
                tension: 0.45,
                pointRadius: 6,
                pointBackgroundColor: "#2563eb",
                pointBorderColor: "#fff",
                pointBorderWidth: 2,
                pointHoverRadius: 8
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { precision: 0 },
                    grid: { color: "#e5e7eb" }
                },
                x: {
                    grid: { display: false }
                }
            }
        }
    });

});


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

    window.addEventListener("click", e => {
        if (!notifBtn.contains(e.target) && !notifDropdown.contains(e.target)) {
            notifDropdown.classList.remove("show");
        }
    });
}


<<<<<<< HEAD
/* =========================================================
   MENU USER
========================================================= */
document.addEventListener("DOMContentLoaded", () => {
    const toggleUser = document.getElementById("toggleUser");
    if (!toggleUser) return;

    const menuGroup = toggleUser.closest(".menu-group");
    toggleUser.addEventListener("click", () => {
        menuGroup.classList.toggle("active");
    });
});
function openDetail(nama, deskripsi, syarat, periode, buka, tutup, status) {
    document.getElementById('detailNama').innerHTML = nama;
    document.getElementById('detailDeskripsi').innerHTML = deskripsi;
    document.getElementById('detailSyarat').innerHTML = syarat;
    document.getElementById('detailPeriode').innerHTML = periode || '-';
    document.getElementById('detailTanggal').innerHTML = buka + ' - ' + tutup;
    document.getElementById('detailStatus').innerHTML = status;
    document.getElementById('modalDetail').classList.add('show');
}

function closeDetail() {
    document.getElementById('modalDetail').classList.remove('show');
}
const filterProdi   = document.getElementById("filterProdi");
const filterJurusan = document.getElementById("filterJurusan");
const filterKelas   = document.getElementById("filterKelas");
const searchData    = document.getElementById("searchData");
const jumlahData    = document.getElementById("jumlahData");

function text(el) {
    return el.innerText.toLowerCase().trim();
}

function filterMahasiswa() {
    const rows = document.querySelectorAll("#tabelMahasiswa tbody tr");
    let tampil = 0;

    rows.forEach(row => {
        // AMBIL DATA DARI KOLOM (AMAN)
        const nim     = text(row.cells[1]);
        const nama    = text(row.cells[2]);
        const prodi   = text(row.cells[3]);
        const jurusan = text(row.cells[4]);
        const kelas   = text(row.cells[5]); // bisa: "E Malam", "Malam E"

        // VALUE FILTER
        const fProdi   = filterProdi.value.toLowerCase().trim();
        const fJurusan = filterJurusan.value.toLowerCase().trim();
        const fKelas   = filterKelas.value.toLowerCase().trim();
        const fSearch  = searchData.value.toLowerCase().trim();

        // LOGIKA FILTER (FLEKSIBEL)
        const cocokProdi   = fProdi === ""   || prodi.includes(fProdi);
        const cocokJurusan = fJurusan === "" || jurusan.includes(fJurusan);
        const cocokKelas   = fKelas === ""   || kelas.includes(fKelas);
        const cocokCari    = fSearch === ""  || nim.includes(fSearch) || nama.includes(fSearch);

        if (cocokProdi && cocokJurusan && cocokKelas && cocokCari) {
            row.style.display = "";
            tampil++;
        } else {
            row.style.display = "none";
        }
    });

    jumlahData.innerText = `Menampilkan ${tampil} data mahasiswa`;
}

// EVENT
filterProdi.addEventListener("change", filterMahasiswa);
filterJurusan.addEventListener("change", filterMahasiswa);
filterKelas.addEventListener("change", filterMahasiswa);
searchData.addEventListener("keyup", filterMahasiswa);

// LOAD AWAL
filterMahasiswa();
document.addEventListener('DOMContentLoaded', function () {
    const toggleUser = document.getElementById('toggleUser');
    const menuGroup  = toggleUser.closest('.menu-group');

    toggleUser.addEventListener('click', function () {
        menuGroup.classList.toggle('active');
=======
document.querySelectorAll('.menu-link').forEach(menu => {
    menu.addEventListener('click', () => {
        menu.parentElement.classList.toggle('active');
>>>>>>> 9a567987dd90af1392f8d15dfcbd79423ecb4815
    });
});
/* =========================================================
   NOTIFICATIONS
========================================================= */
const notifBtn = document.getElementById("notifBtn");
const notifDropdown = document.getElementById("notifDropdown");

if (notifBtn && notifDropdown) {
    notifBtn.addEventListener("click", function (e) {
        e.stopPropagation();
        notifDropdown.classList.toggle("show");
        // Mark notifications as read
        fetch("../admin/notif_read.php");
    });

    window.addEventListener("click", function (e) {
        if (!notifBtn.contains(e.target) && !notifDropdown.contains(e.target)) {
            notifDropdown.classList.remove("show");
        }
    });
}

    const toggleUser = document.getElementById('toggleUser');
    const menuGroup = toggleUser.parentElement;

    toggleUser.addEventListener('click', () => {
        menuGroup.classList.toggle('active');
    });



document.getElementById('menu-toggle').onclick = function () {
    document.querySelector('.sidebar').classList.toggle('collapsed');
    document.querySelector('.main-content').classList.toggle('collapsed');
    document.querySelector('.topbar').classList.toggle('collapsed');
};

>>>>>>> 94ff06b9a02f99b55841fa7af5e6d0ecf2af4f4e
>>>>>>> 53c6f9a8e457679e94882a1fefe69b0301169717
