import process from 'node:process';
import path from 'path';
import { fileURLToPath } from 'url';
const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

import { defineConfig, loadEnv } from 'vite';
import react from '@vitejs/plugin-react';

export default defineConfig(({ mode }) => {
  const env = loadEnv(mode, process.cwd(), '');
  return {
    server: {
      port: 5176,
      host: true,
      open: true
    },
    build: {
      outDir: 'publik/dist',
      assetsDir: 'assets',
      manifest: true,
      emptyOutDir: true,
      rollupOptions: {
        input: './index.html',
        output: {
          manualChunks: undefined
        }
      }
    },
    base: '', // Use empty string for relative paths to ensure flexibility
    plugins: [react()],
    css: {
      postcss: './konfigurasi/postcss.config.js',
    },
    define: {
      'process.env.API_KEY': JSON.stringify(env.GEMINI_API_KEY),
      'process.env.GEMINI_API_KEY': JSON.stringify(env.GEMINI_API_KEY)
    },
    resolve: {
      alias: {
        '@': path.resolve(__dirname, './sumber'),
        '@komponen': path.resolve(__dirname, './sumber/komponen'),
        '@layanan': path.resolve(__dirname, './sumber/layanan'),
        '@utilitas': path.resolve(__dirname, './sumber/utilitas'),
        '@gaya': path.resolve(__dirname, './sumber/gaya'),
        '@tipe': path.resolve(__dirname, './sumber/tipe'),
        '@api': path.resolve(__dirname, './api')
      }
    }
  };
});
