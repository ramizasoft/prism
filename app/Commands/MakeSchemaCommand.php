<?php

declare(strict_types=1);

namespace Prism\Core\Commands;

use LaravelZero\Framework\Commands\Command;
use Prism\Core\Data\ConfigData;
use ReflectionClass;
use ReflectionProperty;

class MakeSchemaCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'make:schema';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Generate a JSON Schema for the Prism configuration.';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->info('Generating Prism Config JSON Schema...');

        $schema = [
            '$schema' => 'http://json-schema.org/draft-07/schema#',
            'title' => 'Prism Configuration',
            'type' => 'object',
            'properties' => $this->mapProperties(ConfigData::class),
            'required' => ['project_name', 'theme_preset', 'compliance_mode', 'brand_colors'],
        ];

        $path = base_path('resources/schemas/prism-config.json');
        
        if (! is_dir(dirname($path))) {
            mkdir(dirname($path), 0755, true);
        }

        file_put_contents(
            $path,
            json_encode($schema, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)
        );

        $this->info("Schema generated at: {$path}");
    }

    protected function mapProperties(string $class): array
    {
        $reflection = new ReflectionClass($class);
        $properties = [];

        foreach ($reflection->getProperties(ReflectionProperty::IS_PUBLIC) as $property) {
            $name = $property->getName();
            $type = $property->getType();
            $typeName = $type ? $type->getName() : 'string';

            if (class_exists($typeName) && is_subclass_of($typeName, \Spatie\LaravelData\Data::class)) {
                $properties[$name] = [
                    'type' => 'object',
                    'properties' => $this->mapProperties($typeName),
                ];
                continue;
            }

            $schemaType = match ($typeName) {
                'int' => 'integer',
                'bool' => 'boolean',
                'array' => 'object',
                default => 'string',
            };

            $properties[$name] = ['type' => $schemaType];

            // Add enum-like support for theme_preset and compliance_mode if we were more advanced
            if ($name === 'theme_preset') {
                $properties[$name]['enum'] = ['clinical', 'playful', 'luxury', 'organic'];
            }
            if ($name === 'compliance_mode') {
                $properties[$name]['enum'] = ['none', 'supplements', 'pet_food'];
            }
        }

        return $properties;
    }
}
