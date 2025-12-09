document.addEventListener("DOMContentLoaded", () => {

// Ambil elemen yang diperlukan
const menuToggle = document.getElementById("menu-toggle");
const sidebar = document.querySelector(".sidebar");
const topbar = document.querySelector(".topbar");
const mainContent = document.querySelector(".main-content");

// Jika tombol ditemukan, baru event listener dijalankan
menuToggle?.addEventListener("click", () => {

    sidebar.classList.toggle("collapsed");
    topbar.classList.toggle("collapsed");
    mainContent.classList.toggle("collapsed");

});


    /* ============================
       PROFILE DROPDOWN
    ============================ */
    const profileIcon  = document.getElementById("profileIcon");
    const dropdownMenu = document.getElementById("dropdownMenu");

    profileIcon.addEventListener("click", () => {
        dropdownMenu.style.display =
            dropdownMenu.style.display === "flex" ? "none" : "flex";
    });

    document.addEventListener("click", (e) => {
        if (!profileIcon.contains(e.target) && !dropdownMenu.contains(e.target)) {
            dropdownMenu.style.display = "none";
        }
    });

    /* ============================
       FOTO PREVIEW + UPLOAD AJAX
    ============================ */
    const photoInput   = document.getElementById("photoInput");
    const profilePhoto = document.getElementById("profilePhoto");

    photoInput.addEventListener("change", () => {
        let formData = new FormData(document.getElementById("uploadForm"));
        let file     = photoInput.files[0];

        // Preview cepat sebelum upload
        if (file) {
            profilePhoto.src = URL.createObjectURL(file);
        }

        fetch("upload_foto_mahasiswa.php", {
            method: "POST",
            body: formData
        })
        .then(res => res.json())
        .then(result => {
            if (result.status === "success") {

                // Update foto tanpa refresh + anti cache
                profilePhoto.src = result.newPath + "?v=" + new Date().getTime();

                alert("Foto berhasil diperbarui!");
            } else {
                alert("Gagal upload foto: " + result.msg);
            }
        })
        .catch(err => console.error("UPLOAD ERROR:", err));
    });

    /* ============================
       EDIT PROFIL (MODAL)
    ============================ */
    const modal      = document.getElementById("modalOverlay");
    const btnEdit    = document.querySelector(".btn-edit");
    const closeBtn   = document.getElementById("closeBtn");
    const saveBtn    = document.getElementById("saveBtn");

    const editNama   = document.getElementById("editNama");
    const editEmail  = document.getElementById("editEmail");
    const editHP     = document.getElementById("editHP");

    const viewNama   = document.getElementById("viewNama");
    const viewEmail  = document.getElementById("viewEmail");
    const viewHP     = document.getElementById("viewHP");
    const headerNama = document.getElementById("headerNama");

    btnEdit.addEventListener("click", () => {
        modal.style.display = "flex";

        editNama.value  = viewNama.textContent.replace(": ", "");
        editEmail.value = viewEmail.textContent.replace(": ", "");
        editHP.value    = viewHP.textContent.replace(": ", "");
    });

    closeBtn.addEventListener("click", () => modal.style.display = "none");
    window.addEventListener("click", (e) => {
        if (e.target === modal) modal.style.display = "none";
    });

    saveBtn.addEventListener("click", () => {
        const nama  = editNama.value;
        const email = editEmail.value;
        const hp    = editHP.value;

        viewNama.textContent = ": " + nama;
        viewEmail.textContent = ": " + email;
        viewHP.textContent = ": " + hp;
        headerNama.textContent = nama;

        localStorage.setItem("nama", nama);
        localStorage.setItem("email", email);
        localStorage.setItem("hp", hp);

        modal.style.display = "none";
    });

    /* ============================
       LOAD DATA DARI localStorage
    ============================ */
    function loadSavedData() {
        const savedNama  = localStorage.getItem("nama");
        const savedEmail = localStorage.getItem("email");
        const savedHP    = localStorage.getItem("hp");

        if (savedNama) {
            viewNama.textContent = ": " + savedNama;
            headerNama.textContent = savedNama;
        }
        if (savedEmail) viewEmail.textContent = ": " + savedEmail;
        if (savedHP) viewHP.textContent = ": " + savedHP;
    }

    loadSavedData();
});
document.getElementById("photoInput").addEventListener("change", function () {

    let formData = new FormData(document.getElementById("uploadForm"));
    let file = this.files[0];

    // preview cepat tanpa refresh
    if (file) {
        document.getElementById("profilePhoto").src = URL.createObjectURL(file);
    }

    fetch("upload_foto_mahasiswa.php", {
        method: "POST",
        body: formData
    })
    .then(res => res.json())
    .then(data => {

        if (data.status === "success") {
            document.getElementById("profilePhoto").src =
                data.newPath + "?v=" + new Date().getTime();
        } else {
            alert("Upload gagal: " + data.msg);
        }

    })
    .catch(err => console.error(err));
});
/* ===========================================
   UPLOAD FOTO TANPA REFRESH
=========================================== */

document.getElementById("photoInput").addEventListener("change", function () {

    let file = this.files[0];
    if (!file) return;

    // preview langsung
    document.getElementById("profilePhoto").src = URL.createObjectURL(file);

    let formData = new FormData();
    formData.append("foto", file);
    formData.append("id_mahasiswa", document.getElementById("mhs_id").value);

    fetch("upload_foto_mahasiswa.php", {
        method: "POST",
        body: formData
    })
    .then(r => r.json())
    .then(res => {
        if (res.status === "success") {

            document.getElementById("profilePhoto").src =
                res.newPath + "?v=" + new Date().getTime();

        } else {
            alert("Upload gagal: " + res.msg);
        }
    })
    .catch(err => console.error(err));
});
document.getElementById("photoInput").addEventListener("change", function () {
    let file = this.files[0];

    if (file) {
        document.getElementById("profilePhoto").src = URL.createObjectURL(file);
    }
});
