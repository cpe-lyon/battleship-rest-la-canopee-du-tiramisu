# Watamelo Skeleton
[![Latest Stable Version](https://img.shields.io/packagist/v/yosko/watamelo-skeleton.svg)](https://packagist.org/packages/yosko/watamelo-skeleton)
[![License](https://img.shields.io/packagist/l/yosko/watamelo-skeleton.svg)](https://packagist.org/packages/yosko/watamelo-skeleton)

A skeleton used to start a new project based on the Watamelo framework.

## How to use

Simplest way: create a new project based on this package:
```
composer create-project yosko/watamelo-skeleton skel-test --remove-vcs
```

By default, your project will use the `App` namespace.

### Custom Namespace

You can replace the default namespace by setting the `APP_NAMESPACE` environment variable:

```bash
APP_NAMESPACE=MyProject composer create-project yosko/watamelo-skeleton my-project --remove-vcs
```

## Route callback

When declaring a route, it can be either a pair of a class/instance and the name of one of its nonstatic methods. Either:
- instance of a class (`object`): the method will be called on this object.
- name of a class (`string`: use `MyClass::class`): an object will be created and then the method will be called.