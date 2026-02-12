const el = (id) => document.getElementById(id);

el('query').onkeyup = (e) => {
    if (e.key === 'Enter') search();
}

el('search').onclick = () => {
    search();
}

function search() {
    const queryEl = el('query');
    const val = queryEl.value;

    if (!val.trim()) return;
    if (val.length > 60) return;

    const category = el('search').dataset.category;
    if (!category) return;

    const url = new URL(`/${category}/search/?name=${val}`, window.location.origin);
    window.location.href = url.toString();
}
