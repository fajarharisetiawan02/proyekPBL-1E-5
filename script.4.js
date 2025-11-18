document.getElementById("menu-toggle").addEventListener("click", function () {
    const sidebar = document.querySelector(".sidebar");
    const main = document.querySelector(".main-content");

    sidebar.classList.toggle("collapsed");
    main.classList.toggle("collapsed");
});
