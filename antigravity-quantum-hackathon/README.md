# AntiGravity Quantum Hackathon 2026

A professional quantum computing hackathon website built with Next.js 15, TypeScript, and Tailwind CSS.

## Tech Stack

- **Frontend**: Next.js 15 (App Router), TypeScript, Tailwind CSS
- **UI Components**: Lucide React Icons
- **Styling**: Tailwind CSS with custom quantum-themed colors
- **Build Tool**: Next.js built-in compiler

## Features

- Modern, responsive design
- Quantum-themed color scheme with neon effects
- Smooth animations and transitions
- Mobile-friendly navigation
- Multiple sections: Hero, About, Challenges, Prizes, Judges, Agenda, FAQ

## Getting Started

### Install Dependencies

```bash
npm install
```

### Run Development Server

```bash
npm run dev
```

Open [http://localhost:3000](http://localhost:3000) in your browser.

### Build for Production

```bash
npm run build
npm start
```

## Project Structure

```
antigravity-quantum-hackathon/
├── app/
│   ├── globals.css
│   ├── layout.tsx
│   └── page.tsx
├── components/
│   ├── About.tsx
│   ├── Agenda.tsx
│   ├── Challenges.tsx
│   ├── FAQ.tsx
│   ├── Footer.tsx
│   ├── Hero.tsx
│   ├── Judges.tsx
│   ├── Navigation.tsx
│   └── Prizes.tsx
├── lib/
│   └── utils.ts
├── public/
├── package.json
├── tailwind.config.ts
├── tsconfig.json
└── next.config.js
```

## Customization

### Colors

The project uses custom quantum-themed colors defined in `tailwind.config.ts`:
- `quantum-*`: Primary color palette
- `neon-*`: Accent colors (purple, blue, cyan, pink)

### Animations

Custom animations include:
- `pulse-slow`: Slow pulsing effect
- `float`: Floating animation
- `glow`: Glowing effect

## License

MIT License
