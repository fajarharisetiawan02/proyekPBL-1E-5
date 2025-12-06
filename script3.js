document.getElementById("menu-toggle").addEventListener("click", function () {
    const sidebar = document.querySelector(".sidebar");
    const main = document.querySelector(".main-content");
    

    sidebar.classList.toggle("collapsed");
    main.classList.toggle("collapsed");
    
});
document.getElementById("profileIcon").addEventListener("click", function () {
    const menu = document.getElementById("dropdownMenu");
    menu.style.display = menu.style.display === "flex" ? "none" : "flex";
});

window.addEventListener("click", function(e){
    const menu = document.getElementById("dropdownMenu");
    const icon = document.getElementById("profileIcon");
    const menu = document.getElementById("menu-toggle");
    const sidebar = document.querySelector(".sidebar");

menu.onclick = () => {
    sidebar.classList.toggle("active");
};


    if (!icon.contains(e.target) && !menu.contains(e.target)) {
        menu.style.display = "none";
    }
});