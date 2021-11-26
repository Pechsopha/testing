$(function() {
    $('#is_html').on('change', function() {
        const isTick = $(this).is(':checked');

        if (isTick) {
            $('#html').prop('disabled', false);
            $('#html').trigger('click');
        } else {
            $('#html').prop('disabled', true);
            $('#html').val('');
        }
    });

    $('#position').on('input', function() {
        const value = $(this).val();
        
        // 6 mean base on category
        if (Number(value) === 6) {
            $('[for="category"]').removeClass('d-none');
            $('#category').removeClass('d-none');
            
        } else {
            $('#category').addClass('d-none');
            $('#category').prop('disabled', true);
            $('[for="category"]').addClass('d-none');
        }
    });
});