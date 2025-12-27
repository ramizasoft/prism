---
extends: prism::layouts.app
title: Compliance Guide
---
# Compliance Guide

Prism is built to handle the complex regulatory requirements of specific industries automatically.

## Supplements Mode

When `compliance_mode` is set to `supplements`, Prism enables:

- **FDA Disclaimer Injection:** Automatically adds the mandatory FDA disclaimer to all product pages and footers.
- **Supplement Facts Panels:** Renders structured nutrition data in a standardized format.
- **Regulatory Badges:** Access to a library of pre-validated compliance SVGs (GMP, FDA Registered, etc.).

## Pet Food Mode

When `compliance_mode` is set to `pet_food`, Prism enables:

- **AAFCO Statements:** Automatically injects nutritional adequacy statements.
- **Guaranteed Analysis:** Renders protein, fat, and fiber tables per industry standards.

## The "Thin Client" Rule

Do NOT modify legal text directly. All regulatory content is managed by the core engine to ensure across-the-board compliance updates.
