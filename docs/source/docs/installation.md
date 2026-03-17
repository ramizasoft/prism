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

## 1. Install Prism (CLI)
Prism is distributed as a Composer package that provides a `prism` CLI.

```bash
composer global require ramizasoft/prism
```

If you don't use global installs, you can also install Prism into an existing repo:

```bash
composer require ramizasoft/prism
```

## 2. Create a Thin Client site (recommended workflow)
Prism sites are **thin-client** repos: content + configuration only. The engine (layouts/components/compliance logic) lives in the Prism package.

### Option A: create a new folder (one command)
This creates a new directory (slugged from the name), scaffolds files, then runs `composer install` + `npm install`.

```bash
prism create:client "My Awesome Brand"
```

### Option B: initialize the current directory
If you already created a folder/repo, run:

```bash
prism init "My Awesome Brand"
```

## 3. Local development (assets + build + preview)
From the client repo root:

```bash
cd my-awesome-brand
composer install
npm install
npm run dev
```

Preview the generated site locally:

```bash
npm run preview
```

Your site is now ready for content in `source/` (including `source/_products/`).
