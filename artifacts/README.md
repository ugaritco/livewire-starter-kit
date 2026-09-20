# Ugarit Modular Artifacts (مستودع الموديولات والقطع البرمجية)

This directory contains internal and modular **Artifacts** for the Ugarit application.

Each subdirectory represents a standalone or internal module following the **Artifact-Driven Architecture (ADA)**.

## Structure
An artifact can define its capabilities and service providers via:
- `art.php`: Returns an anonymous class extending `Heritage\Support\Artifact`.
- `composer.json`: Declaring service providers under `extra.ugarit.providers`.
- Service Providers under `src/Providers/`.

## Autodiscovery
When `config('artifacts.autodiscovery')` is enabled, all active artifacts located in this directory have their service providers registered and booted automatically in the Application Kernel (`Heritage\Foundation\Application`).
