# Contributing to Ugarit I18n Artifact

Thank you for contributing to `ugarit-artifacts/i18n`.

## Scope
This artifact strictly handles backend internationalization capabilities. Frontend UI components, language switcher dropdowns, and Blade views belong in application starter kits—not here.

## Branch Strategy
* `main`: Stable production releases tagged with `v1.xx.xx`.
* `1.x`: Maintenance branch for the 1.x line.
* `develop`: Integration branch for new capabilities.

## Commit Conventions
Follow Conventional Commits:
```text
type(scope): imperative description
```
Examples:
* `feat(locales): add script code resolution to LocaleDTO`
* `fix(repository): ensure fallback locale returns default on empty query`
* `test(pest): add coverage for rtl direction detection`

## Quality Gates
1. Syntax check: `php -l <file>`
2. Code formatting: `vendor/bin/pint`
3. Test suite: `php scribe test`
