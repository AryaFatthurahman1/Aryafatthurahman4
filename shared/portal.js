document.addEventListener('DOMContentLoaded', () => {
  const searchInput = document.querySelector('[data-project-search]');
  const cards = Array.from(document.querySelectorAll('[data-project-card]'));

  if (searchInput && cards.length > 0) {
    const filterCards = () => {
      const keyword = searchInput.value.trim().toLowerCase();

      cards.forEach((card) => {
        const haystack = (card.getAttribute('data-project-text') || '').toLowerCase();
        const visible = keyword === '' || haystack.includes(keyword);
        card.classList.toggle('is-hidden', !visible);
      });
    };

    searchInput.addEventListener('input', filterCards);
    filterCards();
  }

  document.querySelectorAll('[data-count]').forEach((node) => {
    const finalValue = Number(node.getAttribute('data-count'));

    if (!Number.isFinite(finalValue) || finalValue <= 0) {
      return;
    }

    let current = 0;
    const step = Math.max(1, Math.ceil(finalValue / 30));

    const tick = () => {
      current = Math.min(finalValue, current + step);
      node.textContent = current.toLocaleString('id-ID');

      if (current < finalValue) {
        window.requestAnimationFrame(tick);
      }
    };

    window.requestAnimationFrame(tick);
  });
});
