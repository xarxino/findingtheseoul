// Tailwind CSS Configuration File for WordPress Theme Development
// https://tailwindcss.com/docs/configuration

module.exports = {
  content: ["**/*.html", "**/*.php"],
  theme: {
    extend: {
      backgroundImage: {
        hangul: "url('../../assets/dist/img/hangul-bg.svg')",
      },
      backgroundSize: {
        auto: "auto",
        cover: "cover",
        contain: "contain",
        "50%": "50%",
        16: "4rem",
      },
      fontFamily: {
        body: ['"Open Sans"', "sans-serif"],
        display: ["Marcellus", "serif"],
      },
    },
  },
  variants: {},
  plugins: [],
};
