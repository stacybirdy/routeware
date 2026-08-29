document.addEventListener('DOMContentLoaded', function () {
	var glossaryFilters = document.querySelector('.glossary-filters');

	if (!glossaryFilters) {
		return;
	}

	var letterButtons = glossaryFilters.querySelectorAll('.alphabet-list__item');
	var resetButton = glossaryFilters.querySelector('.glossary-filters__btn');
	var glossaryItems = document.querySelectorAll('.glossary-term-item');
	var glossaryResults = document.getElementById('glossary-results');
	var searchForm = document.querySelector('.search-form');
	var searchInput = searchForm ? searchForm.querySelector('.search-form__input') : null;
	var noResultsMessage = document.querySelector('.glossary-no-results');
	var selectedLetter = '';
	var searchQuery = '';

	function showItem(item) {
		item.classList.remove('glossary-term-item--hidden');
	}

	function hideItem(item) {
		item.classList.add('glossary-term-item--hidden');
	}

	function getNoResultsMessage() {
		if (noResultsMessage) {
			return noResultsMessage;
		}

		if (!glossaryResults) {
			return null;
		}

		noResultsMessage = document.createElement('div');
		noResultsMessage.className = 'glossary-no-results';
		noResultsMessage.innerHTML = '<p>No glossary terms matched your search.</p>';
		glossaryResults.appendChild(noResultsMessage);

		return noResultsMessage;
	}

	function updateNoResultsState(visibleCount) {
		var message = getNoResultsMessage();

		if (!message) {
			return;
		}

		message.style.display = visibleCount === 0 ? '' : 'none';
	}

	function setActiveButton(activeButton) {
		letterButtons.forEach(function (button) {
			button.classList.remove('alphabet-list__item--active');
		});

		if (activeButton) {
			activeButton.classList.add('alphabet-list__item--active');
		}
	}

	function applyFilters() {
		var visibleCount = 0;

		glossaryItems.forEach(function (item) {
			var itemLetter = (item.dataset.letter || '').toUpperCase();
			var itemTitleEl = item.querySelector('.glossary-term-item__heading');
			var itemTitle = itemTitleEl ? itemTitleEl.textContent.toLowerCase() : '';
			var matchesLetter = !selectedLetter || itemLetter === selectedLetter;
			var matchesSearch = !searchQuery || itemTitle.indexOf(searchQuery) !== -1;

			if (matchesLetter && matchesSearch) {
				visibleCount += 1;
				showItem(item);
				return;
			}

			hideItem(item);
		});

		updateNoResultsState(visibleCount);
	}

	letterButtons.forEach(function (button) {
		button.addEventListener('click', function () {
			if (button.disabled) {
				return;
			}

			selectedLetter = (button.dataset.letter || '').toUpperCase();
			setActiveButton(button);
			applyFilters();
		});
	});

	if (resetButton) {
		resetButton.addEventListener('click', function () {
			selectedLetter = '';
			searchQuery = '';

			if (searchInput) {
				searchInput.value = '';
			}

			setActiveButton(null);
			applyFilters();
		});
	}

	if (searchForm && searchInput) {
		searchInput.addEventListener('input', function () {
			searchQuery = searchInput.value.trim().toLowerCase();
			applyFilters();
		});

		searchForm.addEventListener('submit', function (event) {
			event.preventDefault();
			searchQuery = searchInput.value.trim().toLowerCase();
			applyFilters();
		});
	}
});
