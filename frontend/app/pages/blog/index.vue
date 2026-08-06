<script setup lang="ts">
useSeo({
  title: 'Blog',
  description:
    'Articles about web development, WordPress, Laravel and the modern JavaScript ecosystem.',
})

const posts = [] as { title: string; slug: string; excerpt: string; date: string; tags: string[] }[]
</script>

<template>
  <div>
    <PageHero
      eyebrow="Blog"
      title="Writing about the web"
      description="Notes, tutorials and lessons learned while building for the web. The feed will be wired to the Laravel API once the content pipeline is live."
    />

    <section class="container-page pb-24">
      <div v-if="posts.length" class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
        <AppCard v-for="post in posts" :key="post.slug">
          <AppBadge variant="accent">Article</AppBadge>
          <h3 class="mt-3 font-display text-lg font-semibold">{{ post.title }}</h3>
          <p class="mt-2 text-sm text-[color:var(--color-muted)]">{{ post.excerpt }}</p>
        </AppCard>
      </div>

      <div v-else v-reveal class="card-surface flex flex-col items-center gap-4 p-12 text-center">
        <span
          class="flex h-14 w-14 items-center justify-center rounded-full bg-violet-500/10 text-violet-300"
        >
          <Icon name="lucide:file-text" :size="26" aria-hidden="true" />
        </span>
        <h2 class="font-display text-lg font-semibold">Coming soon</h2>
        <p class="max-w-md text-sm text-[color:var(--color-muted)]">
          The blog structure is ready — database, API and feed components are prepared so articles
          can drop straight in.
        </p>
      </div>
    </section>
  </div>
</template>
