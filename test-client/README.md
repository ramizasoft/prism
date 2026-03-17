# Prism Starter Template

This is a **Thin Client** repository for the Prism Brand Factory.

## The Thin Client Philosophy

Unlike traditional web projects, a Prism Client repository contains **no business logic** and **no layout code**. It is designed to be a content-only, configuration-driven instance.

### Where are the views?
All layouts, components, and CSS reside in the core `prism` engine. This allows us to push updates, bug fixes, and new features to 50+ client sites simultaneously by simply updating the engine dependency.

### Where is the `app/` folder?
The "brain" of this site is the `config.php` file. Any logic needed (e.g., regulatory compliance, theme variations) is handled by the core engine based on your configuration.

## Getting Started

1. **Install Dependencies:**
   ```bash
   composer install
   ```

2. **Configure Your Brand:**
   Edit `config.php` to set your project name, colors, and niche.

3. **Add Content:**
   Add your products as Markdown files in `source/_products/`.

4. **Build the Site:**
   ```bash
   npm run build
   ```

5. **Preview:**
   ```bash
   npm run preview
   ```

## Project Structure

- `config.php`: The brain. Define your niche, theme, and compliance settings here.
- `source/`: Your content.
  - `index.blade.php`: Your homepage.
  - `_products/`: Your product catalog.
- `composer.json`: Manages the `prism` engine dependency.
- `package.json`: Build scripts for local development.
