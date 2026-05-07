const data = Array.from({ length: 50 }, (_, i) => ({
  id: i + 1,
  featureA: Math.round(Math.random() * 100),
  featureB: Math.round(Math.random() * 100),
  label: Math.random() > 0.5 ? 'positif' : 'negatif'
}));
const tableBody = document.getElementById('tableBody');
const output = document.getElementById('output');
const percentInput = document.getElementById('percent');
const sampleBtn = document.getElementById('sampleBtn');

function renderTable(items){
  tableBody.innerHTML = items.map(row =>
    `<tr><td>${row.id}</td><td>${row.featureA}</td><td>${row.featureB}</td><td>${row.label}</td></tr>`
  ).join('');
}

function subsetData(percent){
  const size = Math.max(1, Math.round(data.length * (Math.min(100, Math.max(10, percent)) / 100)));
  const shuffled = [...data].sort(() => Math.random() - 0.5);
  return shuffled.slice(0, size);
}

sampleBtn.addEventListener('click', ()=>{
  const p = Number(percentInput.value);
  if(Number.isNaN(p) || p < 10 || p > 100){
    output.textContent = 'Masukkan angka antara 10 sampai 100.';
    return;
  }
  const subset = subsetData(p);
  output.textContent = JSON.stringify(subset, null, 2);
  renderTable(subset);
});

renderTable(data);