// Funcionamiento del sidebar
const toggle = document.querySelector('#sidebar-toggle');
const toggleClose = document.querySelector('#sidebar-toggle-close');
const sidebar = document.querySelector('#sidebar');

const sidebarItems = document.querySelectorAll('.sidebar-item');

sidebarItems.forEach((item) => {
    item.addEventListener('click', (e) => {

    })
})

toggle.addEventListener('click', e => {
    sidebar.classList.add('expanded')
})

toggleClose.addEventListener('click', e => {
    sidebar.classList.remove('expanded')
})

// Funcionamiento de los dropdown
$(document).ready(function () {
    $(document).on('click', '.sidebar-tabb', function () {
        // Añadir la clase 'collapsed' a todos los elementos con clase 'sidebar-tabb'
        $('.sidebar-tabb').addClass('collapsed');

        // Remover la clase 'collapsed' del elemento clicado si ya está expandido
        if ($(this).hasClass('collapsed')) {
            $(this).removeClass('collapsed');
        }
        if (!$(this).hasClass('collapsed')) {
            $(this).addClass('collapsed');
        }

        // Cerrar todos los dropdowns
        $('.sidebar-dropdown').removeClass('show');

        // Mostrar el dropdown correspondiente al elemento clicado
        if (!$(this).hasClass('collapsed')) {
            $(this).next('.sidebar-dropdown').addClass('collapsing');
            $(this).next('.sidebar-dropdown').removeClass('collapsing');
            $(this).next('.sidebar-dropdown').addClass('show');
        }
    });
});
