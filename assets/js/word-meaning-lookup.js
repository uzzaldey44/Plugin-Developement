jQuery(document).ready(function ($) {
    if ($('#word-meaning-popup').length === 0) {
        $('body').append('<div id="word-meaning-popup"></div>');
    }

    $('.entry-content p').on('click', function (e) {
        const word = window.getSelection().toString().trim();

        if (!word || word.split(/\s+/).length > 1) return;

        $.get(wml_ajax_obj.ajax_url, {
            action: 'wml_lookup',
            word: word
        }, function (response) {
            if (response.success) {
                const defs = response.data.map((d) => `<li>${d}</li>`).join('');
                showPopup(e.pageX, e.pageY, `<strong>${word}</strong>:<ul>${defs}</ul>`);
            } else {
                showPopup(e.pageX, e.pageY, `No meaning found for "<strong>${word}</strong>".`);
            }
        });
    });

    function showPopup(x, y, content) {
        const popup = $('#word-meaning-popup');
        popup.html(content).css({ top: y + 10, left: x + 10 }).fadeIn();

        clearTimeout(popup.data('timeout'));
        popup.data('timeout', setTimeout(() => popup.fadeOut(), 5000));
    }
});
