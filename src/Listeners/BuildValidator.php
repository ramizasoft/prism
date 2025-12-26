<?php

declare(strict_types=1);

namespace Prism\Core\Listeners;

use BackedEnum;
use DateTimeInterface;
use Illuminate\Config\Repository;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator as ValidatorFacade;
use Illuminate\Translation\ArrayLoader;
use Illuminate\Translation\Translator;
use Illuminate\Validation\ValidationException as LaravelValidationException;
use Illuminate\Validation\Factory as ValidationFactory;
use Prism\Core\Data\ConfigData;
use RuntimeException;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\LaravelData\Casts\EnumCast;
use Spatie\LaravelData\Normalizers\ArrayNormalizer;
use Spatie\LaravelData\Normalizers\ArrayableNormalizer;
use Spatie\LaravelData\Normalizers\JsonNormalizer;
use Spatie\LaravelData\Normalizers\ModelNormalizer;
use Spatie\LaravelData\Normalizers\ObjectNormalizer;
use Spatie\LaravelData\RuleInferrers\AttributesRuleInferrer;
use Spatie\LaravelData\RuleInferrers\BuiltInTypesRuleInferrer;
use Spatie\LaravelData\RuleInferrers\NullableRuleInferrer;
use Spatie\LaravelData\RuleInferrers\RequiredRuleInferrer;
use Spatie\LaravelData\RuleInferrers\SometimesRuleInferrer;
use Spatie\LaravelData\Support\Creation\ValidationStrategy;
use Spatie\LaravelData\Transformers\ArrayableTransformer;
use Spatie\LaravelData\Transformers\DateTimeInterfaceTransformer;
use Spatie\LaravelData\Transformers\EnumTransformer;
use TightenCo\Jigsaw\Jigsaw;
use function collect;

class BuildValidator
{
    public function handle(Jigsaw $jigsaw): void
    {
        $configPath = $jigsaw->app->path('config.php');

        $this->bootstrapDataConfig($jigsaw);
        $this->bootstrapValidator($jigsaw);

        if (! is_file($configPath)) {
            $this->renderError($jigsaw, "Config Error: config.php not found at {$configPath}");

            throw new RuntimeException('Config validation failed: missing config.php');
        }

        $config = include $configPath;

        if (! is_array($config)) {
            $this->renderError($jigsaw, "Config Error: config.php must return an array at {$configPath}");

            throw new RuntimeException('Config validation failed: config.php did not return an array');
        }

        if (! array_key_exists('niche', $config) || ! is_array($config['niche'])) {
            // Normalize niche for validation; optional unless a compliance niche is required
            $config['niche'] = [];
        }

        try {
            $configData = ConfigData::from($config);
        } catch (LaravelValidationException $exception) {
            $messages = collect($exception->errors())
                ->map(fn (array $errors, string $field) => "{$field}: " . implode(', ', $errors))
                ->implode(PHP_EOL . ' - ');

            $this->renderError($jigsaw, "Config Error:\n - {$messages}");

            throw new RuntimeException('Config validation failed', 0, $exception);
        } catch (\Throwable $throwable) {
            $this->renderError($jigsaw, 'Config Error: ' . $throwable->getMessage());

            throw $throwable;
        }

        $jigsaw->app->instance(ConfigData::class, $configData);
    }

    private function bootstrapDataConfig(Jigsaw $jigsaw): void
    {
        $configRepository = $jigsaw->app->config instanceof Collection
            ? $jigsaw->app->config
            : collect($jigsaw->app->config);

        if ($configRepository->get('data') === null) {
            $configRepository->put('data', [
                'date_format' => DATE_ATOM,
                'date_timezone' => null,
                'features' => [
                    'cast_and_transform_iterables' => false,
                    'ignore_exception_when_trying_to_set_computed_property_value' => false,
                ],
                'transformers' => [
                    DateTimeInterface::class => DateTimeInterfaceTransformer::class,
                    Arrayable::class => ArrayableTransformer::class,
                    BackedEnum::class => EnumTransformer::class,
                ],
                'casts' => [
                    DateTimeInterface::class => DateTimeInterfaceCast::class,
                    BackedEnum::class => EnumCast::class,
                ],
                'rule_inferrers' => [
                    SometimesRuleInferrer::class,
                    NullableRuleInferrer::class,
                    RequiredRuleInferrer::class,
                    BuiltInTypesRuleInferrer::class,
                    AttributesRuleInferrer::class,
                ],
                'normalizers' => [
                    ModelNormalizer::class,
                    ArrayableNormalizer::class,
                    ObjectNormalizer::class,
                    ArrayNormalizer::class,
                    JsonNormalizer::class,
                ],
                'wrap' => null,
                'var_dumper_caster_mode' => 'development',
                'structure_caching' => [
                    'enabled' => false,
                    'directories' => [],
                    'cache' => [
                        'store' => 'file',
                        'prefix' => 'laravel-data',
                        'duration' => null,
                    ],
                    'reflection_discovery' => [
                        'enabled' => false,
                        'base_path' => '',
                        'root_namespace' => null,
                    ],
                ],
                'validation_strategy' => ValidationStrategy::Disabled->value,
                'name_mapping_strategy' => [
                    'input' => null,
                    'output' => null,
                ],
                'ignore_invalid_partials' => false,
                'max_transformation_depth' => null,
                'throw_when_max_transformation_depth_reached' => true,
                'commands' => [
                    'make' => [
                        'namespace' => 'Data',
                        'suffix' => 'Data',
                    ],
                ],
                'livewire' => [
                    'enable_synths' => false,
                ],
            ]);
        }

        $repository = new Repository($configRepository->toArray());
        $jigsaw->app->instance('config', $repository);
    }

    private function bootstrapValidator(Jigsaw $jigsaw): void
    {
        $loader = new ArrayLoader();
        $translator = new Translator($loader, 'en');
        $factory = new ValidationFactory($translator);

        $jigsaw->app->instance('translation.loader', $loader);
        $jigsaw->app->instance('translator', $translator);
        $jigsaw->app->instance('validator', $factory);

        ValidatorFacade::swap($factory);
    }

    private function renderError(Jigsaw $jigsaw, string $message): void
    {
        $output = $jigsaw->app->consoleOutput ?? null;

        if ($output !== null) {
            $formatted = "<fg=red>{$message}</>";
            $output->getErrorOutput()->writeln($formatted);
            $output->writeln($formatted);

            return;
        }

        fwrite(STDERR, $message . PHP_EOL);
        fwrite(STDOUT, $message . PHP_EOL);
    }
}


