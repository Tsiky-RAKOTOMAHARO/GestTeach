<script setup>
import AppSideBar from '@/components/common/AppSideBar.vue'
import AppTopBar from '@/components/common/AppTopBar.vue'
import { RouterView } from 'vue-router'
</script>

<template>
  <div class="app-shell">
    <aside class="sidebar-container">
      <AppSideBar/>
    </aside>
    <div class="main-content">
      <header class="topbar-container">
        <AppTopBar/>
      </header>
      <main class="page-content">
        <RouterView/>
      </main>
    </div>
  </div>
</template>

<style scoped>
.app-shell {
  width: 100vw;
  height: 100vh;
  display: flex;
  flex-direction: row;
  overflow: hidden;
}

.sidebar-container {
  width: 250px;
  height: 100%;
  flex-shrink: 0;
  border-right: 1px solid #e2e8f0;
}

.main-content {
  flex: 1;
  display: flex;
  flex-direction: column;
  align-items: stretch;
  overflow: hidden;
}

.topbar-container {
  width: 100%;
  height: 60px;
  flex-shrink: 0;
  border-bottom: 1px solid #e2e8f0;
}

.page-content {
  flex: 1;
  width: 100%;
  overflow-y: auto;
  padding: 24px;
}
</style>