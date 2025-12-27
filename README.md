# Prism (Brand Factory Generator)

**A high-performance static site generator platform for Amazon sellers to achieve brand verification and own their audience.**

Built by RamizaSoft, Prism acts as a "factory" engine that powers 50+ client instances with a shared core, ensuring consistent compliance, performance (100/100 Lighthouse), and branding.

## Technology Stack

- **Core Engine:** Laravel Zero (v12.x)
- **SSG:** Jigsaw (v1.8.3) with Vite
- **Styling:** Tailwind CSS (JIT Mode)
- **Configuration:** Spatie Laravel Data (DTOs)
- **Language:** PHP 8.2+ (Strict Types)

---

## Getting Started

### Prerequisites

- PHP 8.2 or higher
- Composer
- Node.js & NPM

### Installation

1. **Clone the repository:**
   ```bash
   git clone <repository-url> prism
   cd prism
   ```

2. **Install dependencies:**
   ```bash
   composer install
   npm install
   ```

3. **Build the assets:**
   ```bash
   npm run build
   ```

---

## Core Workflows

### 1. Client Repository Setup

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