<script setup lang="ts">
defineOptions({ name: 'AppTimeline' })

interface TimelineItem {
  id: number | string
  title: string
  subtitle?: string
  period?: string
  location?: string | null
  description?: string
  tags?: string[]
  current?: boolean
  url?: string | null
}

withDefaults(
  defineProps<{
    items?: TimelineItem[]
  }>(),
  {
    items: () => [],
  }
)
</script>

<template>
  <ol class="relative space-y-10 border-l border-[color:var(--color-border)] pl-8">
    <li
      v-for="(item, index) in items"
      :key="item.id"
      v-reveal="{ delay: index * 0.08 }"
      class="relative"
    >
      <span
        class="absolute -left-8 top-1.5 flex h-4 w-4 -translate-x-1/2 items-center justify-center rounded-full border border-blue-400 bg-[color:var(--color-bg)]"
        aria-hidden="true"
      >
        <span class="h-1.5 w-1.5 rounded-full bg-blue-400" />
      </span>

      <div class="flex flex-wrap items-center gap-x-3 gap-y-1">
        <h3 class="text-lg font-semibold tracking-tight">
          <a
            v-if="item.url"
            :href="item.url"
            target="_blank"
            rel="noopener noreferrer"
            class="link-underline"
          >
            {{ item.title }}
          </a>
          <template v-else>{{ item.title }}</template>
        </h3>
        <AppBadge v-if="item.current" variant="success">Current</AppBadge>
      </div>

      <p v-if="item.subtitle" class="mt-0.5 text-sm font-medium text-blue-300">
        {{ item.subtitle }}
      </p>

      <p
        v-if="item.period || item.location"
        class="mt-1.5 flex flex-wrap items-center gap-3 text-sm text-[color:var(--color-muted)]"
      >
        <span v-if="item.period">
          <Icon name="lucide:calendar" :size="14" class="mr-1 inline" aria-hidden="true" />
          {{ item.period }}
        </span>
        <span v-if="item.location">
          <Icon name="lucide:map-pin" :size="14" class="mr-1 inline" aria-hidden="true" />
          {{ item.location }}
        </span>
      </p>

      <p
        v-if="item.description"
        class="mt-2.5 text-sm leading-relaxed text-[color:var(--color-muted)]"
      >
        {{ item.description }}
      </p>

      <ul v-if="item.tags?.length" class="mt-3.5 flex flex-wrap gap-2" aria-label="Technologies">
        <li v-for="tag in item.tags" :key="tag">
          <AppBadge>{{ tag }}</AppBadge>
        </li>
      </ul>
    </li>
  </ol>
</template>
