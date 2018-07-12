$( document ).ready(function() {
    $('#search').typeahead({
        ajax: {
            url: Routing.generate('DpMainBundle_globalsearch'),
            method: 'POST',
            displayField: 'fullname',
            loadingClass: 'progress-bar progress-bar-search progress-bar-warning progress-bar-striped active',
            valueField: 'id'
        }
    });

    $('.typeahead').on('click', 'li', function() {
        $(location).attr('href', Routing.generate('DpMainBundle_stuff_voir', {user: 'user', stuffId: $(this).data('value') }));
    });

    $('.searchClasse').on('click', function(){
        $(location).attr('href', Routing.generate('DpMainBundle_advanced_search', {u: '', k: '', c: $(this).data('value') }));
    });
});