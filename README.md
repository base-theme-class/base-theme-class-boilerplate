# Base theme class - boilerplate

Adds a "post-type" Boilerplate which allows arbitrary boilerplate chunks of HTML to be managed in the admin interface and to be included in pages either by using a shortcode or in templates using a directive.

## Note:

This plugin in is an extension plugin to Base Theme Class, and so requires that to be installed along with either Advanced Custom Fields (ACF) or Advanced Custom Fields Pro (ACFpro).

## Use in pages:

The short code is simply: 

```
    [boilerplate {template-name}]
```

## Use in templates:

To embed short code text in templates just use the directive:

```
    [[boilerplate:-:{template-name}]]
```