---
extends: prism::layouts.app
title: Installation Guide
---
# Installation Guide

Setting up the Prism Brand Factory is simple. Follow these steps to get your environment ready.

## Prerequisites
- PHP 8.2+
- Composer
- Node.js & NPM

## 1. Install the Core Engine
Clone the core engine and install dependencies:

```bash
git clone https://github.com/prism/core-engine.git
cd core-engine
composer install
```

## 2. Initialize a Client Site
Use the built-in command to scaffold a new brand:

```bash
php prism create:client "My Awesome Brand"
```

## 3. Local Development
Navigate to your new site and start the build process:

```bash
cd my-awesome-brand
composer install
npm run dev
```

Your site is now ready for content!
