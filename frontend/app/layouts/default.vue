<template>
  <div class="relative min-h-screen">
    <AppBackground />
    <AppNavbar />
    <main id="main" class="relative">
      <slot />
    </main>
    <AppFooter />
  </div>
</template>
