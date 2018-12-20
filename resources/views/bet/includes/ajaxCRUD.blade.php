<!-- AJAX CRUD operations -->

<input type="hidden" name="_token" value="{{ csrf_token() }}">

<script type="text/javascript">
    // add a new post
    function ingresarBet(objButton) {

        var home_score=$("#home_score"+objButton.value);
        var away_score=$("#away_score"+objButton.value);

        $.ajax({
            type: 'POST',
            url: 'store',
            data: {
                '_token': $('input[name=_token]').val(),
                'match_id': objButton.value,
                'home_score': $(home_score).val(),
                'away_score': $(away_score).val()
            },
            success: function(data) {

                if ((data.errors)) {
                    setTimeout(function () {
                        toastr.error('Validation error!', 'Error Alert', {timeOut: 5000});
                    }, 500);
                } else {
                    toastr.success('Successfully added Post!', 'Success Alert', {timeOut: 5000});
                }
            }
        });
    }
</script>
