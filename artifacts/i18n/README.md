# Ugarit I18n Artifact (`ugarit-artifacts/i18n`)

> **"Artifacts provide capabilities. Features define behavior."**

The **I18n Artifact** is the official internationalization, locale management, and linguistic capability engine for the Ugarit Ecosystem. Built upon the **Artifact-Driven Architecture (ADA)**, it operates as a completely decoupled backend capability with zero presentation baggage.

---

## Role in the Ecosystem

| Layer | Package | Responsibility |
| :--- | :--- | :--- |
| **Kernel** | `ugarit/framework` | Core service container and foundation lifecycle |
| **Artifact** | `ugarit-artifacts/i18n` | Autonomous internationalization, locales & translations |

---

## Core Capabilities

* **`locales`**: Multi-locale registration, directional resolution (`RTL`/`LTR`), regional variants, and active locale detection.
* **`languages`**: Comprehensive ISO-639 language catalog with native and international naming.
* **`translations`**: Dynamic multilingual entity translation via `HasTranslatableAttributes` trait and dictionary persistence.

---

## Architecture Mapping

| Layer | Namespace / Directory | Responsibility |
| :--- | :--- | :--- |
| **Contracts** | `src/Contracts/` | Interface specifications for mockability |
| **DTOs** | `src/DTOs/` | Immutable typed input and output data shapes |
| **UseCases (Operations)** | `src/Services/UseCases/` | Discrete single-purpose operations |
| **Composite Services** | `src/Services/` | Multi-operation composition workflows |
| **Outcomes** | `src/Outcomes/` | Standardized result envelopes (replaces Response) |
| **Signals** | `src/Signals/` | Domain occurrence notifications (replaces Event) |
| **Repositories** | `src/Repositories/` | Data source boundary; maps Models to DTOs |
| **Responders** | `src/Http/Responders/` | Transport adapters (JSON, Inertia, CLI) |
| **Controllers** | `src/Http/Controllers/` | Input dispatchers; zero business rules |

---

## Quick Start

Require the artifact within your Ugarit application:

```bash
composer require "ugarit-artifacts/i18n:^1.00.00"
```

The artifact self-registers via `art.php` and its service provider. Run migrations:

```bash
php scribe migrate
```

---

## License & Authorship

Developed under the leadership of **Muath R Abu Ouda** (Vision Leader of Ugarit). Licensed under the [MIT License](LICENSE.md).
