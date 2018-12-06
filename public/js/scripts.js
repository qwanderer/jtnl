/**
 * Ф-я показывает превьюшки картинок до загрузки их на сервер
 */
$(function() {
    $('.js_upload_image_input').on('change', function () {
        var img_number = this.getAttribute('data-loop');
        var file = this.files[0]
        if (file != null && file.type.match('image.*')) {
            var reader = new FileReader()
            reader.onload = function (e) {
                $('#upload_image_placeholder_'+img_number).empty().append(
                    $('<img>').attr('src', e.target.result).css('width', '100px')
                )
            };
            reader.readAsDataURL(file)
        }
    })
});
