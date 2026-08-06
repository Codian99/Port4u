<script setup lang="ts">
import type { NuxtError } from '#app'

const props = defineProps<{
  error: NuxtError
}>()

useSeo({
  title: props.error.statusCode === 404 ? 'Page not found' : 'Something went wrong',
  description: 'The page you are looking for could not be found.',
})
</script>

<template>
  <div class="relative flex min-h-screen items-center justify-center">
    <AppBackground />

    <div class="container-page relative z-10 py-24 text-center">
      <p class="font-display text-8xl font-bold text-gradient sm:text-9xl">
        {{ error.statusCode ?? 500 }}
      </p>
      <h1 class="mt-6 font-display text-2xl font-semibold sm:text-3xl">
        {{ error.statusCode === 404 ? 'Page not found' : 'Something went wrong' }}
      </h1>
      <p class="mx-auto mt-4 max-w-md text-sm text-[color:var(--color-muted)]">
        {{
          error.statusCode === 404
            ? 'The page you are looking for does not exist or has been moved.'
            : error.message
        }}
      </p>
      <div class="mt-8 flex justify-center gap-3">
        <AppButton to="/" variant="primary" icon="lucide:home">Back to home</AppButton>
        <AppButton to="/contact" variant="outline" icon="lucide:mail">Contact me</AppButton>
      </div>
    </div>
  </div>
</template>
