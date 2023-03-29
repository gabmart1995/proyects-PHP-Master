var url = 'http://larafoto.local/';

jQuery(document).on('DOMContentLoaded', function () {
    
    function like() {

        // desvincula los eventos y los vuelve a reasignar
        buttonLike = $('.btn-like');
        buttonLike
            .off('click')
            .on('click', function () {

                var icon = $(this);

                // peticion ajax
                ($).ajax({
                    url: url + '/like/' + $(this).data('id'),
                    method: 'GET',
                    success: function (response) {
                        
                        if (!response.like) {
                            console.log(response.message);
                            return;
                        }

                        console.log('Has dado like a la publicacion');

                        icon.addClass('btn-dislike').removeClass('btn-like');
                        icon.attr('src', (url + 'img/heart-red.gif'));

                        dislike();
                    },
                    error: function (response) {
                        console.error(response);
                    }
                });
            }); 
    }

    function dislike() {

        buttonDislike = $('.btn-dislike');
        buttonDislike
            .off('click')
            .on('click', function () {
                
                var icon = $(this);

                // peticion ajax
                ($).ajax({
                    url: url + '/dislike/' + $(this).data('id'),
                    method: 'GET',
                    success: function (response) {
                        
                        if (!response.like) {
                            console.log(response.message);
                            return;
                        }
                        
                        console.log('Has dado dislike a la publicacion');

                        icon.addClass('btn-like').removeClass('btn-dislike');
                        icon.attr('src', (url + 'img/heart-black.gif'));
                        
                        like();
                    },
                    error: function (response) {
                        console.error(response);
                    }
                });
            });
    }

    var buttonLike = $('.btn-like');
    var buttonDislike = $('.btn-dislike');

    // cursor pointer
    buttonLike.css('cursor', 'pointer');
    buttonDislike.css('cursor', 'pointer');

    // ejecutamos los eventos
    like();
    dislike();
});
