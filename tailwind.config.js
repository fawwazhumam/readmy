/** @type {import('tailwindcss').Config} */

import daisyui from "daisyui";

export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",],
  theme: {},
  plugins: [daisyui],

  daisyui: {
    themes: [
        {
          mytheme: {
              primary: "#369A69",
              secondary: "#474747",
              accent: "#37ab72",
              neutral: "#1B262C",
              "base-100": "#ffffff",
              info: "#0ea5e9",
              success: "#84cc16",
              warning: "#fde047",
              error: "#ff0000",
          },
        },
    ],
},
}

