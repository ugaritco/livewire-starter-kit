# Ugarit Geography Artifact (`ugarit-artifacts/geography`)

> **"Artifacts provide capabilities. Features define behavior."**

The **Geography Artifact** is the official geographical data and territorial hierarchy capability engine for the Ugarit Ecosystem. Built upon the **Artifact-Driven Architecture (ADA)**, it operates as a completely decoupled backend capability providing structured country, governorate, city, and location datasets with zero frontend coupling.

---

## Role in the Ecosystem

| Layer | Package | Responsibility |
| :--- | :--- | :--- |
| **Kernel** | `ugarit/framework` | Core service container and database lifecycle |
| **Artifact** | `ugarit-artifacts/i18n` | Provides translatable multilingual attributes |
| **Artifact** | `ugarit-artifacts/geography` | Autonomous territorial hierarchy and geospatial registry |

---

## Core Capabilities

* **`countries`**: ISO-3166-1 alpha-2, alpha-3, numeric codes, capitals, currencies, dialing codes, and flags.
* **`governorates`**: First-level territorial divisions, governorates, provinces, and states linked to countries.
* **`cities`**: Municipalities and local districts hierarchically bound to governorates and countries.
* **`locations`**: Geospatial coordinates (latitude/longitude), localized street addresses, and postal codes.

---

## Architecture Mapping

| Layer | Namespace / Directory | Responsibility |
| :--- | :--- | :--- |
| **Contracts** | `src/Contracts/` | Interface boundaries for data access |
| **DTOs** | `src/DTOs/` | Immutable typed input and output data shapes |
| **UseCases (Operations)** | `src/Services/UseCases/` | Single-purpose domain operations |
| **Outcomes** | `src/Outcomes/` | Standardized result envelopes (replaces Response) |
| **Signals** | `src/Signals/` | Domain occurrence notifications (replaces Event) |
| **Repositories** | `src/Repositories/` | Data source boundaries mapping Models to DTOs |
| **Responders** | `src/Http/Responders/` | Transport adapters (JSON, Inertia, CLI) |
| **Controllers** | `src/Http/Controllers/` | Input dispatchers; zero business rules |

---

## Quick Start

Require the artifact within your Ugarit application:

```bash
composer require "ugarit-artifacts/geography:^1.00.00"
```

Execute migrations:

```bash
php scribe migrate
```

---

## License & Authorship

Developed under the leadership of **Muath R Abu Ouda** (Vision Leader of Ugarit). Licensed under the [MIT License](LICENSE.md).
