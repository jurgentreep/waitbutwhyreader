document.addEventListener('DOMContentLoaded', function(event) {
    window.addEventListener('unload', function() {
        var scrollPosition = window.pageYOffset;
        localStorage.setItem('scrollPosition', scrollPosition);
    });
    if(localStorage.scrollPosition > 500 && window.pageYOffset != localStorage.scrollPosition) {
        document.querySelector('.last-position').style.display = 'block';
        document.querySelector('button[name="yes"]').addEventListener('click', function() {
            window.scrollTo(0, localStorage.getItem('scrollPosition'));
            document.querySelector('.last-position').style.display = 'none';
        });
        document.querySelector('button[name="no"]').addEventListener('click', function() {
            document.querySelector('.last-position').style.display = 'none';
        });
    }
});
