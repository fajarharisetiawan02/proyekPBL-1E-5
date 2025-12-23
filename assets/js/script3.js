/* =========================================================
   TOGGLE SIDEBAR
========================================================= */
const menuToggle = document.getElementById("menu-toggle");
const sidebar = document.querySelector(".sidebar");
const mainContent = document.querySelector(".main-content");
const topbar = document.querySelector(".topbar");

if (menuToggle) {
    menuToggle.addEventListener("click", () => {
        sidebar.classList.toggle("collapsed");
        mainContent.classList.toggle("collapsed");
        topbar.classList.toggle("collapsed");
    });
}


/* =========================================================
   PROFILE DROPDOWN
========================================================= */
const profileIcon = document.getElementById("profileIcon");
const dropdownMenu = document.getElementById("dropdownMenu");

if (profileIcon && dropdownMenu) {
    profileIcon.addEventListener("click", (e) => {
        e.stopPropagation();
        dropdownMenu.classList.toggle("show");
    });

    // Tutup dropdown ketika klik di luar menu
    window.addEventListener("click", (e) => {
        if (!profileIcon.contains(e.target) && !dropdownMenu.contains(e.target)) {
            dropdownMenu.classList.remove("show");
        }
    });
}


/* =========================================================
   EDIT DATA (untuk halaman jadwal ujian)
========================================================= */
function editData(id, mk, tanggal, waktu, ruang, dosen) {
    document.getElementById("edit_id").value = id;
    document.getElementById("edit_mk").value = mk;
    document.getElementById("edit_tanggal").value = tanggal;
    document.getElementById("edit_waktu").value = waktu;
    document.getElementById("edit_ruang").value = ruang;
    document.getElementById("edit_dosen").value = dosen;
}


/* =========================================================
   ANIMASI ANGKA (COUNT-UP)
========================================================= */
function animateNumbers() {
    document.querySelectorAll(".count").forEach(el => {
        let target = parseInt(el.getAttribute("data-value"));
        let start = 0;
        let duration = 1200;

        // Jika target 0 → tidak perlu animasi
        if (target === 0) return;

        let step = Math.max(20, Math.floor(duration / target));

        let interval = setInterval(() => {
            start++;
            el.textContent = start;

            if (start >= target) clearInterval(interval);
        }, step);
    });
}

animateNumbers();


/* =========================================================
   ANIMASI FADE-IN KONTEN
========================================================= */
window.addEventListener("load", () => {
    document.querySelectorAll(".fade-in").forEach((el, i) => {
        el.style.animationDelay = `${i * 0.15}s`;
        el.classList.add("show");
    });
});


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


/* =========================================================
   CHART.JS — GRAFIK 2: Mahasiswa Aktif
========================================================= */
const ctx2 = document.getElementById("chartMahasiswa");

if (ctx2) {
    new Chart(ctx2, {
        type: "line",
        data: {
            labels: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun"],
            datasets: [{
                label: "Mahasiswa Aktif",
                data: [420, 430, 450, 470, 480, 523], // bisa dibuat dinamis
                borderColor: "#3B82F6",
                borderWidth: 3,
                tension: 0.35
            }]
        },
        options: {
            responsive: true,
            animation: {
                duration: 1800,
                easing: "easeOutQuart",
            }
        }
    });
}


document.querySelectorAll('.menu-link').forEach(menu => {
    menu.addEventListener('click', () => {
        menu.parentElement.classList.toggle('active');
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



