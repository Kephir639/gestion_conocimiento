$(document).ready(function () {
    $('#inputResponsables').selectize({
        placeholder: 'Seleccione una opcion...',
        dropdownParent: 'body',
        maxItems: null,
        dropdownClass: 'dropdown-menu',
        item_template: function (item) {
            return '<div>' +
                '<span>' + item.text + '</span>' +
                '<a href="#" class="remove-item">x</a>' +
                '</div>';
        },
        onItemAdd: function (value, $item) {
            $item.find('.remove-item').on('click', function () {
                $item.remove();
                $(this).selectize().removeOption(value);
            });
        }
    });

    $(document).on('click', '.iconoModificar', function () {
        button = $(this);

        // let estado = (estadoGrupo == "Activo") ? 1 : (estadoGrupo == "Inactivo") ? 0 : -1;

        $.ajax({
            type: "GET",
            url: "showModalActualizar",
            success: function (data) {
                $('#ModalSection').html(data);

                //Aqui se llenan todos los campos a modificar
                // $('#modalModificarRedes').find('#inputEstadoRed').val(estado); ---> Campo de ejemplo

                $('#modalModificarSemilleros').modal('show');
            }
        });
    });

    $('#BtnRegistrarSemillero').on('click', function () {
        button = $(this);
        $.ajax({
            type: "GET",
            url: "showModalRegistrar",
            success: function (data) {
                $('#ModalSection').html(data);

                $('#modalRegistrarSemilleros').modal('show');

                $('#inputIntegrantesSemillero').selectize({
                    placeholder: 'Seleccione una opcion...',
                    dropdownParent: '#modalRegistrarSemilleros',
                    maxItems: null,
                    dropdownClass: 'dropdown-menu',
                    item_template: function (item) {
                        return '<div>' +
                            '<span>' + item.text + '</span>' +
                            '<a href="#" class="remove-item">x</a>' +
                            '</div>';
                    },
                    onItemAdd: function (value, $item) {
                        $item.find('.remove-item').on('click', function () {
                            $item.remove();
                            $(this).selectize().removeOption(value);
                        });
                    }
                });

                $('#inputGrupos').selectize({
                    placeholder: 'Seleccione una opcion...',
                    dropdownParent: '#modalRegistrarSemilleros',
                    maxItems: null,
                    dropdownClass: 'dropdown-menu',
                    item_template: function (item) {
                        return '<div>' +
                            '<span>' + item.text + '</span>' +
                            '<a href="#" class="remove-item">x</a>' +
                            '</div>';
                    },
                    onItemAdd: function (value, $item) {
                        $item.find('.remove-item').on('click', function () {
                            $item.remove();
                            $(this).selectize().removeOption(value);
                        });
                    }
                });

                $('#inputLineas').selectize({
                    placeholder: 'Seleccione una opcion...',
                    dropdownParent: '#modalRegistrarSemilleros',
                    maxItems: null,
                    dropdownClass: 'dropdown-menu',
                    item_template: function (item) {
                        return '<div>' +
                            '<span>' + item.text + '</span>' +
                            '<a href="#" class="remove-item">x</a>' +
                            '</div>';
                    },
                    onItemAdd: function (value, $item) {
                        $item.find('.remove-item').on('click', function () {
                            $item.remove();
                            $(this).selectize().removeOption(value);
                        });
                    }
                });

                $('#inputProgramas').selectize({
                    placeholder: 'Seleccione una opcion...',
                    dropdownParent: '#modalRegistrarSemilleros',
                    maxItems: null,
                    item_template: function (item) {
                        return '<div>' +
                            '<span>' + item.text + '</span>' +
                            '<a href="#" class="remove-item">x</a>' +
                            '</div>';
                    },
                    onItemAdd: function (value, $item) {
                        $item.find('.remove-item').on('click', function () {
                            $item.remove();
                            $(this).selectize().removeOption(value);
                        });
                    }
                });

                $('#inputRedes').selectize({
                    placeholder: 'Seleccione una opcion...',
                    dropdownParent: '#modalRegistrarSemilleros',
                    maxItems: null,
                    dropdownClass: 'dropdown-menu',
                    item_template: function (item) {
                        return '<div>' +
                            '<span>' + item.text + '</span>' +
                            '<a href="#" class="remove-item">x</a>' +
                            '</div>';
                    },
                    onItemAdd: function (value, $item) {
                        $item.find('.remove-item').on('click', function () {
                            $item.remove();
                            $(this).selectize().removeOption(value);
                        });
                    }
                });

                $('#inputResponsables').selectize({
                    placeholder: 'Seleccione una opcion...',
                    dropdownParent: '#modalRegistrarSemilleros',
                    maxItems: null,
                    dropdownClass: 'dropdown-menu',
                    item_template: function (item) {
                        return '<div>' +
                            '<span>' + item.text + '</span>' +
                            '<a href="#" class="remove-item">x</a>' +
                            '</div>';
                    },
                    onItemAdd: function (value, $item) {
                        $item.find('.remove-item').on('click', function () {
                            $item.remove();
                            $(this).selectize().removeOption(value);
                        });
                    }
                });
            }
        });
    });


});
