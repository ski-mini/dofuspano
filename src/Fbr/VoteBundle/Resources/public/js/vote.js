$( document ).ready(function() {

    $('.vote').on('click', '.FbrVote',function() {
        var element = $(this);
        element.css('opacity', '0.4').attr('disabled', 'disabled');
        $.ajax(
                {
                    type: 'POST',
                    url: Routing.generate('vote_vote'),
                    data: {
                        id: element.data('id'),
                        element: element.data('element'),
                        value: element.data('value')
                    },
                    dataType: "json",
                    success: function(json) {
                        element.css('opacity', '1').removeAttr('disabled').removeClass('alert-info alert-danger FbrVote');

                        if(element.data('value') === 1) {
                            element.addClass('alert-info');
                            element.next('button').addClass('FbrVote');
                            element.next('button').removeClass('alert-info alert-danger');
                        }
                        else {
                            element.addClass('alert-danger');
                            element.prev('button').addClass('FbrVote');
                            element.prev('button').removeClass('alert-info alert-danger');
                        }

                        element.blur();
                    }
                }
            );
    });



});