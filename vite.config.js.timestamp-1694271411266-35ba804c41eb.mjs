// vite.config.js
import { defineConfig } from "file:///E:/gits/MVCForum/node_modules/vite/dist/node/index.js";
import laravel from "file:///E:/gits/MVCForum/node_modules/laravel-vite-plugin/dist/index.mjs";
import { resolve } from "path";
import { svelte } from "file:///E:/gits/MVCForum/node_modules/@sveltejs/vite-plugin-svelte/src/index.js";
var __vite_injected_original_dirname = "E:\\gits\\MVCForum";
var projectRootDir = resolve(__vite_injected_original_dirname);
var vite_config_default = defineConfig({
  plugins: [
    laravel({
      input: ["resources/css/app.css", "resources/js/app.js"],
      refresh: true
    }),
    svelte({
      /* plugin options */
    })
  ],
  optimizeDeps: {
    include: [
      "@inertiajs/inertia",
      "@inertiajs/inertia-svelte"
    ]
  },
  resolve: {
    alias: {
      "@": resolve(projectRootDir, "resources/js"),
      "~": resolve(projectRootDir, "resources")
    },
    extensions: [".js", ".svelte", ".json"]
  }
});
export {
  vite_config_default as default
};
//# sourceMappingURL=data:application/json;base64,ewogICJ2ZXJzaW9uIjogMywKICAic291cmNlcyI6IFsidml0ZS5jb25maWcuanMiXSwKICAic291cmNlc0NvbnRlbnQiOiBbImNvbnN0IF9fdml0ZV9pbmplY3RlZF9vcmlnaW5hbF9kaXJuYW1lID0gXCJFOlxcXFxnaXRzXFxcXE1WQ0ZvcnVtXCI7Y29uc3QgX192aXRlX2luamVjdGVkX29yaWdpbmFsX2ZpbGVuYW1lID0gXCJFOlxcXFxnaXRzXFxcXE1WQ0ZvcnVtXFxcXHZpdGUuY29uZmlnLmpzXCI7Y29uc3QgX192aXRlX2luamVjdGVkX29yaWdpbmFsX2ltcG9ydF9tZXRhX3VybCA9IFwiZmlsZTovLy9FOi9naXRzL01WQ0ZvcnVtL3ZpdGUuY29uZmlnLmpzXCI7aW1wb3J0IHsgZGVmaW5lQ29uZmlnIH0gZnJvbSAndml0ZSc7XG5pbXBvcnQgbGFyYXZlbCBmcm9tICdsYXJhdmVsLXZpdGUtcGx1Z2luJztcbmNvbnN0IHByb2plY3RSb290RGlyID0gcmVzb2x2ZShfX2Rpcm5hbWUpO1xuaW1wb3J0IHtyZXNvbHZlfSBmcm9tICdwYXRoJ1xuaW1wb3J0IHsgc3ZlbHRlIH0gZnJvbSAnQHN2ZWx0ZWpzL3ZpdGUtcGx1Z2luLXN2ZWx0ZSc7XG5cbmV4cG9ydCBkZWZhdWx0IGRlZmluZUNvbmZpZyh7XG4gICAgcGx1Z2luczogW1xuICAgICAgICBsYXJhdmVsKHtcbiAgICAgICAgICAgIGlucHV0OiBbJ3Jlc291cmNlcy9jc3MvYXBwLmNzcycsICdyZXNvdXJjZXMvanMvYXBwLmpzJ10sXG4gICAgICAgICAgICByZWZyZXNoOiB0cnVlLFxuICAgICAgICB9KSxcbiAgICAgICAgc3ZlbHRlKHtcbiAgICAgICAgICAgIC8qIHBsdWdpbiBvcHRpb25zICovXG4gICAgICAgIH0pXG4gICAgXSxcbiAgICBvcHRpbWl6ZURlcHM6IHtcbiAgICAgICAgaW5jbHVkZTogW1xuICAgICAgICAgICAgJ0BpbmVydGlhanMvaW5lcnRpYScsXG4gICAgICAgICAgICAnQGluZXJ0aWFqcy9pbmVydGlhLXN2ZWx0ZScsXG4gICAgICAgIF1cbiAgICB9LFxuICAgIHJlc29sdmU6IHtcbiAgICAgICAgYWxpYXM6IHtcbiAgICAgICAgICAgICdAJzogcmVzb2x2ZShwcm9qZWN0Um9vdERpciwgJ3Jlc291cmNlcy9qcycpLFxuICAgICAgICAgICAgJ34nOiByZXNvbHZlKHByb2plY3RSb290RGlyLCAncmVzb3VyY2VzJyksXG4gICAgICAgIH0sXG4gICAgICAgIGV4dGVuc2lvbnM6IFsnLmpzJywgJy5zdmVsdGUnLCAnLmpzb24nXSxcbiAgICB9XG59KTtcbiJdLAogICJtYXBwaW5ncyI6ICI7QUFBd08sU0FBUyxvQkFBb0I7QUFDclEsT0FBTyxhQUFhO0FBRXBCLFNBQVEsZUFBYztBQUN0QixTQUFTLGNBQWM7QUFKdkIsSUFBTSxtQ0FBbUM7QUFFekMsSUFBTSxpQkFBaUIsUUFBUSxnQ0FBUztBQUl4QyxJQUFPLHNCQUFRLGFBQWE7QUFBQSxFQUN4QixTQUFTO0FBQUEsSUFDTCxRQUFRO0FBQUEsTUFDSixPQUFPLENBQUMseUJBQXlCLHFCQUFxQjtBQUFBLE1BQ3RELFNBQVM7QUFBQSxJQUNiLENBQUM7QUFBQSxJQUNELE9BQU87QUFBQTtBQUFBLElBRVAsQ0FBQztBQUFBLEVBQ0w7QUFBQSxFQUNBLGNBQWM7QUFBQSxJQUNWLFNBQVM7QUFBQSxNQUNMO0FBQUEsTUFDQTtBQUFBLElBQ0o7QUFBQSxFQUNKO0FBQUEsRUFDQSxTQUFTO0FBQUEsSUFDTCxPQUFPO0FBQUEsTUFDSCxLQUFLLFFBQVEsZ0JBQWdCLGNBQWM7QUFBQSxNQUMzQyxLQUFLLFFBQVEsZ0JBQWdCLFdBQVc7QUFBQSxJQUM1QztBQUFBLElBQ0EsWUFBWSxDQUFDLE9BQU8sV0FBVyxPQUFPO0FBQUEsRUFDMUM7QUFDSixDQUFDOyIsCiAgIm5hbWVzIjogW10KfQo=
