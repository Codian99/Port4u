# syntax=docker/dockerfile:1

# ---------- Builder ----------
FROM node:22-alpine AS builder

WORKDIR /app

COPY frontend/package.json frontend/package-lock.json ./
RUN npm ci

COPY frontend/ ./
# Regenerate Nuxt types with nuxt.config.ts present (npm ci's postinstall runs
# before the config is copied, which produces stale ~/ path mappings).
RUN npx nuxt prepare && npm run build

# ---------- Runner ----------
FROM node:22-alpine AS runner

ENV NODE_ENV=production
ENV PORT=3000
ENV HOST=0.0.0.0

WORKDIR /app

# Only the built output is needed at runtime (includes public assets)
COPY --from=builder /app/.output /app/.output

EXPOSE 3000

CMD ["node", ".output/server/index.mjs"]
