# Story 6.2: VS Code IntelliSense Support

Status: done

## Story

As a Developer,
I want autocompletion for `config.php` in VS Code,
so that I don't have to refer to the docs for every key name.

## Acceptance Criteria

1. [x] A command `prism make:schema` is created (or integrated into build).
2. [x] The command uses `spatie/laravel-data` introspection or reflection to generate a JSON Schema from `PrismConfig`.
3. [x] The JSON schema is saved to `resources/schemas/prism-config.json` in the engine.
4. [x] The `prism-starter` repo (from Story 6.1) includes a `.vscode/settings.json` that maps `config.php` to this schema.
5. [x] *Bonus:* If `config.php` is just a PHP array, IntelliSense is limited. Consider adding a PHPDoc `@var \Prism\Core\Data\ConfigData $config` pattern or using a JSON config file alternative if strict schema validation is desired in the editor.

## Tasks / Subtasks

- [x] Create `Prism::configure` Helper (AC: 1)
  - [x] In `src/Prism.php` (facade/class), add a static `configure` method.
  - [x] Method signature matches `PrismConfig` constructor arguments.
  - [x] Returns the array.
- [x] Update Starter Template (AC: 4)
  - [x] Update `config.php` to use `return Prism::configure(...)` instead of `return [...]`.
- [x] Generate JSON Schema (Optional/Future)
  - [x] Investigate `spatie/laravel-data-export` to generate TypeScript interfaces for the frontend if needed.
  - [x] Implemented `prism make:schema` to generate JSON Schema from DTO.

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

Gemini 2.5 Flash

### Debug Log References

- Created `Prism::configure` static helper in `src/Prism.php`.
- Updated `prism-starter/config.php` and `stubs/config.php.stub` to use fluent configuration.
- Created `MakeSchemaCommand` to generate JSON schema from `ConfigData`.
- Generated `resources/schemas/prism-config.json`.
- Added `.vscode/settings.json` to `prism-starter`.

### Completion Notes List

- All ACs met.
- Fluent configuration provides immediate IDE benefits.
- JSON Schema available for validation or alternative config formats.

### File List

- `src/Prism.php`
- `app/Commands/MakeSchemaCommand.php`
- `resources/schemas/prism-config.json`
- `prism-starter/config.php`
- `prism-starter/.vscode/settings.json`
- `stubs/config.php.stub`
