#!/usr/bin/env node
import yargs from 'yargs'
import path from 'path'
import fs from 'fs-extra'
import { globSync } from "glob"
import watch from "watch"
import sass from "sass"
import postcss from 'postcss'
import autoprefixer from 'autoprefixer'
import { fileURLToPath } from 'url'

const argv = yargs(process.argv.slice(1))
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
const srcDir = path.resolve(__dirname, '../assets/src/scss')
const distDir = path.resolve(__dirname, '../assets/dist/css')

const postProcessor = postcss(
    [autoprefixer({
        cascade: false,
        env: fs.readJsonSync('./package.json').browserslist ?? "defaults"
    })]
)

async function compileStyleSheet(srcPath) {
    let css = sass.compile(srcPath, { style: 'compressed' }).css
    css = (await postProcessor.process(css, { from: srcPath })).css

    const relativeDir = path.dirname(path.relative(srcDir, srcPath))
    const outputPath = path.format({ ...path.parse(srcPath), dir: path.resolve(distDir, relativeDir), base: '', ext: '.css' })
    return fs.outputFile(outputPath, css, err => { if (err) console.log(err) })
}

let compileCounts = 0
const compileAllStylesInSrcFolder = async () => {
    try {
        const startTime = Date.now()
        // fs.removeSync(distDir)
        compileStyleSheet(`${srcDir}/checkout.scss`)
        const promises = globSync(`${srcDir}/*.scss`)
            .reduce((promises, file) => {
                promises.push(compileStyleSheet(file))
                return promises
            }, [])
        await Promise.all(promises)
        compileCounts++
        console.log(`${compileCounts}: styles compiled\x1b[32m\x1b[1m successfully\x1b[0m, elapsed-time: ${Date.now() - startTime} ms`)
    } catch (error) {
        console.error(`something went\x1b[31m\x1b[1m wrong\x1b[0m when compiling styles, reason: \n ${error}`)
    }
}

compileAllStylesInSrcFolder()

if (argv.w) {
    watch.createMonitor(srcDir, { interval: 100 }, (monitor) => {
        monitor
            .on('created', (file) => { compileAllStylesInSrcFolder() })
            .on('changed', (file) => { compileAllStylesInSrcFolder() })
            .on('removed', (file) => { compileAllStylesInSrcFolder() })
    })
}

