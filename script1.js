// Ganti Foto
document.getElementById('uploadFoto').addEventListener('change', function (event) {
  const file = event.target.files[0];
  if (file) {
    const reader = new FileReader();
    reader.onload = function (e) {
      document.getElementById('fotoProfil').src = e.target.result;
    }
    reader.readAsDataURL(file);
  }
});

// Edit Profil
function editProfil() {
  const fields = ['nama', 'nim', 'jurusan', 'prodi', 'email', 'nohp'];
  const editBtn = document.querySelector('.edit-btn');

  if (editBtn.textContent === 'Edit Profil') {
    fields.forEach(id => {
      const value = document.getElementById(id).textContent;
      document.getElementById(id).innerHTML = `<input type="text" value="${value}" id="edit_${id}" style="width:250px;padding:4px;">`;
    });
    editBtn.textContent = 'Simpan';
  } else {
    fields.forEach(id => {
      const newValue = document.getElementById(`edit_${id}`).value;
      document.getElementById(id).textContent = newValue;
    });
    editBtn.textContent = 'Edit Profil';
    alert('Profil berhasil disimpan!');
  }
}
