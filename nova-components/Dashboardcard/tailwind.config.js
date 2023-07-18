module.exports = {
  variants: {
    extend: {
      border: ['group-focus'],
      borderColor: ['group-focus'],
    }
  },
  plugins: [
    require("@tailwindcss/forms")({
      strategy: 'class',
    }),
  ],
  theme: {
    extend: {
      fontFamily: {
        'poppins': ['Poppins', 'sans-serif'],
      },
      colors: {
        'orange-primary': '#D87860',
        'orange-secondary': '#D87860',
        'blue-secondary': '#004878',
        'secondary-dark': '#023252',
        'gray-label': '#6E8691',
        'gray-offwhite': '#FCFCFC',
        'gray-line': '#D9E5E9',
        'gray-input': '#EFF5F7',
        'gray-placehold': '#A0B3BD',
        'red-error': '#B01A35',
        'green-success': '#3BA43B',
        'blue-tab': '#7296AE'
      }
    }
  }
};