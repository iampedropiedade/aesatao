
/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    '../service/application/blocks/**/*.php',
    '../service/application/blocks/**/**/*.php',
    '../service/application/single_pages/*.php',
    '../service/application/authentication/**/*.php',
    '../service/application/themes/aesatao/elements/*.php',
    '../service/application/themes/aesatao/widgets/*.php',
    '../service/application/themes/aesatao/includes/*.php',
    '../service/application/themes/aesatao/homepage.php',
    '../service/application/themes/aesatao/news_article.php',
    '../service/application/themes/aesatao/page.php',
    '../service/application/themes/aesatao/page_not_found.php',
    '../service/application/themes/aesatao/view.php',
    './js/**/*.js',
    './js/**/*.vue',
  ],
  darkMode: 'class',
  theme: {
    fontFamily: {
      'IBMPlexSerif': ['IBM Plex Serif', 'serif'],
      'SpaceGrotesk': ['Space Grotesk', 'sans-serif'],
      'Manrope': ['Manrope', 'sans-serif'],
      'Monospace': ['SFMono-Regular,Menlo,Monaco,Consolas,"Liberation Mono","Courier New",monospace'],
      'SansSerif': ['sans-serif'],
      'Urbanist': ['Urbanist', 'sans-serif'],
      'DMSerif': ['DM Serif Display', 'serif'],
    },
    container: {
      center: true,
      padding: '15px',
    },
    extend: {
      colors: {
        brightGray: '#e4f1f6',
        royalBlue : '#467498',
        darkElectricBlue : '#60697b',
        bunker: '#11171f',
        camarone: '#005908',
        crete: '#7c722b',
        gravel: '#464547',
        mirage: '#19212c',
        orinoco: '#d7d5b5',
        redBerry: '#961200',
        silverSand: '#c9cacc',
        springWood: '#f3f2e9',
        straw: '#d7cd89',
        tana: '#d7d5b5',
        aesataoAlt: {
          DEFAULT: '#660066', // alias for 500
          50:  '#faf5fa',
          100: '#f1e6f1',
          200: '#dec1de',
          300: '#c290c2',
          400: '#9f569f',
          500: '#660066', // base
          600: '#550055',
          700: '#440044',
          800: '#320032',
          900: '#220022',
          950: '#130013',
        },
        aesatao: {
          DEFAULT: '#adca06', // alias for 500
          50:  '#f8fbe7',
          100: '#ecf5b7',
          200: '#ddef7e',
          300: '#cce744',
          400: '#bade1c',
          500: '#adca06', // base
          600: '#95ad05',
          700: '#7b8e04',
          800: '#606f03',
          900: '#445102',
          950: '#2f3601',
        },
      },
      screens: {
        'xxl': {
          'min': '1400px',
        },
        'xl': {
          'min': '1200px',
        },
        'lg': {
          'min': '992px',
        },
        'md': {
          'min': '768px',
        },
        'sm': {
          'min': '576px',
        },
        'xs': {
          'max': '575.98px'
        },
      },
    },
  },
  plugins: [
    function ({
                addComponents
              }) {
      addComponents({
        '.container': {
          maxWidth: '100%',
          '@screen sm': {
            maxWidth: '540px',
          },
          '@screen md': {
            maxWidth: '720px',
          },
          '@screen lg': {
            maxWidth: '960px',
          },
          '@screen xl': {
            maxWidth: '1140px',
          },
          '@screen xxl': {
            maxWidth: '1320px',
          },
        }
      })
    }],
}
