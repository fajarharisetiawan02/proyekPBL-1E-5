// tambahkan class active pada nav sesuai URL sederhana
(function(){
  const links = document.querySelectorAll('.nav-links a');
  links.forEach(a=>{
    if(location.pathname.includes(a.getAttribute('href'))){
      a.classList.add('active');
    }
  });
})();
