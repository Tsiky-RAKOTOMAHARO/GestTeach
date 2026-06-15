<script setup>
import { useRouter } from 'vue-router'
import { useAuthStore } from '@/store/auth'

const authStore = useAuthStore()
const router = useRouter()

function gererDeconnexion() {
  authStore.deconnecter()
  router.push('/')
}
</script>

<template>
  <div class="sidebar">
    <div class="sidebar-brand">
      <span class="brand-icon">🎓</span>
      <span class="brand-name">GestTeach</span>
    </div>

    <nav class="sidebar-nav">
      <RouterLink to="/create" class="nav-item">
        <img class="nav-icon" src="">
        <span>Ajout</span>
      </RouterLink>
      <RouterLink to="/list" class="nav-item">
        <img class="nav-icon" src="">
        <span>Liste</span>
      </RouterLink>
      <RouterLink to="/stats" class="nav-item">
        <img class="nav-icon" src=""> 
        <span>Bilan</span>
      </RouterLink>
    </nav>

    <div class="sidebar-footer">
      <button @click="gererDeconnexion" class="logout-btn">
        <img src="" alt="">
        <span>Déconnexion</span>
      </button>
    </div>
  </div>
</template>

<style scoped>
.sidebar {
  display: flex;
  flex-direction: column;
  height: 100%;
  background: var(--color-surface-card);
  border-right: 1px solid var(--color-surface-border);
  padding: var(--space-4);
}

.sidebar-brand {
  display: flex;
  align-items: center;
  gap: var(--space-3);
  padding: var(--space-4) var(--space-2);
  margin-bottom: var(--space-6);
}

.brand-icon {
  font-size: 22px;
}

.brand-name {
  font-size: var(--text-xl);
  font-weight: 700;
  color: var(--color-primary-600);
  letter-spacing: -0.3px;
}

.sidebar-nav {
  display: flex;
  flex-direction: column;
  gap: var(--space-1);
  flex: 1;
}

.nav-item {
  display: flex;
  align-items: center;
  gap: var(--space-3);
  padding: var(--space-3) var(--space-4);
  border-radius: var(--radius-md);
  text-decoration: none;
  color: var(--color-text-secondary);
  font-size: var(--text-md);
  font-weight: 500;
  transition: background 0.15s, color 0.15s;
}

.nav-item:hover {
  background: var(--color-surface-subtle);
  color: var(--color-primary-600);
}

.nav-item.router-link-active {
  background: var(--color-primary-50);
  color: var(--color-primary-600);
  font-weight: 600;
}

.nav-icon {
  font-size: 16px;
}

.sidebar-footer {
  padding-top: var(--space-4);
  border-top: 1px solid var(--color-surface-border);
}

.logout-btn {
  display: flex;
  align-items: center;
  gap: var(--space-3);
  width: 100%;
  padding: var(--space-3) var(--space-4);
  border: none;
  border-radius: var(--radius-md);
  background: transparent;
  color: var(--color-text-tertiary);
  font-size: var(--text-md);
  font-family: var(--font-mono);
  cursor: pointer;
  transition: background 0.15s, color 0.15s;
}

.logout-btn:hover {
  background: #FEF2F2;
  color: #DC2626;
}
</style>