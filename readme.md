# Development

## Compiling assets:

To compile assets for production:

```bash
npm run build-assets
```

To watch and compile assets in real time for development:

```bash
npm run watch-assets
```

Requirements:

- `node >v18`
- `npm >v8`

## Build with local

To create a production-ready version of the plugin, execute the following commands with PHP v8.0:

### 1. Install required packages globally

```bash
composer global require humbug/php-scoper "0.16.1"
composer global require symfony/console "^5.4"
```

### 2. Build the plugin

```bash
composer build --ignore-platform-reqs
composer build-zip --ignore-platform-reqs
```

## Build with staging server

To build the plugin on the staging server, log in and run:

```bash
bash wp-plugin-builder.sh wp-sms-pro
```

For debugging output, use:

```bash
bash wp-plugin-builder.sh wp-sms-pro --debug
```

You'll see the download URL in the output.