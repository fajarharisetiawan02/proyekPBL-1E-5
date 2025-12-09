function validasiLogin() {
  const nama = document.getElementById("nama").value.trim();
  const password = document.getElementById("password").value.trim();
  const errorNama = document.getElementById("errorNama");
  const errorPassword = document.getElementById("errorPassword");
  const loginError = document.getElementById("loginError");
  let valid = true;

  errorNama.textContent = "";
  errorPassword.textContent = "";
  loginError.textContent = "";

  if (nama === "") {
    errorNama.textContent = "Nama tidak boleh kosong";
    valid = false;
  }

  if (password.length < 6) {
    errorPassword.textContent = "Kata sandi minimal 6 karakter";
    valid = false;
  }
  if (valid) {
    const namaBenar = "admin";
    const passwordBenar = "123456";

    if (nama === namaBenar && password === passwordBenar) {
      alert("Login berhasil!");
      window.location.href = "Dashboard.html";
    } else {
      loginError.textContent = "Nama atau kata sandi salah";
    }
  }
}

const togglePassword = document.getElementById("togglePassword");
const passwordInput = document.getElementById("password");

togglePassword.addEventListener("click", () => {
  const type =
    passwordInput.getAttribute("type") === "password" ? "text" : "password";
  passwordInput.setAttribute("type", type);

  togglePassword.classList.toggle("fa-eye");
  togglePassword.classList.toggle("fa-eye-slash");
});
