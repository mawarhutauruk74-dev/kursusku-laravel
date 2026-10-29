import './bootstrap';
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap';
import $ from 'jquery';

window.$ = window.jQuery = $;
console.log('KURSUSKU APP.JS BERJALAN');

$(function () {
    const $course = $('#course_id');
    const $availability = $('#availability');

    function showMessage(message, type = 'info') {
        $availability
            .removeClass(
                'alert-info alert-success alert-danger alert-warning'
            )
            .addClass('alert-' + type)
            .text(message);
    }

    function checkAvailability() {
        const courseId = $course.val();

        if (!courseId) {
            showMessage(
                'Pilih kursus untuk melihat sisa kursi.',
                'info'
            );
            return;
        }

        showMessage('Memeriksa ketersediaan kursi...', 'info');

        $.ajax({
            url: '/courses/' + encodeURIComponent(courseId) + '/availability',
            method: 'GET',
            dataType: 'json',

            success: function (data) {
                if (data.status !== 'open') {
                    showMessage(
                        data.course + ' sedang ditutup.',
                        'danger'
                    );
                    return;
                }

                if (Number(data.remaining) <= 0) {
                    showMessage(
                        data.course + ' tidak memiliki kursi tersedia.',
                        'warning'
                    );
                    return;
                }

                showMessage(
                    data.remaining +
                        ' kursi tersisa untuk ' +
                        data.course + '.',
                    'success'
                );

                console.log('Respons AJAX:', data);
            },

            error: function (xhr) {
                showMessage(
                    'Gagal mengambil informasi kursi. Silakan coba lagi.',
                    'danger'
                );

                console.error(
                    'Kesalahan AJAX:',
                    xhr.status,
                    xhr.responseText
                );
            }
        });
    }

    $course.on('change', checkAvailability);

    checkAvailability();
});