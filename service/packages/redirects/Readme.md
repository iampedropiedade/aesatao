# Redirects

## Install

In your `.gitignore` add `service/packages/redirects`

In your `composer.json` file, add:

```json
"repositories": [
  {
    "type": "vcs",
    "url": "https://github.com/rawnet/concrete-redirects"
  }
],
```

```json
"extra": {
  ...
  "installer-paths": {
    "packages/{$name}": ["type:concrete5-package"],
    "application/blocks/{$name}": ["type:concrete5-block"],
    "application/src/{$name}": ["type:concrete5-core"]
  }
}
```

Then run:

`composer require rawnet/concrete-redirects`

## Docs

1. Install package at /dashboard/extend/install
