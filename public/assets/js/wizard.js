function scroll_to_class(element_class, removed_height) {
    var scroll_to = $(element_class).offset().top - removed_height;
    if ($(window).scrollTop() != scroll_to) {
        $('html, body').stop().animate({ scrollTop: scroll_to }, 0);
    }
}

function bar_progress(progress_line_object, direction) {
    var number_of_steps = progress_line_object.data('number-of-steps');
    var now_value = progress_line_object.data('now-value');
    var new_value = 0;
    if (direction == 'right') {
        new_value = now_value + (100 / number_of_steps);
    }
    else if (direction == 'left') {
        new_value = now_value - (100 / number_of_steps);
    }
    progress_line_object.attr('style', 'width: ' + new_value + '%;').data('now-value', new_value);
}

$(document).ready(function () {
    // Form
    $('.f1 fieldset:first').fadeIn('slow');

    $('.f1 input[type="text"], .f1 input[type="password"], .f1 textarea').on('focus', function () {
        $(this).removeClass('input-error');
    });

    $('.f1 .btn-next').on('click', function () {
        var parent_fieldset = $(this).parents('fieldset');
        var next_step = true;
        // navigation steps / progress steps
        var current_active_step = $(this).parents('.f1').find('.f1-step.active');
        var progress_line = $(this).parents('.f1').find('.f1-progress-line');

        // validasi form
        parent_fieldset.find('input[type="text"], input[type="password"], input[type="date"], input[type="file"], textarea, select').each(function () {
            if ($(this).val() == "" || $(this).val() == null) {
                $(this).addClass('input-error');
                next_step = false;
            } else {
                $(this).removeClass('input-error');
            }

            // Validasi tambahan untuk input file
            if ($(this).attr('type') === 'file') {
                var file = this.files[0];
                if (!file) {
                    $(this).addClass('input-error');
                    next_step = false;
                } else {
                    // Validasi tipe file
                    var validTypes = ['image/jpeg', 'image/png', 'image/gif'];
                    if (!validTypes.includes(file.type)) {
                        alert('File harus berupa gambar (JPG, PNG, GIF).');
                        $(this).addClass('input-error');
                        next_step = false;
                    }

                    // Validasi ukuran file (maks 2MB)
                    var maxSize = 2 * 1024 * 1024; // 2MB
                    if (file.size > maxSize) {
                        alert('Ukuran file tidak boleh lebih dari 2MB.');
                        $(this).addClass('input-error');
                        next_step = false;
                    }
                }
            }
        });

        if (next_step) {
            // Proceed to the next step
            parent_fieldset.fadeOut(400, function () {
                $(this).next().fadeIn();
            });

            current_active_step.removeClass('active').addClass('activated').next().addClass('active');
            // Update progress line
            progress_line.css('width', (current_active_step.index() + 1) * 25 + '%');
        }
    });



    // step sbelumnya (ketika klik tombol sebelumnya)
    $('.f1 .btn-previous').on('click', function () {
        // navigation steps / progress steps
        var current_active_step = $(this).parents('.f1').find('.f1-step.active');
        var progress_line = $(this).parents('.f1').find('.f1-progress-line');

        $(this).parents('fieldset').fadeOut(400, function () {
            // change icons
            current_active_step.removeClass('active').prev().removeClass('activated').addClass('active');
            // progress bar
            bar_progress(progress_line, 'left');
            // show previous step
            $(this).prev().fadeIn();
            // scroll window to beginning of the form
            scroll_to_class($('.f1'), 20);
        });
    });

    // submit (ketika klik tombol submit diakhir wizard)
    $('.f1').on('submit', function (e) {
        var isValid = true;

        // Validasi form
        $(this).find('input[type="text"], input[type="password"], input[type="date"], input[type="file"], textarea, select').each(function () {
            if ($(this).val() == "" || $(this).val() == null) {
                e.preventDefault();
                $(this).addClass('input-error');
                isValid = false;
            } else {
                $(this).removeClass('input-error');
            }

            // Validasi tambahan untuk input file
            if ($(this).attr('type') === 'file') {
                var file = this.files[0];
                if (!file) {
                    e.preventDefault();
                    $(this).addClass('input-error');
                    isValid = false;
                } else {
                    // Validasi tipe file
                    var validTypes = ['image/jpeg', 'image/png', 'image/gif'];
                    if (!validTypes.includes(file.type)) {
                        alert('File harus berupa gambar (JPG, PNG, GIF).');
                        e.preventDefault();
                        $(this).addClass('input-error');
                        isValid = false;
                    }

                    // Validasi ukuran file (maks 2MB)
                    var maxSize = 2 * 1024 * 1024; // 2MB
                    if (file.size > maxSize) {
                        alert('Ukuran file tidak boleh lebih dari 2MB.');
                        e.preventDefault();
                        $(this).addClass('input-error');
                        isValid = false;
                    }
                }
            }
        });

        // Jika semua validasi lolos
        if (isValid) {
            alert('Form berhasil disubmit!');
        }
    });

});