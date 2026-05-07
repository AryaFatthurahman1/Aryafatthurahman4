<template>
  <div class="app" style="color:#9afeff; background:#101b22; padding:1rem; border-radius:0.5rem;">
    <h1>Vue Vite App</h1>
    <p>Counter: {{ count }}</p>
    <button @click="count++">Tambah</button>
  </div>
</template>

<script>
export default {
  data() {
    return { count: 0 };
  }
};
</script>
