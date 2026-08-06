import type { H3Event } from 'h3'

/**
 * Same-origin API proxy.
 *
 * The browser (and Nuxt SSR) call `/api/**` on this server and it forwards
 * the request to the Laravel backend. This avoids CORS entirely and works
 * identically in local dev, Docker and production.
 *
 * Configure the backend origin via `NUXT_BACKEND_URL`:
 *   - local: http://localhost:8000
 *   - docker: http://backend:8000
 */
export default defineEventHandler(async (event: H3Event) => {
  const config = useRuntimeConfig()
  const backendUrl = String(config.backendUrl).replace(/\/+$/, '')
  const path = (event.context.params?.path as string | undefined) ?? ''
  const target = `${backendUrl}/api/${path}`

  return proxyRequest(event, target)
})
