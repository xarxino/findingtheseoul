const path = require("path");
const webpack = require("webpack");
const { CleanWebpackPlugin } = require("clean-webpack-plugin");
const CssMinimizerPlugin = require("css-minimizer-webpack-plugin");
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const TerserPlugin = require("terser-webpack-plugin");
const zlib = require("zlib");
const isDev = process.env.NODE_ENV === "development";

// Replace these values with the desired local and target URLs for the website
const LOCAL_URL = "http://localhost:3000";
const TARGET_URL = "http://findingtheseoul.local";

// Function to replace all occurrences of the target URL with the local URL in the given string
function updateSiteUrls(body) {
  return body.replace(new RegExp(TARGET_URL, "g"), LOCAL_URL);
}

module.exports = {
  mode: isDev ? "development" : "production",
  devtool: isDev ? "eval" : "source-map",
  entry: "./assets/src/index.js",
  output: {
    path: path.resolve(__dirname, "assets/dist"),
    filename: "bundle.js",
    publicPath: isDev ? "/" : "./",
  },
  module: {
    rules: [
      {
        test: /\.css$/,
        use: [
          isDev ? "style-loader" : MiniCssExtractPlugin.loader,
          "css-loader",
          {
            loader: "postcss-loader",
            options: {
              postcssOptions: {
                plugins: [require("tailwindcss"), require("autoprefixer")],
              },
            },
          },
        ],
      },
      {
        test: /\.js$/,
        exclude: /node_modules/,
        use: ["babel-loader"],
      },
      {
        test: /\.(png|jpe?g|gif|svg)$/i,
        type: "asset/resource",
        generator: {
          filename: "img/[name][ext]",
        },
      },
    ],
  },
  plugins: [
    new CleanWebpackPlugin(),
    new MiniCssExtractPlugin({
      filename: "styles.css",
    }),
    // Create environment variables for use in the application
    new webpack.EnvironmentPlugin({
      NODE_ENV: process.env.NODE_ENV,
      WP_THEME_URL: process.env.WP_THEME_URL || "http://localhost",
    }),
  ],
  performance: {
    hints: isDev ? false : "warning",
  },
  optimization: {
    minimize: !isDev,
    minimizer: [
      new CssMinimizerPlugin({
        minimizerOptions: {
          preset: [
            "default",
            {
              discardComments: { removeAll: true },
            },
          ],
        },
      }),
      new TerserPlugin({
        terserOptions: {
          format: {
            comments: false,
          },
        },
        extractComments: true,
      }),
    ],
  },
  devServer: {
    static: path.join(__dirname, "assets/dist"),
    compress: true,
    port: 3000,
    open: process.env.WP_THEME_URL !== "http://localhost",
    historyApiFallback: true,
    devMiddleware: {
      writeToDisk: true,
    },
    proxy: {
      "/**": {
        target: process.env.WP_THEME_URL || TARGET_URL,
        changeOrigin: true,
        // Customize the response received from the proxy target
        onProxyRes: (proxyRes, req, res) => {
          // Check if the response is an HTML file
          const isHtml =
            proxyRes.headers["content-type"] &&
            proxyRes.headers["content-type"].includes("text/html");
          if (isHtml) {
            const contentEncoding = proxyRes.headers["content-encoding"];
            const isGzip = contentEncoding && contentEncoding.includes("gzip");
            const originalBodyWrite = res.write;
            const originalBodyEnd = res.end;
            const chunks = [];

            proxyRes.on("data", (chunk) => {
              chunks.push(chunk);
            });

            proxyRes.on("end", () => {
              const buffer = Buffer.concat(chunks);
              // Function to update the response body with the correct URLs and compress it, if needed
              const onResponseData = (decodedBody) => {
                const updatedBody = updateSiteUrls(decodedBody);
                res.setHeader(
                  "content-length",
                  Buffer.byteLength(updatedBody, "utf8")
                );

                if (isGzip) {
                  res.setHeader("content-encoding", "gzip");
                  zlib.gzip(updatedBody, (err, gzippedBody) => {
                    if (err) {
                      res.writeHead(500);
                      res.end("Error compressing response");
                    } else {
                      originalBodyWrite.call(res, gzippedBody);
                      originalBodyEnd.call(res);
                    }
                  });
                } else {
                  originalBodyWrite.call(res, updatedBody);
                  originalBodyEnd.call(res);
                }
              };

              if (isGzip) {
                zlib.gunzip(buffer, (err, decodedBuffer) => {
                  if (err) {
                    res.writeHead(500);
                    res.end("Error decompressing response");
                  } else {
                    onResponseData(decodedBuffer.toString("utf8"));
                  }
                });
              } else {
                onResponseData(buffer.toString("utf8"));
              }
            });

            res.write = () => {};
            res.end = () => {};
          }
        },
      },
    },
    client: {
      overlay: true,
    },
    watchFiles: ["**/*.php"],
  },
};
