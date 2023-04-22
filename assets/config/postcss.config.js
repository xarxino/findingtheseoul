const path = require("path");

module.exports = {
  plugins: {
    tailwindcss: {
      config: path.resolve(process.cwd(), "assets/config/tailwind.config.js"),
    },
    autoprefixer: {},
  },
};
