$(function() {
    var locations = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
            url: 'suggestions.php?l=%QUERY',
            wildcard: '%QUERY',
            rateLimitWait: 0
        }
    });

    var names = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
            url: 'suggestions.php?n=%QUERY',
            wildcard: '%QUERY',
            rateLimitWait: 0
        }
    });

    var cuisines = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
            url: 'suggestions.php?t=%QUERY',
            wildcard: '%QUERY',
            rateLimitWait: 0
        }
    });

    $('#project').typeahead({
        highlight: true,
        hint: false
    }, {
        name: 'locations',
        display: 'value',
        source: locations,
        limit: 5,
        templates: {
            header: '<h4 class="suggestions-header">Locations</h4>'
        }
    }, {
        name: 'names',
        display: 'value',
        source: names,
        limit: 10,
        templates: {
            header: '<h4 class="suggestions-header">Restaurants</h4>'
        }
    }, {
        name: 'cuisines',
        display: 'value',
        source: cuisines,
        limit: 10,
        templates: {
            header: '<h4 class="suggestions-header">Cuisines</h4>'
        }
    });
});
