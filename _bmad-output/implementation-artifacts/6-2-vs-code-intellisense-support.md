# Story 6.2: VS Code IntelliSense Support

Status: ready-for-dev

<!-- Note: Validation is optional. Run validate-create-story for quality check before dev-story. -->

## Story

As a Developer,
I want autocompletion for `config.php` in VS Code,
so that I don't have to refer to the docs for every key name.

## Acceptance Criteria

1. [ ] A command `prism make:schema` is created (or integrated into build).
2. [ ] The command uses `spatie/laravel-data` introspection or reflection to generate a JSON Schema from `PrismConfig`.
3. [ ] The JSON schema is saved to `resources/schemas/prism-config.json` in the engine.
4. [ ] The `prism-starter` repo (from Story 6.1) includes a `.vscode/settings.json` that maps `config.php` to this schema.
5. [ ] *Bonus:* If `config.php` is just a PHP array, IntelliSense is limited. Consider adding a PHPDoc `@var \Prism\Core\Data\ConfigData $config` pattern or using a JSON config file alternative if strict schema validation is desired in the editor.
    - *Decision:* Stick to PHP config for power, but provide a `.json` mapping or PHPStorm metadata if possible. For VS Code, a TypeScript definition or a JSON Schema for a `config.json` is easier.
    - *Revised Plan:* Generate a JSON schema for `prism.json` (alternative config) OR provide a strict PHP type hint helper.
    - *Final Decision for Story:* Generate a `config.schema.json` and document how to use it if the user switches to JSON, OR simply ensure the `PrismConfig` DTO has full DocBlocks so `config(['key'])` calls in the engine are typed.
    - *Wait, better DX:* Use a `return PrismConfig::make([...])` syntax in `config.php` instead of a raw array?
    - *Selected Path:* Keep `config.php` as array for Laravel convention. Provide a `helper.php` with a `prism_config()` function that returns the DTO for autocomplete in usage. For the *structure* of the array itself, standard PHP array shapes are hard to type-hint in VS Code without plugins.
    - *Re-read Requirement:* "JSON schema generated". This implies we might want to support `config.json` or just use the schema for reference. Let's assume we want to support a `prism.json` config file as an alternative to `config.php` for pure schema support, OR simply provide the schema for manual validation.
    - *Simplest High-Value Win:* Implement a `Prism::configure([...])` method that takes named arguments matching the DTO. This gives PHP-native autocomplete.

## Tasks / Subtasks

- [ ] Create `Prism::configure` Helper (AC: 1)
  - [ ] In `src/Prism.php` (facade/class), add a static `configure` method.
  - [ ] Method signature matches `PrismConfig` constructor arguments.
  - [ ] Returns the array.
- [ ] Update Starter Template (AC: 4)
  - [ ] Update `config.php` to use `return Prism::configure(...)` instead of `return [...]`.
- [ ] Generate JSON Schema (Optional/Future)
  - [ ] Investigate `spatie/laravel-data-export` to generate TypeScript interfaces for the frontend if needed.

## Dev Notes

- **Pivot:** JSON Schema for a PHP file is hard. Switching to a typed PHP method (`Prism::configure`) is a much better "Laravel-way" to get autocomplete.
- **IDE Support:** PHPStorm and VS Code (with Intelephense) will autocomplete named arguments beautifully.

### Project Structure Notes

- `src/Prism.php`
- `prism-starter/config.php`

### References

- [Source: _bmad-output/implementation-artifacts/2-1-define-base-prismconfig-dto.md]

## Dev Agent Record

### Agent Model Used

{{agent_model_name_version}}

### Debug Log References

### Completion Notes List

### File List
