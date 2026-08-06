import { useHead } from '#imports'

interface SeoOptions {
  title: string
  description?: string
  image?: string
  type?: string
}

/**
 * Sets dynamic per-page SEO meta tags including OpenGraph and Twitter cards.
 */
export function useSeo(options: SeoOptions) {
  const config = useRuntimeConfig()
  const siteUrl = config.public.siteUrl.replace(/\/$/, '')
  const image = options.image
    ? options.image.startsWith('http')
      ? options.image
      : `${siteUrl}${options.image}`
    : `${siteUrl}/images/og-image.svg`

  useHead({
    title: options.title,
    meta: [
      { name: 'description', content: options.description ?? '' },
      { property: 'og:title', content: options.title },
      { property: 'og:description', content: options.description ?? '' },
      { property: 'og:type', content: options.type ?? 'website' },
      { property: 'og:image', content: image },
      { name: 'twitter:title', content: options.title },
      { name: 'twitter:description', content: options.description ?? '' },
      { name: 'twitter:image', content: image },
    ],
  })
}
