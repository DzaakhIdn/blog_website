/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./**/*.{html,js}",
    "node_modules/preline/dist/*.js",
  ],
  theme: {
    extend: {}
  },
  plugins: [
    require('daisyui'),
    require('preline/plugin')
  ],
}

