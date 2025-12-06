document.addEventListener("DOMContentLoaded", () => {
    const menuToggle   = document.getElementById("menu-toggle");
    const sidebar      = document.querySelector(".sidebar");
    const mainContent  = document.querySelector(".main-content");

    menuToggle.addEventListener("click", () => {
        sidebar.classList.toggle("collapsed");
        mainContent.classList.toggle("collapsed");
        const menu = document.getElementById("menu-toggle");
const sidebar = document.querySelector(".sidebar");

menu.onclick = () => {
    sidebar.classList.toggle("active");
};

    });

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

    const photoInput   = document.getElementById("photoInput");
    const profilePhoto = document.getElementById("profilePhoto");

    photoInput.addEventListener("change", () => {
        const file = photoInput.files[0];
        if (file) {
            const imageURL = URL.createObjectURL(file);
            profilePhoto.src = imageURL;
            localStorage.setItem("foto", imageURL);
        }
    });

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

    const closeModal = () => modal.style.display = "none";
    closeBtn.addEventListener("click", closeModal);
    window.addEventListener("click", (e) => {
        if (e.target === modal) closeModal();
    });

    saveBtn.addEventListener("click", () => {
        const nama = editNama.value;
        const email = editEmail.value;
        const hp = editHP.value;

        viewNama.textContent = ": " + nama;
        viewEmail.textContent = ": " + email;
        viewHP.textContent = ": " + hp;
        headerNama.textContent = nama;

        localStorage.setItem("nama", nama);
        localStorage.setItem("email", email);
        localStorage.setItem("hp", hp);

        closeModal();
    });

    function loadSavedData() {
        const savedNama  = localStorage.getItem("nama");
        const savedEmail = localStorage.getItem("email");
        const savedHP    = localStorage.getItem("hp");
        const savedFoto  = localStorage.getItem("foto");

        if (savedNama) {
            viewNama.textContent = ": " + savedNama;
            headerNama.textContent = savedNama;
        }

        if (savedEmail) viewEmail.textContent = ": " + savedEmail;
        if (savedHP) viewHP.textContent = ": " + savedHP;
        if (savedFoto) profilePhoto.src = savedFoto;
    }

    loadSavedData(); 
});
