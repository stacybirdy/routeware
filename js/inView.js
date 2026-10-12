// Adds .inView to .animate__animated elements once they enter the viewport.
//
// This used to run a requestAnimationFrame loop for the life of the page,
// calling getBoundingClientRect() on every element and then writing a class in
// the same pass. That is a layout read followed by a style write, 60 times a
// second, forever, which is what showed up as forced reflow and as the theme's
// largest single script cost. IntersectionObserver does the same job off the
// main thread and stops watching each element once it has been shown.

(function () {
	var elements = document.querySelectorAll('.animate__animated');

	if (!elements.length) {
		return;
	}

	// No IntersectionObserver: show everything rather than leave it hidden.
	if (!('IntersectionObserver' in window)) {
		Array.prototype.forEach.call(elements, function (element) {
			element.classList.add('inView');
		});
		return;
	}

	var observer = new IntersectionObserver(function (entries) {
		entries.forEach(function (entry) {
			if (entry.isIntersecting) {
				entry.target.classList.add('inView');
				observer.unobserve(entry.target);
			}
		});
	});

	Array.prototype.forEach.call(elements, function (element) {
		observer.observe(element);
	});
})();
