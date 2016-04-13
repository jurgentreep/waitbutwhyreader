document.addEventListener('DOMContentLoaded', function(event) {
    var popup = document.querySelector('.last-position');
    var yes = document.querySelector('button[name="yes"]');
    var no = document.querySelector('button[name="no"]');
    var storedScrollPosition = localStorage.getItem('scrollPosition');

    window.addEventListener('unload', function() {
        var scrollPosition = window.pageYOffset;
        localStorage.setItem('scrollPosition', scrollPosition);
    });
    
    if(storedScrollPosition > 500 && window.pageYOffset != storedScrollPosition) {
        popup.style.display = 'block';
        yes.addEventListener('click', function() {
            window.scrollTo(0, storedScrollPosition);
            popup.style.display = 'none';
        });
        no.addEventListener('click', function() {
            popup.style.display = 'none';
        });
    }
});
