import withNuxt from './.nuxt/eslint.config.mjs'

export default withNuxt({
  ignores: ['.output', '.nuxt', 'node_modules', 'dist'],
  rules: {
    'vue/multi-word-component-names': 'off',
    'vue/no-v-html': 'off',
  },
})
