<script setup lang="ts">
defineOptions({ name: 'AppBackground' })
</script>

<template>
  <div class="pointer-events-none fixed inset-0 z-0 overflow-hidden" aria-hidden="true">
    <div
      class="absolute inset-0 bg-grid bg-[length:44px_44px] opacity-60 [mask-image:radial-gradient(ellipse_at_top,black_0%,transparent_72%)]"
    />
    <div class="absolute inset-0 bg-radial-fade" />
    <div
      class="absolute -left-40 -top-44 h-[36rem] w-[36rem] rounded-full bg-violet-600/[0.13] blur-[150px] animate-float"
    />
    <div
      class="absolute right-0 top-1/4 h-[26rem] w-[26rem] rounded-full bg-cyan-500/[0.06] blur-[150px] animate-float"
      style="animation-delay: -4.5s"
    />
    <div
      class="absolute bottom-0 left-1/3 h-80 w-80 rounded-full bg-fuchsia-600/[0.05] blur-[140px]"
    />
    <div class="noise-overlay absolute inset-0 opacity-[0.05]" />
    <div
      class="absolute inset-x-0 bottom-0 h-40 bg-gradient-to-t from-[color:var(--color-bg)] to-transparent"
    />
  </div>
</template>
