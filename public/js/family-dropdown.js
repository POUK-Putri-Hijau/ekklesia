// Code adapted from "Tailwind CSS Dropdown with Search By dhaifullah"
// https://www.creative-tim.com/twcomponents/component/dropdown-with-search

const dropdown = el('family-dropdown');
const itemList = el('items');
const links = itemList.querySelectorAll('a');
const search = el('search-family');

const families = Array.from(links).map(link => link.textContent);

let isOpen = false;

function toggleDropdown() {
    isOpen = !isOpen;
    itemList.classList.toggle('hidden', !isOpen);
}

dropdown.onclick = toggleDropdown;

document.addEventListener('click', (event) => {
    if (event.target !== search) {
        isOpen = false;
        itemList.classList.add('hidden');
    }

    const a = event.target.closest('a');
    if (!a || !itemList.contains(a)) return;

    event.preventDefault();

    search.value = a.textContent.trim();
});

search.oninput = () => {
    const searchTerm = search.value.toLowerCase();

    links.forEach((item) => {
        const text = item.textContent.toLowerCase();
        if (text.includes(searchTerm)) {
            item.style.display = 'block';
        } else {
            item.style.display = 'none';
        }
    });
}

