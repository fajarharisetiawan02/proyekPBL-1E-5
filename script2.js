// Fungsi validasi login
function validasiLogin() {
  const nama = document.getElementById("nama").value.trim();
  const password = document.getElementById("password").value.trim();
  const errorNama = document.getElementById("errorNama");
  const errorPassword = document.getElementById("errorPassword");
  const loginError = document.getElementById("loginError");
  let valid = true;

  // Reset pesan error
  errorNama.textContent = "";
  errorPassword.textContent = "";
  loginError.textContent = "";

  // Validasi input
  if (nama === "") {
    errorNama.textContent = "Nama tidak boleh kosong";
    valid = false;
  }

  if (password.length < 6) {
    errorPassword.textContent = "Kata sandi minimal 6 karakter";
    valid = false;
  }

  // Jika semua input valid
  if (valid) {
    const namaBenar = "admin";
    const passwordBenar = "123456";

    if (nama === namaBenar && password === passwordBenar) {
      alert("Login berhasil!");
      window.location.href = "Dashboard.html"; // pindah ke halaman Dashboard
    } else {
      loginError.textContent = "Nama atau kata sandi salah";
    }
  }
}

// 🔹 Fungsi tampil/sembunyi password (DILUAR fungsi validasi)
const togglePassword = document.getElementById("togglePassword");
const passwordInput = document.getElementById("password");

togglePassword.addEventListener("click", () => {
  const type =
    passwordInput.getAttribute("type") === "password" ? "text" : "password";
  passwordInput.setAttribute("type", type);

  // Ganti ikon mata
  togglePassword.classList.toggle("fa-eye");
  togglePassword.classList.toggle("fa-eye-slash");
});
