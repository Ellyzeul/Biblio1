const FILTER_OPTIONS_SELECTOR = "#filter-options > div"
const SELECTED_OPTION_CLASS = "filter-option-selected"
const UNSELECTED_OPTION_CLASS = "filter-option"
const SELECTED_FILTER_SELECTOR = "#search-filter"
const SEARCH_INPUT_SELECTOR = "#search-input"
const SEARCH_BUTTON_SELECTOR = "#search-button"

const _pageState = {}

_pageState.filterOptions = Array.from(document.querySelectorAll(FILTER_OPTIONS_SELECTOR))
_pageState.selectedFilter = document.querySelector(SELECTED_FILTER_SELECTOR)
_pageState.filterOptionsMap = {
  "TÍTULO": "title",
  "ISBN": "isbn",
  "AUTOR": "author",
  "EDITORA": "publisher",
}
_pageState.searchInput = document.querySelector(SEARCH_INPUT_SELECTOR)
_pageState.searchButton = document.querySelector(SEARCH_BUTTON_SELECTOR)

_pageState.filterOptions.forEach(option => option.addEventListener('click', () => {
  document.querySelector(`.${SELECTED_OPTION_CLASS}`).className = UNSELECTED_OPTION_CLASS
  option.className = SELECTED_OPTION_CLASS
  _pageState.selectedFilter.value = _pageState.filterOptionsMap[option.textContent]
}))

_pageState.searchEvent = () => {
  const searchTerm = _pageState.searchInput.value
  if(!searchTerm) return
  const filter = _pageState.selectedFilter.value

  const anchor = document.createElement('a')
  anchor.href = `/resultado?${filter}=${searchTerm}`
  anchor.click()
}

_pageState.searchButton.addEventListener('click', _pageState.searchEvent)
_pageState.searchInput.addEventListener('keydown', (event) => event.key === "Enter"
  ? _pageState.searchEvent()
  : null
)
