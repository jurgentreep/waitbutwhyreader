document.addEventListener('DOMContentLoaded', function(event) {
    var popup = document.querySelector('.last-position');
    var yes = document.querySelector('button[name="yes"]');
    var no = document.querySelector('button[name="no"]');
    var storedScrollPositions = JSON.parse(localStorage.getItem('scrollPositions'));
    if(storedScrollPositions === null) storedScrollPositions = [];

    window.addEventListener('unload', function() {
        var scrollPosition = window.pageYOffset;

        if (storedScrollPositions.length > 0) {
            var state = false;
            storedScrollPositions.forEach(function(element) {
                if (element.url == window.location.href) {
                    element.offset = scrollPosition;
                    state = true;
                }
            });
            if (!state) {
                var page = {
                    url: window.location.href,
                    offset: scrollPosition
                };
                storedScrollPositions.push(page);
            }
        } else {
            var page = {
                url: window.location.href,
                offset: scrollPosition
            };
            storedScrollPositions.push(page);
        }

        localStorage.setItem('scrollPositions', JSON.stringify(storedScrollPositions));
    });

    var previousScrollPosition = scrollPositionExists();
    if(previousScrollPosition > 1000 && window.pageYOffset != previousScrollPosition) {
        popup.style.display = 'block';
        yes.addEventListener('click', function() {
            window.scrollTo(0, previousScrollPosition);
            popup.style.display = 'none';
        });
        no.addEventListener('click', function() {
            popup.style.display = 'none';
        });
    }

    function scrollPositionExists() {
        var value = 0;
        storedScrollPositions.forEach(function(element) {
            if (element.url == window.location.href) {
                value = element.offset;
            }
        });
        return value;
    }
});
