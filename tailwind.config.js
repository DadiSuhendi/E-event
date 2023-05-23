module.exports = {
    content: [
      "./resources/**/*.blade.php",
      "./resources/**/*.js",
      "./resources/**/*.vue",
      "./node_modules/flowbite/**/*.js"
    ],
    theme: {
      fontFamily: {
        'raleway' : ['raleway', 'sans-serif'],
        'roboto' : ['Roboto', 'sans-serif']
      },
      colors: {
        'primary' : '#F3F4F6',
        'whatsapp': '#25D366',
        'btnPrimary': '#E2E8F0'
      },
      extend: {},
    },
    plugins: [
        require('flowbite/plugin')
    ],
  }