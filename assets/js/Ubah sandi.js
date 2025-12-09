document.getElementById("menu-toggle").addEventListener("click", function () {
  const sidebar = document.querySelector(".sidebar");
  const main = document.querySelector(".main-content");

  sidebar.classList.toggle("collapsed");
  main.classList.toggle("collapsed");
});

const profileIcon = document.getElementById('profileIcon');
const dropdownMenu = document.getElementById('dropdownMenu');

profileIcon.addEventListener('click', (e) => {
  e.stopPropagation();
  dropdownMenu.style.display =
    dropdownMenu.style.display === 'block' ? 'none' : 'block';
});

document.addEventListener('click', (e) => {
  if (!dropdownMenu.contains(e.target) && e.target !== profileIcon) {
    dropdownMenu.style.display = 'none';
  }
});

const oldPass = document.getElementById('oldPass');
const newPass = document.getElementById('newPass');
const confirmPass = document.getElementById('confirmPass');
const saveBtn = document.getElementById('saveBtn');
const msg = document.getElementById('msg');

saveBtn.addEventListener('click', () => {
  msg.style.color = 'red';

  if (!oldPass.value || !newPass.value || !confirmPass.value) {
    msg.textContent = 'Semua field harus diisi.';
    return;
  }

  if (newPass.value.length < 6) {
    msg.textContent = 'Password baru minimal 6 karakter.';
    return;
  }

  if (newPass.value !== confirmPass.value) {
    msg.textContent = 'Konfirmasi password tidak cocok.';
    return;
  }

  msg.style.color = 'green';
  msg.textContent = 'Password berhasil diperbarui ✔';

  oldPass.value = '';
  newPass.value = '';
  confirmPass.value = '';
});

[oldPass, newPass, confirmPass].forEach(input => {
  input.addEventListener('keydown', (e) => {
    if (e.key === 'Enter') saveBtn.click();
  });
});
