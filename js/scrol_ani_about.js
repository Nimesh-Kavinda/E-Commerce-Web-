document.addEventListener('DOMContentLoaded', function () {
    const section = document.getElementById('aboutus');

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                section.classList.add('visible');
                observer.unobserve(entry.target); // Stop observing after adding class
            }
        });
    });

    observer.observe(section);
});
