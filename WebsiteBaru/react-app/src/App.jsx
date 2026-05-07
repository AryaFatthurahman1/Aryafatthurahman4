import { useState } from 'react';

export default function App() {
  const [count, setCount] = useState(0);
  return (
    <div style={{ color: '#c8f7ff', padding: '1rem', background: '#1b1b1b', borderRadius:'0.6rem' }}>
      <h1>React Vite App</h1>
      <p>Counter: {count}</p>
      <button onClick={() => setCount((c) => c + 1)}>Tambah</button>
    </div>
  );
}
