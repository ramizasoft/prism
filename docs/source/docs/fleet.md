---
extends: prism::layouts.app
title: Fleet Management (Multiple Brands)
---
# Fleet Management (Multiple Brands)

Prism supports managing many thin-client brand sites (“a fleet”) from one machine.

This is designed for agencies / Amazon aggregators running dozens of brand sites with the same core engine.

---

## The fleet file (`fleet.json`)
Create a JSON file containing a list of client repo paths (relative or absolute).

Example:

```json
[
  "../clients/pawjoy-toys",
  "../clients/zenpet-organics"
]
```

---

## Build all client sites
From the directory that contains `fleet.json`:

```bash
prism build:all --file=fleet.json --stop-on-failure
```

What it does:
- iterates each path
- runs the client’s own Prism binary: `vendor/bin/prism build production`
- prints a table of successes/failures

---

## Update Prism across all clients
Dry run first:

```bash
prism update:all --file=fleet.json --dry-run
```

Execute updates (and optionally push):

```bash
prism update:all --file=fleet.json
prism update:all --file=fleet.json --push
```

What it does:
- runs `composer update ramizasoft/prism` inside each client
- commits `composer.lock` with message `chore: update prism engine`
- optionally `git push`

---

## Recommended safety checklist
- Run **dry-run** first.
- Ensure all client repos have clean working trees before updating.
- Prefer running builds (`build:all`) after updates to catch config validation failures early.

