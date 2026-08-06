<script setup lang="ts">
defineOptions({ name: 'AppBackground' })

const canvasRef = ref<HTMLCanvasElement | null>(null)

let ctx: CanvasRenderingContext2D | null = null
let particles: { x: number; y: number; r: number; vx: number; vy: number; hue: number }[] = []
let raf = 0
let animationStarted = false

function initCanvas() {
  const canvas = canvasRef.value!
  if (!canvas) return

  ctx = canvas.getContext('2d')
  if (!ctx) return

  const context = ctx
  const reduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches

  function resize() {
    canvas.width = window.innerWidth
    canvas.height = window.innerHeight
  }

  resize()
  window.addEventListener('resize', resize)

  if (reduced) return

  const count = Math.min(60, Math.floor(window.innerWidth / 24))
  particles = Array.from({ length: count }, () => ({
    x: Math.random() * canvas.width,
    y: Math.random() * canvas.height,
    r: Math.random() * 1.6 + 0.4,
    vx: (Math.random() - 0.5) * 0.25,
    vy: (Math.random() - 0.5) * 0.25,
    hue: 240 + Math.random() * 60,
  }))

  function draw() {
    if (!context || !canvasRef.value) return

    context.clearRect(0, 0, canvas.width, canvas.height)

    for (const p of particles) {
      p.x += p.vx
      p.y += p.vy

      if (p.x < 0 || p.x > canvas.width) p.vx *= -1
      if (p.y < 0 || p.y > canvas.height) p.vy *= -1

      context.beginPath()
      context.arc(p.x, p.y, p.r, 0, Math.PI * 2)
      context.fillStyle = `hsla(${p.hue}, 70%, 65%, 0.35)`
      context.fill()
    }

    raf = requestAnimationFrame(draw)
  }

  draw()
}

onMounted(() => {
  if (!animationStarted) {
    initCanvas()
    animationStarted = true
  }
})

onBeforeUnmount(() => {
  cancelAnimationFrame(raf)
})
</script>

<template>
  <div class="pointer-events-none fixed inset-0 z-0 overflow-hidden" aria-hidden="true">
    <div class="absolute inset-0 bg-grid bg-[length:48px_48px] opacity-40" />
    <div class="absolute inset-0 bg-radial-fade" />
    <div
      class="absolute -left-32 -top-32 h-96 w-96 rounded-full bg-violet-600/20 blur-[120px] animate-float"
    />
    <div
      class="absolute right-0 top-1/3 h-80 w-80 rounded-full bg-cyan-500/10 blur-[120px] animate-float"
      style="animation-delay: -4s"
    />
    <canvas ref="canvasRef" class="absolute inset-0 h-full w-full" />
    <div
      class="absolute inset-x-0 bottom-0 h-32 bg-gradient-to-t from-[color:var(--color-bg)] to-transparent"
    />
  </div>
</template>
