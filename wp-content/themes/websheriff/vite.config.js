import {defineConfig} from 'vite';
import path from 'path';
import {viteStaticCopy} from 'vite-plugin-static-copy';

export default defineConfig({
    plugins: [
        viteStaticCopy({
            targets: [
                {
                    src: 'library/js/vendor/*.js',
                    dest: 'vendor'
                },
                {
                    src: 'library/fonts/*',
                    dest: 'fonts'
                }
            ]
        })
    ],
    build: {
        outDir: 'min',
        emptyOutDir: false,
        rollupOptions: {
            input: {
                main: path.resolve(__dirname, 'library/js/main.js'),
                mainStyle: path.resolve(__dirname, 'library/scss/main.scss'),
                gutenberg: path.resolve(__dirname, 'library/scss/gutenberg.scss'),
            },
            output: {
                entryFileNames: '[name].js',
                assetFileNames: (assetInfo) => {
                    if (assetInfo.name === 'mainStyle.css') return 'main.css';
                    return '[name][extname]';
                },
            }
        }
    },
    css: {
        preprocessorOptions: {
            scss: {
                quietDeps: true
            }
        }
    }
});
