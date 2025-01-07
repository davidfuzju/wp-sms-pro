#!/usr/bin/env node
import path from "path";
import { fileURLToPath } from 'url'
import yargs from 'yargs'
import { globSync } from "glob";
import watch from "watch"
import webpack from 'webpack'
import fs from "fs-extra"
import TerserPlugin from "terser-webpack-plugin";

const argv = yargs(process.argv.slice(1))
    .option('d', {
        alias: 'development',
        default: false,
        describe: 'Development mode',
        type: 'boolean'
    })
    .option('w', {
        alias: 'watch',
        default: false,
        describe: "Watch for changes?",
        type: 'boolean'
    })
    .help()
    .alias('h', 'help')
    .argv

const __dirname = path.dirname(fileURLToPath(import.meta.url))
const srcDir = path.resolve(__dirname, '../assets/src/js')
const outputDir = path.resolve(__dirname, '../assets/dist/js')

const makeCompiler = () => {
    return webpack({
        target: 'web',
        entry: globSync(`${srcDir}/**/*.js`, { 'ignore': `${srcDir}/modules/**` })
            .reduce((entries, filePath) => ({ ...entries, [path.relative(srcDir, filePath)]: path.resolve(filePath) }), {}),
        output: {
            path: outputDir,
            filename: '[name]',
        },
        optimization: {
            minimize: true,
            minimizer: [
                new TerserPlugin({
                    terserOptions: {
                        format: {
                            comments: false,
                        },
                    },
                    extractComments: false,
                }),
            ],
        },
        module: {
            rules: [
                {
                    test: /\.m?js$/,
                    exclude: /node_modules/,
                    use: {
                        loader: 'babel-loader',
                        options: {
                            presets: [
                                ['@babel/preset-env', { targets: fs.readJsonSync('./package.json').browserslist ?? "defaults" }]
                            ]
                        }
                    }
                }
            ]
        },
        watchOptions: {
            poll: 100
        },
        mode: argv.d ? 'development' : 'production',
    })
}

if (argv.w) {
    let recompileCount = 0
    const startWatching = compiler => {
        return compiler.watch({}, (err, stats) => {
            if (err) {
                console.error(err.stack || err);
                if (err.details) {
                    console.error(err.details);
                }
                return;
            }

            const info = stats.toString({
                preset: stats.hasErrors() || stats.hasWarnings() ? 'errors-warnings' : 'summary',
                colors: true
            })

            console.log(`${++recompileCount} : ${info}, elapse time: ${stats.endTime - stats.startTime} ms`);
        })
    }

    // Start watching
    console.log(`⏰ Start watching to ${srcDir}`)
    var watching = startWatching(makeCompiler())

    const restartWatching = () => {
        recompileCount = 0;
        watching.close()
        watching = startWatching(makeCompiler())
    }

    // Restarting watching option whenever entry files' list is changed
    watch.createMonitor(srcDir, { interval: 50 }, (monitor) => {
        monitor
            .on('created', (file) => {
                console.log('🔃 Entry files\' list has changed, restarting watcher')
                restartWatching()
            })
            .on('removed', (file) => {
                const distPath = path.resolve(outputDir, path.relative(srcDir, file))
                console.log(`🔃 Entry files\' list has changed,\x1b[31m\x1b[1m removing\x1b[0m ${distPath}`)
                fs.removeSync(distPath)
                restartWatching()
            })
    })

} else {
    const compiler = makeCompiler()
    compiler.run((err, stats) => {
        if (err) {
            console.error(err.stack || err);
            if (err.details) {
                console.error(err.details);
            }
            return;
        }

        console.log(stats.toString({
            preset: stats.hasErrors() || stats.hasWarnings() ? 'errors-warnings' : 'detailed',
            colors: true
        }));

        compiler.close((closeErr) => {
            if (closeErr) console.error(closeErr)
        })

        compiler.close((closeErr) => { })
    })
}

