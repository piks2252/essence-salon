$(function () {
    $.validator.addMethod('minImageHeight', function (value, element, minHeight) {
        console.log($.isEmptyObject($(element).data()))
        if ($.isEmptyObject($(element).data())){
            return true;
        }
        return ($(element).data('imageHeight') || 0) > minHeight;
    }, function (minHeight, element) {
        var imageHeight = $(element).data('imageHeight');
        return (imageHeight)
            ? ("Your image's height must be greater than " + minHeight + "px")
            : "Selected file is not an image.";
    });
    var validator = $("form[name='image_form']").validate({
        errorElement: "span",
        errorClass: "validation-error-label",

        rules: {
            image_path: {
                required: ($("form[name='image_form']").hasClass('edit-form')) ? false : true,
                minImageHeight: 700
            }
        },
        messages: {
            image_path: {
                required: "You must insert an image"
            },
        },

        highlight: function (element, errorClass) {
            $(element).removeClass(errorClass);
        },
        unhighlight: function (element, errorClass) {
            $(element).removeClass(errorClass);
        },
        errorPlacement: function (error, element) {

            // Styled checkboxes, radios, bootstrap switch
            if (element.parents('div').hasClass("checker") || element.parents('div').hasClass("choice") || element.parent().hasClass('bootstrap-switch-container')) {
                if (element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
                    error.appendTo(element.parent().parent().parent().parent());
                }
                else {
                    error.appendTo(element.parent().parent().parent().parent().parent());
                }
            }

            // Unstyled checkboxes, radios
            else if (element.parents('div').hasClass('checkbox') || element.parents('div').hasClass('radio')) {
                error.appendTo(element.parent().parent().parent());
            }

            // Input with icons and Select2
            else if (element.parents('div').hasClass('has-feedback') || element.hasClass('select2-hidden-accessible')) {
                error.appendTo(element.parent());
            }

            // Inline checkboxes, radios
            else if (element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
                error.appendTo(element.parent().parent());
            }

            // Input group, styled file input
            else if (element.parent().hasClass('uploader') || element.parents().hasClass('input-group')) {
                error.appendTo(element.parent().parent());
            }

            else {
                error.insertAfter(element);
            }
        },
        submitHandler: function (form) {
            form.submit();
        }
    });

    var $submitBtn = $('.image_form').find('input:submit'),
        $photoInput = $('#image_path'),
        $imgContainer = $('#imgContainer');

    $('#image_path').change(function () {
        $photoInput.removeData('imageHeight');
        $imgContainer.hide().empty();

        var file = this.files[0];

        if (file.type.match(/image\/.*/)) {
            $submitBtn.attr('disabled', true);

            var reader = new FileReader();

            reader.onload = function () {
                var $img = $('<img />').attr({ src: reader.result });

                $img.on('load', function () {
                    $imgContainer.append($img).show();
                    var imageWidth = $img.width();
                    var imageHeight = $img.height();
                    console.log(imageHeight);
                    $photoInput.data('imageHeight', imageHeight);
                    
                    if (imageHeight < 700) {
                        $imgContainer.hide();
                    } else {
                        $img.css({ width: '100px', height: '100px' });
                        $img.attr({ class: 'img-responsive img-circle' });
                    }
                    $submitBtn.attr('disabled', false);
                    console.log('$photoInput', $photoInput);
                    
                    validator.element($photoInput);
                });
            }

            reader.readAsDataURL(file);
        } else {
            console.log(file)
            validator.element($photoInput);
        }
    });
});