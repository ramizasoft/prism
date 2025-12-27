---
extends: prism::layouts.app
title: Configuration Reference
---
# Configuration Reference

The `config.php` file is the brain of your client site. It uses a fluent API to ensure type safety and IDE autocompletion.

## Base Configuration

```php
use Prism\Core\Prism;

return Prism::configure(
    project_name: 'My Brand',
    theme_preset: 'clinical',
    compliance_mode: 'supplements',
    brand_colors: [
        'primary' => '#0a192f',
        'secondary' => '#00a79d',
    ],
);
```

### Options

| Key | Type | Description |
| --- | --- | --- |
| `project_name` | `string` | The brand name used across the site. |
| `theme_preset` | `string` | Visual style: `clinical`, `playful`, `luxury`, `organic`. |
| `compliance_mode` | `string` | Industry mode: `none`, `supplements`, `pet_food`. |
| `brand_colors` | `array` | `primary` and `secondary` hex codes. |
| `niche` | `array` | Optional industry-specific settings. |
