const FILTER_OPTIONS_SELECTOR = "#filter-options > div"
const SELECTED_OPTION_CLASS = "filter-option-selected"
const UNSELECTED_OPTION_CLASS = "filter-option"
const SELECTED_FILTER_SELECTOR = "#search-filter"
const SEARCH_INPUT_SELECTOR = "#search-input"
const SEARCH_BUTTON_SELECTOR = "#search-button"
const SEARCH_ERROR_DISPLAY = "#search-error-msg"

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
_pageState.searchErrorDisplay = document.querySelector(SEARCH_ERROR_DISPLAY)

_pageState.filterOptions.forEach(option => option.addEventListener('click', () => {
  document.querySelector(`.${SELECTED_OPTION_CLASS}`).className = UNSELECTED_OPTION_CLASS
  option.className = SELECTED_OPTION_CLASS
  _pageState.selectedFilter.value = _pageState.filterOptionsMap[option.textContent]
}))

_pageState.searchEvent = () => {
  const searchTerm = _pageState.searchInput.value
  const filter = _pageState.selectedFilter.value
  const anchor = document.createElement('a')

  if(!searchTerm) return
  if(_pageState.selectedFilter.value === "isbn") {
    const searchLen = searchTerm.length

    if(searchLen !== 10 && searchLen !== 13) {
      _pageState.searchErrorDisplay.style.visibility = "visible"
      return
    }
  }

  anchor.href = `/resultado?${filter}=${searchTerm}`
  anchor.click()
}

_pageState.searchButton.addEventListener('click', _pageState.searchEvent)
_pageState.searchInput.addEventListener('keydown', (event) => {
  if(event.key !== "Enter") return

  _pageState.searchEvent()
})
_pageState.searchInput.addEventListener('input', (event) => {
  const input = event.target
  const value = input.value
  const passInput = !(/^[0-9]{0,1}$/.test(event.data))

  _pageState.searchErrorDisplay.style.visibility = "hidden"
  if(_pageState.selectedFilter.value !== "isbn") return

  input.value = passInput 
    ? event.data ? value.substring(0, value.length - 1) : value
    : value
})
