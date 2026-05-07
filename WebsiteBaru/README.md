# WebsiteBaru - Multi-Framework Starter

Folder ini berisi demo dan starter untuk:

- `index.html`: Website hitam penuh dengan ML dataset subset.
- `framework-showcase.html`: Demo HTML, Bootstrap, React CDN, Vue CDN, TypeScript output, dan link ke proyek lainnya.
- `react-app/`: React + Vite starter.
- `vue-app/`: Vue + Vite starter.
- `next-app/`: Next.js starter.
- `angular-app/`: Angular skeleton dengan app sederhana.
- `laravel-sample/`: Laravel skeleton README.

## Jalankan website utama

```bash
cd d:\laragon\www\WebsiteBaru
python -m http.server 8000
```

Buka `http://localhost:8000/index.html` atau `http://localhost:8000/framework-showcase.html`.

## Jalankan React + Vue + Next + Angular

- `react-app` dan `vue-app`: `npm install` lalu `npm run dev`.
- `next-app`: `npm install` lalu `npm run dev`.
- `angular-app`: `npm install` lalu `npx ng serve --open`.

## ML subset script (Python)

`python subset_dataset.py input.csv output.csv --percent 30 --random-state 42`

