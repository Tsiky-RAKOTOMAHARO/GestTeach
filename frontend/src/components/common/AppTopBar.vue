<script setup>
</script>

<template>
  <div class="topbar">
    <div class="topbar-left">
      <h2 class="page-title">Gestion des Enseignants</h2>
    </div>
    <div class="topbar-right">
      <div class="avatar">A</div>
    </div>
  </div>
</template>

<style scoped>
.topbar {
  display: flex;
  align-items: center;
  justify-content: space-between;
  height: 100%;
  padding: 0 var(--space-6);
  background: var(--color-surface-card);
  border-bottom: 1px solid var(--color-surface-border);
}

.page-title {
  font-size: var(--text-xl);
  font-weight: 600;
  color: var(--color-text-primary);
}

.avatar {
  width: 32px;
  height: 32px;
  border-radius: var(--radius-full);
  background: var(--color-primary-600);
  color: var(--color-text-inverse);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: var(--text-md);
  font-weight: 700;
}
</style>