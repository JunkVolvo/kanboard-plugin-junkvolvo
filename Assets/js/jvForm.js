KB.on('modal.afterRender', function () {
    $('select[name="jv_client"]').on('change', function () {
        var carsSelect = $('select[name="jv_car"]');

        $.ajax({
            url: '?plugin=JunkVolvo&controller=AjaxController&action=getClientCars&id=' + this.value,
            dataType: 'json',
            success: function (data) {
                carsSelect.find('option').remove();

                $.each(data, function (index, value) {
                    $("<option/>", {
                        value: index,
                        text: value
                    }).appendTo(carsSelect);
                });
            },
            error: function () {
                carsSelect.find('option').not(':first').remove();
            }
        });
    });
});