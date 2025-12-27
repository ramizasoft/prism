# Prism (Brand Factory Generator)

**A high-performance static site generator platform for Amazon sellers to achieve brand verification and own their audience.**

Built by RamizaSoft, Prism acts as a "factory" engine that powers 50+ client instances with a shared core, ensuring consistent compliance, performance (100/100 Lighthouse), and branding.

## Technology Stack

- **Core Engine:** Laravel Zero (v12.x)
- **SSG:** Jigsaw (v1.8.3) with Vite
- **Styling:** Tailwind CSS (JIT Mode)
- **Configuration:** Spatie Laravel Data (DTOs)
- **Language:** PHP 8.2+ (Strict Types)

## Getting Started

### Prerequisites

- PHP 8.2 or higher
- Composer
- Node.js & NPM

### Installation

**Option 1: Global Installation (Recommended for creating new projects)**
```bash
composer global require ramizasoft/prism
```

**Option 2: Local Installation (For existing projects)**
```bash
composer require ramizasoft/prism
```

---

## Creating a New Project

The easiest way to start is using the `init` command.

1. **Create a directory:**
   ```bash
mkdir my-brand
cd my-brand
   ```

2. **Initialize the project:**
   ```bash
prism init
   ```
   Follow the interactive prompts to set your Project Name, Niche (Clinical, Playful, etc.), and Brand Color.

   **This command automatically:**
   - Generates `config.php` with your settings.
   - Creates `bootstrap.php` to link the core engine.
   - Sets up `composer.json` with the correct dependencies.
   - Scaffolds a basic `source` directory.

3. **Install & Build:**

   ```bash

   composer install

   prism build

   prism build production

   ```



---



## Core Workflows



### 1. Building your site



Instead of calling the Jigsaw binary manually, use the Prism wrapper:



```bash

# Development build (local)

prism build



# Production build (optimized)

prism build production

```



### 2. Client Repository Setup

Prism uses a "Thin Client" pattern. Client repositories depend on the `prism` core package.

**Configuration (`bootstrap.php`):**

Add the build listeners to the client's `bootstrap.php` to enable validation and template loading:

```php
<?php

use Prism\Core\Listeners\BuildValidator;
use Prism\Core\Listeners\TemplateLoader;

/** @var \TightenCo\Jigsaw\Events\EventBus $events */
$events->beforeBuild([
    BuildValidator::class,
    TemplateLoader::class,
]);
```

- **`BuildValidator`**: Loads `config.php`, strictly validates it, and halts the build on error.
- **`TemplateLoader`**: Registers the correct Blade templates based on the active preset.

### 2. Fleet Management

Use the Prism CLI to manage updates across multiple client repositories.

**Update all clients:**

```bash
# Dry run to see what will happen
php prism update:all --file=fleet.json --dry-run

# Execute updates and push to remote
php prism update:all --file=fleet.json --push
```

**Build all clients:**

```bash
# Stop immediately if a build fails
php prism build:all --file=fleet.json --stop-on-failure
```

**Fleet File Format (`fleet.json`):**
A JSON array of repository paths (absolute or relative to the JSON file).

```json
[
    "../clients/brand-alpha",
    "../clients/brand-beta"
]
```

### 3. Using Components

**Supplement Facts Panel:**
Renders an FDA-aligned panel. Usage in Blade:

```blade
<x-prism::supplement-facts :data="$page->supplement" />
```

**Data Structure:**
The `$page->supplement` data must match the schema:
- `serving_size` (string)
- `servings_per_container` (string)
- `nutrients` (array of objects)
- `proprietary_blends` (optional array)

---

## Development Standards

### Code Quality
- **Strict Typing:** All files must start with `declare(strict_types=1);`.
- **Testing:** We use **Pest PHP**. Run tests with `./vendor/bin/pest`.
- **Formatting:** Code must adhere to PSR-12.

### Adding Features
1. **Core First:** Implement logic in `prism` core, not client repos.
2. **Config Driven:** Use `PrismConfig` DTOs to drive behavior.
3. **Validate:** Add validation rules to DTOs to fail fast.

---

## License

Prism is open-source software licensed under the [MIT license](LICENSE.md).