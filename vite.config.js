import { defineConfig } from "vite";
import react from "@vitejs/plugin-react";

export default defineConfig({
  plugins: [react()],

  base: "/wp-content/plugins/psalmoteedata-landing/dist/",

  build: {
    manifest: true,
    rollupOptions: {
      input: "index.html",
    },
  },
});
