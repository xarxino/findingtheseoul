/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["../*.php", "../**/*.php", "../**/*.js"],
  theme: {
    extend: {
      colors: {
        primary: "#1e1e1e",
        secondary: "#f5f5f5",
        accent: "#f5f5f5",
      },
      fontFamily: {
        body: ["Open Sans", "sans-serif"],
        display: ["Marcellus", "serif"],
      },
    },
  },
  plugins: [],
};
