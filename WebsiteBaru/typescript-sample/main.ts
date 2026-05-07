const greet = (name: string): string => `Halo, ${name}!`;
const output = document.getElementById('tsRoot');
if (output) output.textContent = greet('TypeScript');
